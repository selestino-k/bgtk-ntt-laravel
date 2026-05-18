<?php

namespace App\Http\Controllers;

use App\Models\ProgramPrioritas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramPrioritasController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_if(!auth()->check() || auth()->user()->role !== 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();
        $programPrioritas = ProgramPrioritas::all();
        return view('admin.program-prioritas.index', compact('programPrioritas'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('admin.program-prioritas.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'url'          => 'required|url|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'    => 'nullable|boolean',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('program-prioritas', 'public');
        }

        ProgramPrioritas::create([
            'nama_program' => $request->nama_program,
            'url'          => $request->url,
            'gambar'       => $gambarPath,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.program-prioritas.index')->with('success', 'Program Prioritas berhasil ditambahkan.');
    }

    public function edit(ProgramPrioritas $programPrioritas)
    {
        $this->ensureAdmin();
        return view('admin.program-prioritas.edit', compact('programPrioritas'));
    }

    public function update(Request $request, ProgramPrioritas $programPrioritas)
    {
        $this->ensureAdmin();
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'url'          => 'required|url|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'    => 'nullable|boolean',
        ]);

        $data = [
            'nama_program' => $request->nama_program,
            'url'          => $request->url,
            'is_active'    => $request->boolean('is_active', $programPrioritas->is_active),
        ];

        if ($request->hasFile('gambar')) {
            if ($programPrioritas->gambar
                && !Str::startsWith($programPrioritas->gambar, ['http://', 'https://'])
                && Storage::disk('public')->exists($programPrioritas->gambar)) {
                Storage::disk('public')->delete($programPrioritas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('program-prioritas', 'public');
        }

        $programPrioritas->update($data);

        return redirect()->route('admin.program-prioritas.index')->with('success', 'Program Prioritas berhasil diperbarui.');
    }

    public function destroy(ProgramPrioritas $programPrioritas)
    {
        $this->ensureAdmin();

        if ($programPrioritas->gambar
            && !Str::startsWith($programPrioritas->gambar, ['http://', 'https://'])
            && Storage::disk('public')->exists($programPrioritas->gambar)) {
            Storage::disk('public')->delete($programPrioritas->gambar);
        }

        $programPrioritas->delete();
        return redirect()->route('admin.program-prioritas.index')->with('success', 'Program Prioritas berhasil dihapus.');
    }
}