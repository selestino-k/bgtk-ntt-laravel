@extends('admin.layouts.app')

@section('title', 'Slideshow')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Slideshow</h1>
        </div>
        <a href="{{ route('admin.slideshow.create') }}" class="btn btn-primary gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Slide</span>
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

    @if($slideshows->isEmpty())
        <div class="card border border-base-300 bg-base-100">
            <div class="card-body items-center text-center py-12">
                <i class="fa-solid fa-images text-4xl text-base-content/30 mb-3"></i>
                <p class="text-base-content/60">Belum ada slide. Tambahkan slide baru sekarang.</p>
                <a href="{{ route('admin.slideshow.create') }}" class="btn btn-primary mt-4 gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Slide
                </a>
            </div>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($slideshows as $slide)
                <div class="card border border-base-300 shadow-sm bg-base-100 transition hover:-translate-y-1">
                    {{-- Thumbnail --}}
                    @if($slide->gambar_url)
                        <figure class="h-44 overflow-hidden rounded-t-2xl">
                            <img src="{{ $slide->gambar_url }}"
                                 alt="{{ $slide->judul ?? 'Slide ' . $slide->urutan }}"
                                 class="w-full h-full object-cover">
                        </figure>
                    @else
                        <div class="h-44 bg-base-200 flex items-center justify-center rounded-t-2xl">
                            <i class="fa-solid fa-image text-3xl text-base-content/30"></i>
                        </div>
                    @endif

                    <div class="card-body p-5">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="badge {{ $slide->is_active ? 'badge-success' : 'badge-ghost' }} badge-sm font-semibold uppercase">
                                {{ $slide->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span class="text-xs text-base-content/60">Urutan: <span class="font-semibold text-primary text-lg">{{ $slide->urutan }}</span></span>
                        </div>

                        @if($slide->judul)
                            <h2 class="card-title text-base">{{ $slide->judul }}</h2>
                        @endif

                        @if($slide->deskripsi)
                            <p class="text-sm text-base-content/70 line-clamp-2">{{ $slide->deskripsi }}</p>
                        @endif

                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="{{ route('admin.slideshow.edit', $slide) }}"
                               class="btn btn-sm btn-outline gap-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span class="hidden sm:inline">Edit</span>
                            </a>
                            <label for="modal-delete-{{ $slide->id }}" class="btn btn-sm btn-error gap-1">
                                <i class="fa-solid fa-trash"></i>
                                <span class="hidden sm:inline">Hapus</span>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Delete confirmation modals --}}
        @foreach($slideshows as $slide)
            <input type="checkbox" id="modal-delete-{{ $slide->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus slide <strong>{{ $slide->judul ?? 'Urutan ' . $slide->urutan }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $slide->id }}" class="btn">Batal</label>
                        <form action="{{ route('admin.slideshow.destroy', $slide) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $slide->id }}"></label>
            </div>
        @endforeach
    @endif

</div>
@endsection
