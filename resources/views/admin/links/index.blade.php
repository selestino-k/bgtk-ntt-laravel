@extends('admin.layouts.app')

@section('title', 'Links')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Links</h1>
            <p class="text-sm text-base-content/60">Kelola link eksternal yang ditampilkan di website, khususnya pada menu Aplikasi pada header website.</p>
        </div>
        <a href="{{ route('admin.links.create') }}" class="btn btn-primary gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Link</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-6">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($links->isEmpty())
        <div class="card border border-base-300 bg-base-100">
            <div class="card-body items-center text-center py-12">
                <i class="fa-solid fa-link text-4xl text-base-content/30 mb-3"></i>
                <p class="text-base-content/60">Belum ada link. Tambahkan link baru sekarang.</p>
                <a href="{{ route('admin.links.create') }}" class="btn btn-primary mt-4 gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Link
                </a>
            </div>
        </div>
    @else
        <div class="card border border-base-300 shadow-sm bg-base-100">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="w-8">#</th>
                            <th>Nama</th>
                            <th>URL</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td class="text-base-content/50">{{ $loop->iteration }}</td>
                                <td class="font-medium">{{ $link->nama }}</td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                       class="link link-primary text-sm truncate max-w-xs block">
                                        {{ $link->url }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $link->is_active ? 'badge-success' : 'badge-ghost' }} badge-sm font-semibold uppercase">
                                        {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.links.edit', $link) }}"
                                           class="btn btn-sm btn-outline gap-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        @if($link->nama === 'YouTube iframe' || str_contains(strtolower($link->url), 'youtube.com') || str_contains(strtolower($link->url), 'youtu.be'))
                                        <button class="btn btn-sm btn-error gap-1" disabled title="Link YouTube tidak dapat dihapus">
                                            <i class="fa-solid fa-trash"></i>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </button>
                                        @else
                                        <label for="modal-delete-{{ $link->id }}" class="btn btn-sm btn-error gap-1">
                                            <i class="fa-solid fa-trash"></i>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </label>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Delete confirmation modals --}}
        @foreach($links as $link)
            @if($link->nama === 'YouTube iframe' || str_contains(strtolower($link->url), 'youtube.com') || str_contains(strtolower($link->url), 'youtu.be'))
                @continue
            @endif
            <input type="checkbox" id="modal-delete-{{ $link->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus link <strong>{{ $link->nama }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $link->id }}" class="btn">Batal</label>
                        <form action="{{ route('admin.links.destroy', $link) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $link->id }}"></label>
            </div>
        @endforeach
    @endif

</div>
@endsection
