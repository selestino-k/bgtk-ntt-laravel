@extends('home.layouts.app')

@section('content')
@include('home.partials.header')

<head>
    <title>Pengumuman | BGTK Provinsi NTT</title>
    <meta name="description" content="Halaman Pengumuman | BGTK Provinsi NTT">
</head>

<div id="pengumuman" class="mt-20 flex place-items-start w-full px-4 md:px-10">
    <main class="relative z-10 p-4 md:p-8 w-full">

        <h2 class="text-3xl md:text-5xl font-bold sm:tracking-tight mb-10 md:mb-8 font-montserrat text-primary">
            Pengumuman
        </h2>

        @if($beritas->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-500 font-inter">Tidak ada pengumuman yang ditemukan.</p>
            </div>
        @else
            <div class="flex flex-col gap-4 w-full">
                @foreach($beritas as $berita)
                    <a href="{{ route('publikasi.berita.show', $berita->slug) }}"
                       class="flex gap-4 bg-white dark:bg-base-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 dark:border-base-300 p-4 group">
                        @if($berita->gambar)
                            <img src="{{ $berita->gambar }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-24 h-24 object-cover rounded-lg flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-base-300 dark:to-base-200 flex items-center justify-center rounded-lg flex-shrink-0">
                                <i class="fa-solid fa-bullhorn text-2xl text-primary/30"></i>
                            </div>
                        @endif
                        <div class="flex flex-col flex-1 min-w-0">
                            <h3 class="font-montserrat font-semibold text-base text-gray-900 dark:text-base-content mb-1 line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $berita->judul }}
                            </h3>
                            <div class="flex items-center gap-2 font-inter text-gray-400 text-xs mt-auto">
                                @if($berita->author)
                                    <span>{{ $berita->author->username }}</span>
                                    <span>&middot;</span>
                                @endif
                                <span>{{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($beritas->lastPage() > 1)
                <div class="flex justify-center gap-2 mt-8 font-montserrat font-semibold flex-wrap">
                    @if(!$beritas->onFirstPage())
                        <a href="{{ $beritas->previousPageUrl() }}"
                           class="btn btn-sm btn-outline">
                            Sebelumnya
                        </a>
                    @endif

                    @foreach($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                           class="btn btn-sm {{ $beritas->currentPage() === $page ? 'btn-primary' : 'btn-outline' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($beritas->hasMorePages())
                        <a href="{{ $beritas->nextPageUrl() }}"
                           class="btn btn-sm btn-outline">
                            Selanjutnya
                        </a>
                    @endif
                </div>
            @endif
        @endif

    </main>
</div>

@include('home.partials.footer')
@endsection
