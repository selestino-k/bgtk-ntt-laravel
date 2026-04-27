@extends('admin.layouts.app')

@section('title', 'Berita Terkini')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Publikasi</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Berita Terkini</h1>
        </div>
        @auth
            @if(in_array(auth()->user()->role, ['admin', 'operator']))
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.publikasi.berita.create') }}" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Berita</span>
                    </a>
                    <a href="{{ route('admin.publikasi.tag.index') }}" class="btn btn-outline gap-2">
                        <i class="fa-solid fa-tags"></i>
                        <span class="hidden sm:inline">Tag</span>
                    </a>
                </div>
            @endif
        @endauth
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.publikasi.berita.index') }}" class="mb-6">
        <div class="join w-full max-w-md">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul berita..." class="input input-bordered join-item w-full" />
            <button type="submit" class="btn btn-primary join-item">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            @if(!empty($search))
                <a href="{{ route('admin.publikasi.berita.index') }}" class="btn btn-ghost join-item">Reset</a>
            @endif
        </div>
    </form>

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

    @if($beritas->isEmpty())
        <div class="card border border-base-300 bg-base-100">
            <div class="card-body items-center text-center">
                <p class="text-base-content/60">Belum ada berita. Tambahkan berita baru sekarang.</p>
            </div>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($beritas as $berita)
                <div class="card border border-base-300 shadow-sm bg-base-100 transition hover:-translate-y-1">
                    <div class="card-body p-5">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <span class="badge {{ $berita->published ? 'badge-success' : 'badge-ghost' }} badge-sm font-semibold uppercase">{{ $berita->published ? 'Diterbitkan' : 'Draft' }}</span>
                            <span class="text-xs text-base-content/60">{{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                        <h2 class="card-title text-base mb-2">{{ $berita->judul }}</h2>
                        @if($berita->author)
                            <p class="text-xs text-base-content/60 mb-2">Oleh {{ $berita->author->username }}</p>
                        @endif
                        <p class="text-sm text-base-content/80 mb-3">{{ \Illuminate\Support\Str::limit($berita->isi, 140, '...') }}</p>
                        @if($berita->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($berita->tags as $tag)
                                    <span class="badge badge-outline badge-sm font-medium">{{ $tag->tagline }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="card-actions justify-between items-center mt-auto">
                            <a href="{{ route('admin.publikasi.berita.detail', $berita) }}" class="btn btn-sm btn-outline">Lihat Detail</a>
                            <span class="text-xs text-base-content/50 truncate">{{ $berita->slug }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($beritas->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $beritas->links() }}
            </div>
        @endif
    @endif

</div>
@endsection