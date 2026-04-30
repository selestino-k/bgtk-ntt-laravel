@extends('admin.layouts.app')

@section('title', 'Pengumuman')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-base-content/60">Publikasi</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Pengumuman</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.publikasi.berita.index') }}" class="btn btn-outline">Berita Terkini</a>
            @auth
                @if(in_array(auth()->user()->role, ['admin', 'operator']))
                    <a href="{{ route('admin.publikasi.berita.create') }}" class="btn btn-primary">Tambah Berita Baru</a>
                @endif
            @endauth
        </div>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.publikasi.pengumuman.index') }}" class="mb-6">
        <div class="join w-full max-w-md">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul pengumuman..." class="input input-bordered join-item w-full" />
            <button type="submit" class="btn btn-primary join-item">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            @if(!empty($search))
                <a href="{{ route('admin.publikasi.pengumuman.index') }}" class="btn btn-ghost join-item">Reset</a>
            @endif
        </div>
    </form>

    @if($beritas->isEmpty())
        <div class="alert">
            <span>Belum ada pengumuman. Pastikan ada berita dengan tag <strong>Pengumuman</strong>.</span>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($beritas as $berita)
                <article class="card border border-base-300 shadow-sm bg-base-100">
                    <div class="card-body">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <span class="badge badge-sm {{ $berita->published ? 'badge-success' : 'badge-ghost' }} font-semibold uppercase">{{ $berita->published ? 'Diterbitkan' : 'Draft' }}</span>
                            <span class="text-xs text-base-content/60">{{ $berita->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                        </div>
                        <h2 class="card-title text-lg">{{ $berita->judul }}</h2>
                        @if($berita->author)
                            <p class="text-sm text-base-content/60">Oleh {{ $berita->author->username }}</p>
                        @endif
                        <p class="text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($berita->isi, 140, '...') }}</p>
                        <div class="card-actions justify-between items-center mt-2">
                            <a href="{{ route('admin.publikasi.berita.detail', $berita) }}" class="btn btn-sm btn-outline">Lihat Detail</a>
                            <span class="text-xs text-base-content/60">{{ $berita->slug }}</span>
                        </div>
                    </div>
                </article>
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
