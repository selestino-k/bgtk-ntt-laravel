@extends('admin.layouts.app')

@section('title', 'Daftar Dokumen')

@section('content')
    <div class="p-6 md:p-8 font-montserrat">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm text-base-content/60">Publikasi: Dokumen</p>
                <h1 class="text-3xl sm:text-4xl font-bold text-primary">Daftar Dokumen</h1>
            </div>
            @auth
                @if (in_array(auth()->user()->role, ['admin', 'operator']))
                    <a href="{{ route('admin.publikasi.dokumen.create') }}" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Dokumen</span>
                    </a>
                @endif
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-6">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($dokumens->isEmpty())
            <div class="card border border-base-300 bg-base-100">
                <div class="card-body items-center text-center">
                    <p class="text-base-content/60">Belum ada dokumen.</p>
                </div>
            </div>
        @else
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                @auth
                                    @if (in_array(auth()->user()->role, ['admin', 'operator']))
                                        <th>Aksi</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumens as $dokumen)
                                @php
                                    $fileUrl = \Illuminate\Support\Str::startsWith($dokumen->file_url, [
                                        'http://',
                                        'https://',
                                    ])
                                        ? $dokumen->file_url
                                        : asset('storage/' . $dokumen->file_url);
                                    $bytes = $dokumen->file_size;
                                    $units = ['B', 'KB', 'MB', 'GB'];
                                    $i = 0;
                                    while ($bytes >= 1024 && $i < count($units) - 1) {
                                        $bytes /= 1024;
                                        $i++;
                                    }
                                    $fileSize = round($bytes, 2) . ' ' . $units[$i];
                                @endphp
                                <tr>
                                    <td class="font-medium">{{ $dokumen->judul }}</td>
                                    <td class="text-base-content/70">{{ $dokumen->deskripsi ?? '-' }}</td>
                                    <td>
                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener"
                                            class="link link-primary">Unduh</a>
                                    </td>
                                    <td class="text-base-content/70">{{ $dokumen->file_name }}</td>
                                    <td class="text-base-content/70">{{ $fileSize }}</td>
                                    <td class="text-base-content/70">{{ $dokumen->file_type }}</td>
                                    <td class="text-base-content/70">{{ $dokumen->kategori ?? '-' }}</td>
                                    @auth
                                        @if (in_array(auth()->user()->role, ['admin', 'operator']))
                                            <td>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('admin.publikasi.dokumen.edit', $dokumen) }}"
                                                        class="btn btn-sm btn-outline">Edit</a>
                                                    <form action="{{ route('admin.publikasi.dokumen.destroy', $dokumen) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Hapus dokumen ini?')"
                                                            class="btn btn-sm btn-error">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
@endsection
