<?php

namespace App\Http\Controllers;

use App\Models\PertanyaanSSD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PertanyaanSSDController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_if(!Auth::check() || Auth::user()->role !== 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();
        $pertanyaans = PertanyaanSSD::orderBy('urutan')->get();
        return view('admin.ssd.index', compact('pertanyaans'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('admin.ssd.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'urutan'     => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        PertanyaanSSD::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'urutan'     => $request->urutan ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.ssd.index')->with('success', 'Pertanyaan SSD berhasil ditambahkan.');
    }

    public function edit(PertanyaanSSD $ssd)
    {
        $this->ensureAdmin();
        return view('admin.ssd.edit', compact('ssd'));
    }

    public function update(Request $request, PertanyaanSSD $ssd)
    {
        $this->ensureAdmin();
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'urutan'     => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $ssd->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'urutan'     => $request->urutan ?? $ssd->urutan,
            'is_active'  => $request->boolean('is_active', $ssd->is_active),
        ]);

        return redirect()->route('admin.ssd.index')->with('success', 'Pertanyaan SSD berhasil diperbarui.');
    }

    public function destroy(PertanyaanSSD $ssd)
    {
        $this->ensureAdmin();
        $ssd->delete();
        return redirect()->route('admin.ssd.index')->with('success', 'Pertanyaan SSD berhasil dihapus.');
    }
}
