@extends('home.layouts.app')

@section('title', 'Pengumuman | BGTK Provinsi NTT')

@section('content')
@include('home.partials.header')

<div id="pengumuman" class="mt-20 w-full px-4 md:px-10 font-montserrat">
    <main class="relative z-10 py-10 w-full">

        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-8 text-primary">
            Pengumuman
        </h1>

        @if($beritas->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-base-content/50">
                <i class="fa-solid fa-bullhorn text-5xl mb-4"></i>
                <p class="text-lg">Tidak ada pengumuman yang ditemukan.</p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($beritas as $berita)
                    @php
                        $gambarUrl = $berita->gambar
                            ? (\Illuminate\Support\Str::startsWith($berita->gambar, ['http://', 'https://'])
                                ? $berita->gambar
                                : asset('storage/' . $berita->gambar))
                            : null;
                        $isiText = strip_tags($berita->isi);
                        if (str_starts_with(ltrim($berita->isi), '{')) {
                            try {
                                $decoded = json_decode($berita->isi, true);
                                $isiText = '';
                                $extractText = function ($nodes) use (&$extractText, &$isiText) {
                                    foreach ($nodes as $node) {
                                        if (isset($node['text'])) {
                                            $isiText .= $node['text'] . ' ';
                                        }
                                        if (isset($node['content'])) {
                                            $extractText($node['content']);
                                        }
                                    }
                                };
                                if (isset($decoded['content'])) {
                                    $extractText($decoded['content']);
                                }
                            } catch (\Throwable $e) {
                                $isiText = strip_tags($berita->isi);
                            }
                        }
                        $excerpt = \Illuminate\Support\Str::limit(trim($isiText), 120);
                    @endphp

                    <a href="{{ route('publikasi.berita.show', $berita->slug) }}"
                       class="card bg-base-100 border border-base-300 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 group">
                        @if($gambarUrl)
                            <figure class="overflow-hidden h-44 bg-base-200">
                                <img src="{{ $gambarUrl }}"
                                     alt="{{ $berita->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            </figure>
                        @else
                            <figure class="h-44 bg-base-200 flex items-center justify-center">
                                <i class="fa-solid fa-bullhorn text-4xl text-base-content/20"></i>
                            </figure>
                        @endif

                        <div class="card-body p-5 gap-2">
                            {{-- Title --}}
                            <h2 class="font-bold text-base leading-snug text-base-content line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $berita->judul }}
                            </h2>

                            {{-- Excerpt --}}
                            <p class="text-sm text-base-content/60 line-clamp-3">{{ $excerpt }}</p>

                            {{-- Meta --}}
                            <div class="flex items-center justify-between mt-auto pt-3 border-t border-base-200">
                                @if($berita->author)
                                    <span class="text-xs text-base-content/50">{{ $berita->author->username }}</span>
                                @endif
                                <span class="text-xs text-base-content/50">
                                    {{ $berita->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($beritas->lastPage() > 1)
                <div class="flex justify-center gap-2 mt-10 font-semibold flex-wrap">
                    @if($beritas->onFirstPage())
                        <button class="btn btn-sm btn-outline" disabled>Sebelumnya</button>
                    @else
                        <a href="{{ $beritas->previousPageUrl() }}" class="btn btn-sm btn-outline">Sebelumnya</a>
                    @endif

                    @foreach(range(1, $beritas->lastPage()) as $page)
                        <a href="{{ $beritas->url($page) }}"
                           class="btn btn-sm {{ $beritas->currentPage() === $page ? 'btn-primary' : 'btn-outline' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($beritas->hasMorePages())
                        <a href="{{ $beritas->nextPageUrl() }}" class="btn btn-sm btn-outline">Selanjutnya</a>
                    @else
                        <button class="btn btn-sm btn-outline" disabled>Selanjutnya</button>
                    @endif
                </div>
            @endif
        @endif

    </main>
</div>

@include('home.partials.footer')
@endsection
