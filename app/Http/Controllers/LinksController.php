<?php

namespace App\Http\Controllers;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{

    private function ensureAdmin(): void
    {
        abort_if(!Auth::check() || Auth::user()->role !== 'admin', 403);
    }

    private function ensureLinkNotProtected(Links $link): void
    {
        $url = strtolower($link->url);
        abort_if(
            strtolower($link->nama) === 'youtube iframe' ||
            str_contains($url, 'youtube.com') ||
            str_contains($url, 'youtu.be'),
            403,
            'Link ini tidak dapat diubah atau dihapus.'
        );
    }

    public function index()
    {
        $this->ensureAdmin();
        $links = Links::all();
        return view('admin.links.index', compact('links'));
    }
    
    public function create()
    {
        $this->ensureAdmin();
        return view('admin.links.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        Links::create([
            'nama' => $request->nama,
            'url' => $request->url,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil ditambahkan.');
    }

    public function edit(Links $link)
    {
        $this->ensureAdmin();
        return view('admin.links.edit', compact('link'));
    }

    public function update(Request $request, Links $link)
    {
        $this->ensureAdmin();
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $link->update([
            'nama' => $request->nama,
            'url' => $request->url,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.links.index')->with('success', 'Link berhasil diperbarui.');
    }

    public function destroy(Links $link)
    {
        $this->ensureAdmin();
        $this->ensureLinkNotProtected($link);
        $link->delete();
        return redirect()->route('admin.links.index')->with('success', 'Link berhasil dihapus.');   
    }

    public function youtubeIframe(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $url = $request->input('url');
        $videoId = $this->extractYouTubeVideoId($url);

        if ($videoId) {
            $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
            return response()->json(['iframe' => $iframe]);
        } else {
            return response()->json(['error' => 'URL YouTube tidak valid.'], 400);
        }
    }

    private function extractYouTubeVideoId($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
}
