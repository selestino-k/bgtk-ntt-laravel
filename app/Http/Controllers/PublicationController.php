<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Tag;
use App\Services\ViewCounterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicationController extends Controller
{
    protected function ensureAdminOrOperator()
    {
        abort_if(! Auth::check() || ! in_array(Auth::user()->role, ['admin', 'operator']), 403);
    }

    public function beritaIndex()
    {
        $this->ensureAdminOrOperator();

        $beritas = Berita::with(['author', 'tags'])
            ->whereDoesntHave('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->latest()
            ->paginate(15);
        

        return view('admin.publikasi.berita.index', compact('beritas'));
    }

    public function beritaDetail(Berita $berita)
    {
        $this->ensureAdminOrOperator();

        $berita->load(['author', 'tags']);

        return view('admin.publikasi.berita.detail', compact('berita'));
    }

    public function create()
    {
        $this->ensureAdminOrOperator();

        $tags = Tag::orderBy('tagline')->get();

        return view('admin.publikasi.berita.create', compact('tags'));
    }

    public function index(Request $request)
    {
        $tagId = $request->input('tag');

        $query = Berita::where('published', true)
            ->whereDoesntHave('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->latest()
            ->with(['author', 'tags']);

        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tag.id', $tagId);
            });
        }

        $beritas = $query->paginate(9)->withQueryString();
        $tags = Tag::whereRaw('LOWER(tagline) != ?', ['pengumuman'])->orderBy('tagline')->get();

        return view('home.publikasi.berita', compact('beritas', 'tags', 'tagId'));
    }

    public function pengumuman()
    {
        $beritas = Berita::whereHas('tags', function ($query) {
            $query->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
        })->latest()->with(['author', 'tags'])->get();

        return view('admin.publikasi.pengumuman.index', compact('beritas'));
    }

    public function pengumumanPublic()
    {
        $beritas = Berita::where('published', true)
            ->whereHas('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->latest()
            ->with(['author', 'tags'])
            ->paginate(10)
            ->withQueryString();

        return view('home.publikasi.pengumuman', compact('beritas'));
    }

    public function beritaTerkiniPublic(Request $request)
    {
        $tagId = $request->query('tag') ? (int) $request->query('tag') : null;

        $query = Berita::where('published', true)
            ->whereDoesntHave('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->with(['author', 'tags'])
            ->latest();

        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        }

        $beritas = $query->paginate(10)->withQueryString();

        $tags = Tag::whereRaw('LOWER(tagline) != ?', ['pengumuman'])
            ->orderBy('tagline')
            ->get();

        return view('home.publikasi.berita', compact('beritas', 'tags', 'tagId'));
    }

    public function beritaTerkiniDetailPublic(Request $request, Berita $berita, ViewCounterService $counter)
    {
        abort_if(! $berita->published, 404);

        $counter->record('berita:' . $berita->id, $request->ip());

        $berita->load(['author', 'tags']);

        $recentBeritas = Berita::where('published', true)
            ->where('id', '!=', $berita->id)
            ->whereDoesntHave('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->with(['tags'])
            ->latest()
            ->take(5)
            ->get();

        $tags = Tag::whereRaw('LOWER(tagline) != ?', ['pengumuman'])->orderBy('tagline')->get();

        $viewCounts = $counter->getPageViews('berita:' . $berita->id);

        return view('home.publikasi.berita.show', compact('berita', 'recentBeritas', 'tags', 'viewCounts'));
    }

    public function dokumenPublic()
    {
        $dokumens = Dokumen::latest()->get();
        $tags = Tag::orderBy('tagline')->get();

        return view('home.publikasi.dokumen', compact('dokumens', 'tags'));
    }

    public function dokumenIndex()
    {
        $dokumens = Dokumen::latest()->get();

        return view('admin.publikasi.dokumen.index', compact('dokumens'));
    }

    public function dokumenCreate()
    {
        $this->ensureAdminOrOperator();

        return view('admin.publikasi.dokumen.create');
    }

    public function dokumenStore(Request $request)
    {
        $this->ensureAdminOrOperator();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_url' => 'nullable|required_without:file|url|max:255',
            'file' => 'nullable|required_without:file_url|file|mimes:pdf,doc,docx,txt|max:5120',
            'kategori' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumen', 'public');

            $validated['file_url'] = $path;
            $validated['file_name'] = $request->file('file')->getClientOriginalName();
            $validated['file_size'] = $request->file('file')->getSize();
            $validated['file_type'] = $request->file('file')->getClientMimeType();
        } else {
            $fileName = pathinfo(parse_url($validated['file_url'], PHP_URL_PATH), PATHINFO_BASENAME);
            $validated['file_name'] = $fileName ?: $validated['judul'];
            $validated['file_size'] = 0;
            $validated['file_type'] = pathinfo(parse_url($validated['file_url'], PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'url';
        }

        Dokumen::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_url' => $validated['file_url'],
            'file_name' => $validated['file_name'],
            'file_size' => $validated['file_size'],
            'file_type' => $validated['file_type'],
            'kategori' => $validated['kategori'] ?? null,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function dokumenEdit(Dokumen $dokumen)
    {
        $this->ensureAdminOrOperator();

        return view('admin.publikasi.dokumen.edit', compact('dokumen'));
    }

    public function dokumenUpdate(Request $request, Dokumen $dokumen)
    {
        $this->ensureAdminOrOperator();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_url' => 'nullable|url|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
            'kategori' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumen', 'public');

            $validated['file_url'] = $path;
            $validated['file_name'] = $request->file('file')->getClientOriginalName();
            $validated['file_size'] = $request->file('file')->getSize();
            $validated['file_type'] = $request->file('file')->getClientMimeType();
        } elseif (empty($validated['file_url'])) {
            $validated['file_url'] = $dokumen->file_url;
            $validated['file_name'] = $dokumen->file_name;
            $validated['file_size'] = $dokumen->file_size;
            $validated['file_type'] = $dokumen->file_type;
        } else {
            $validated['file_name'] = pathinfo(parse_url($validated['file_url'], PHP_URL_PATH), PATHINFO_BASENAME) ?: $validated['judul'];
            $validated['file_size'] = 0;
            $validated['file_type'] = pathinfo(parse_url($validated['file_url'], PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'url';
        }

        $dokumen->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_url' => $validated['file_url'],
            'file_name' => $validated['file_name'],
            'file_size' => $validated['file_size'],
            'file_type' => $validated['file_type'],
            'kategori' => $validated['kategori'] ?? null,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function dokumenDestroy(Dokumen $dokumen)
    {
        $this->ensureAdminOrOperator();

        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function show(Berita $berita)
    {
        abort_if(! $berita->published, 404);

        $berita->load(['author', 'tags']);

        $recentBeritas = Berita::where('published', true)
            ->where('id', '!=', $berita->id)
            ->whereDoesntHave('tags', function ($q) {
                $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
            })
            ->latest()
            ->with('tags')
            ->take(5)
            ->get();

        return view('home.publikasi.berita.show', compact('berita', 'recentBeritas'));
    }

    public function edit(Berita $berita)
    {
        $this->ensureAdminOrOperator();

        $tags = Tag::orderBy('tagline')->get();

        return view('admin.publikasi.berita.edit', compact('berita', 'tags'));
    }

    public function update(Request $request, Berita $berita)
    {
        $this->ensureAdminOrOperator();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'remove_gambar' => 'nullable|boolean',
            'dokumen' => 'nullable|string|max:255',
            'dokumen_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
            'published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tag,id',
        ]);

        $isStoredFile = $berita->gambar && ! Str::startsWith($berita->gambar, ['http://', 'https://']);
        $gambarPath = $berita->gambar;

        if ($request->hasFile('gambar_file')) {
            if ($isStoredFile) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar_file')->store('berita', 'public');
        } elseif ($request->filled('gambar')) {
            if ($isStoredFile && $request->input('gambar') !== $berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->input('gambar');
        } elseif ($request->boolean('remove_gambar')) {
            if ($isStoredFile) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = null;
        }

        if ($request->hasFile('dokumen_file')) {
            $validated['dokumen'] = $request->file('dokumen_file')->store('dokumen', 'public');
        }

        $slug = Str::slug($validated['judul']);
        if ($slug === '') {
            $slug = 'berita';
        }

        $originalSlug = $slug;
        $counter = 1;

        while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $berita->update([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'isi' => $validated['isi'],
            'gambar' => $gambarPath,
            'dokumen' => $validated['dokumen'] ?? $berita->dokumen,
            'published' => $validated['published'] ?? false,
        ]);

        $berita->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.publikasi.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->ensureAdminOrOperator();

        if ($berita->gambar && ! Str::startsWith($berita->gambar, ['http://', 'https://'])) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->tags()->detach();
        $berita->delete();

        return redirect()->route('admin.publikasi.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function tagIndex()
    {
        $this->ensureAdminOrOperator();

        $tags = Tag::latest()->get();

        return view('admin.publikasi.tag.index', compact('tags'));
    }

    public function tagCreate()
    {
        $this->ensureAdminOrOperator();

        return view('admin.publikasi.tag.create');
    }

    public function tagStore(Request $request)
    {
        $this->ensureAdminOrOperator();

        $validated = $request->validate([
            'tagline' => 'required|string|max:255|unique:tag,tagline',
        ]);

        Tag::create([
            'tagline' => $validated['tagline'],
        ]);

        return redirect()->route('admin.publikasi.tag.index')->with('success', 'Tag berhasil dibuat.');
    }

    public function tagEdit(Tag $tag)
    {
        $this->ensureAdminOrOperator();

        return view('admin.publikasi.tag.edit', compact('tag'));
    }

    public function tagUpdate(Request $request, Tag $tag)
    {
        $this->ensureAdminOrOperator();

        $validated = $request->validate([
            'tagline' => 'required|string|max:255|unique:tag,tagline,' . $tag->id,
        ]);

        $tag->update(['tagline' => $validated['tagline']]);

        return redirect()->route('admin.publikasi.tag.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function tagDestroy(Tag $tag)
    {
        $this->ensureAdminOrOperator();

        $tag->beritas()->detach();
        $tag->delete();

        return redirect()->route('admin.publikasi.tag.index')->with('success', 'Tag berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'dokumen' => 'nullable|string|max:255',
            'dokumen_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
            'published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tag,id',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_file')) {
            $gambarPath = $request->file('gambar_file')->store('berita', 'public');
        } elseif ($request->filled('gambar')) {
            $gambarPath = $request->input('gambar');
        }

        if ($request->hasFile('dokumen_file')) {
            $validated['dokumen'] = $request->file('dokumen_file')->store('dokumen', 'public');
        }

        $slug = Str::slug($validated['judul']);
        if ($slug === '') {
            $slug = 'berita';
        }

        $originalSlug = $slug;
        $counter = 1;

        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $berita = Berita::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'isi' => $validated['isi'],
            'gambar' => $gambarPath,
            'dokumen' => $validated['dokumen'] ?? null,
            'published' => $validated['published'] ?? false,
            'author_id' => Auth::id(),
        ]);

        if (! empty($validated['tags'])) {
            $berita->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.publikasi.berita.index')->with('success', 'Berita berhasil dibuat.');
    }
}
