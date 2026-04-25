<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_if(!Auth::check() || Auth::user()->role !== 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();
        $slideshows = Slideshow::orderBy('urutan', 'asc')->get();
        return view('admin.slideshow.index', compact('slideshows'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('admin.slideshow.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();
        $request->validate([
            'judul'   => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'   => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('gambar')->store('slideshows', 'public');

        Slideshow::create([
            'judul'     => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'gambar'     => $path,
            'urutan'     => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow berhasil ditambahkan.');
    }

    public function edit(Slideshow $slideshow)
    {
        $this->ensureAdmin();
        return view('admin.slideshow.edit', compact('slideshow'));
    }

    public function update(Request $request, Slideshow $slideshow)
    {
        $this->ensureAdmin();
        $request->validate([
            'judul'   => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'   => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'urutan'     => $request->urutan ?? $slideshow->urutan,
            'is_active' => $request->boolean('is_active', $slideshow->is_active),
        ];

        if ($request->hasFile('gambar')) {
            if ($slideshow->gambar && Storage::disk('public')->exists($slideshow->gambar)) {
                Storage::disk('public')->delete($slideshow->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('slideshows', 'public');
        }

        $slideshow->update($data);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow berhasil diperbarui.');
    }

    public function destroy(Slideshow $slideshow)
    {
        $this->ensureAdmin();
        if ($slideshow->gambar && Storage::disk('public')->exists($slideshow->gambar)) {
            Storage::disk('public')->delete($slideshow->gambar);
        }

        $slideshow->delete();

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow berhasil dihapus.');
    }
}
