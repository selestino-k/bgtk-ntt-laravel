@extends('admin.layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Detail Berita</p>
            <h1 class="text-2xl sm:text-3xl font-bold text-primary">{{ $berita->judul }}</h1>
        </div>
        <div class="flex flex-wrap gap-2">
            @auth
            <div class="flex flex-wrap gap-2">
                @if(in_array(auth()->user()->role, ['admin', 'operator']))
                    <a href="{{ route('admin.publikasi.berita.edit', $berita) }}" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-pen"></i>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <form action="{{ route('admin.publikasi.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error gap-2">
                            <i class="fa-solid fa-trash"></i>
                            <span class="hidden sm:inline">Hapus</span>
                        </button>
                    </form>
                @endif
                </div>
            @endauth
        </div>
    </div>

    {{-- Meta info --}}
    <div class="card border border-base-300 bg-base-200 mb-6">
        <div class="card-body p-5 gap-2">
            <div class="flex flex-wrap items-center gap-3">
                <span class="badge {{ $berita->published ? 'badge-success' : 'badge-ghost' }} font-semibold uppercase">{{ $berita->published ? 'Published' : 'Draft' }}</span>
                <span class="text-sm text-base-content/60">{{ $berita->created_at->format('d M Y H:i') }}</span>
            </div>
            @if($berita->author)
                <p class="text-sm">Oleh <span class="font-semibold">{{ $berita->author->username }}</span></p>
            @endif
            <p class="text-sm text-base-content/60">Slug: <span class="font-medium">{{ $berita->slug }}</span></p>
        </div>
    </div>

    {{-- Tags --}}
    @if($berita->tags->isNotEmpty())
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($berita->tags as $tag)
                <span class="badge badge-outline">{{ $tag->tagline }}</span>
            @endforeach
        </div>
    @endif

    {{-- Dokumen --}}
    @if($berita->dokumen)
        @php
            $dokumenUrl = \Illuminate\Support\Str::startsWith($berita->dokumen, ['http://', 'https://'])
                ? $berita->dokumen
                : asset('storage/' . $berita->dokumen);
        @endphp
        <div class="card border border-base-300 bg-base-100 mb-6">
            <div class="card-body p-5">
                <p class="font-medium mb-2"><i class="fa-solid fa-file-lines mr-2"></i>Dokumen</p>
                <a href="{{ $dokumenUrl }}" target="_blank" rel="noopener" class="link link-primary text-sm">Lihat / Unduh dokumen</a>
            </div>
        </div>
    @endif

    {{-- Content --}}
    <div class="card border border-base-300 shadow-sm bg-base-100">
        <div class="card-body p-6 space-y-6">
            @if($berita->gambar)
                <div class="overflow-hidden rounded-xl border border-base-300">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="w-full object-cover">
                </div>
            @endif
            <div class="prose max-w-none">
                {!! nl2br(e($berita->isi)) !!}
            </div>
        </div>
    </div>

</div>
@endsection
