<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    private function generateUniqueSlug(string $judul, ?int $excludeId = null): string
    {
        $slug = Str::slug($judul);
        if ($slug === '') {
            $slug = 'profil';
        }

        $originalSlug = $slug;
        $counter = 1;

        while (Profile::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    private function routePrefix(): string
    {
        return request()->segment(1) === 'admin' ? 'admin' : 'operator';
    }

    private function viewPath(string $view): string
    {
        return $this->routePrefix() . '.profil.' . $view;
    }

    private function routeName(string $name): string
    {
        return $this->routePrefix() . '.profil.' . $name;
    }

    private function authorizeRole(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeRole();

        $profiles = Profile::latest()->paginate(10);

        return view($this->viewPath('index'), [
            'profiles' => $profiles,
            'routePrefix' => $this->routePrefix(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeRole();

        return view($this->viewPath('create'), [
            'routePrefix' => $this->routePrefix(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeRole();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'isi_konten' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'gambar_file.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
            'gambar_file.image' => 'File harus berupa gambar.',
            'gambar_file.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
        ]);

        $gambar = $validated['gambar'] ?? null;

        if ($request->hasFile('gambar_file')) {
            $gambar = $request->file('gambar_file')->store('profiles', 'public');
        }

        $slug = $this->generateUniqueSlug($validated['judul']);

        Profile::create([
            'judul'      => $validated['judul'],
            'slug'       => $slug,
            'sub_judul'  => $validated['sub_judul'] ?? null,
            'isi_konten' => $validated['isi_konten'],
            'gambar'     => $gambar,
        ]);

        return redirect()->route($this->routeName('index'))->with('status', 'Profil berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $tags = Tag::orderBy('tagline')->get();
        return view('home.profil.show', compact('profile', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $this->authorizeRole();

        return view($this->viewPath('edit'), [
            'profile' => $profile,
            'routePrefix' => $this->routePrefix(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorizeRole();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'isi_konten' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'gambar_file.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
            'gambar_file.image' => 'File harus berupa gambar.',
            'gambar_file.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
        ]);

        $gambar = $validated['gambar'] ?? $profile->gambar;

        if ($request->hasFile('gambar_file')) {
            if ($profile->gambar && !Str::startsWith($profile->gambar, ['http://', 'https://']) && Storage::disk('public')->exists($profile->gambar)) {
                Storage::disk('public')->delete($profile->gambar);
            }

            $gambar = $request->file('gambar_file')->store('profil', 'public');
        }

        $slug = $profile->judul !== $validated['judul']
            ? $this->generateUniqueSlug($validated['judul'], $profile->id)
            : $profile->slug;

        $profile->update([
            'judul'      => $validated['judul'],
            'slug'       => $slug,
            'sub_judul'  => $validated['sub_judul'] ?? null,
            'isi_konten' => $validated['isi_konten'],
            'gambar'     => $gambar,
        ]);

        return redirect()->route($this->routeName('index'))->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $this->authorizeRole();

        if ($profile->gambar && !Str::startsWith($profile->gambar, ['http://', 'https://']) && Storage::disk('public')->exists($profile->gambar)) {
            Storage::disk('public')->delete($profile->gambar);
        }

        $profile->delete();

        return redirect()->route($this->routeName('index'))->with('status', 'Profil berhasil dihapus.');
    }
}
