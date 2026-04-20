@extends('home.layouts.app')

@section('title', 'Berita Terkini | BGTK Provinsi NTT')

@section('content')
@include('home.partials.header')

<div id="berita-terkini" class="mt-20 w-full px-4 md:px-10 font-montserrat">
    <main class="relative z-10 py-10 md:flex gap-10 w-full">

        {{-- Main content --}}
        <div class="w-full md:w-5/6">
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-8 text-primary">
                Berita Terkini
            </h1>

            @if($beritas->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-base-content/50">
                    <i class="fa-regular fa-newspaper text-5xl mb-4"></i>
                    <p class="text-lg">Tidak ada berita yang ditemukan.</p>
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
                            // If isi is TipTap JSON, extract plain text
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

                        <a href="{{ route('home.berita.show', $berita) }}"
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
                                    <i class="fa-regular fa-image text-4xl text-base-content/20"></i>
                                </figure>
                            @endif

                            <div class="card-body p-5 gap-2">
                                {{-- Tags --}}
                                @if($berita->tags->isNotEmpty())
                                    <div class="flex flex-wrap gap-1 mb-1">
                                        @foreach($berita->tags->take(3) as $tag)
                                            <span class="badge badge-sm badge-outline text-primary border-primary/40">{{ $tag->tagline }}</span>
                                        @endforeach
                                    </div>
                                @endif

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
                    <div class="flex justify-center gap-2 mt-10 font-semibold">
                        {{-- Previous --}}
                        @if($beritas->onFirstPage())
                            <button class="btn btn-sm btn-outline" disabled>Sebelumnya</button>
                        @else
                            <a href="{{ $beritas->previousPageUrl() }}" class="btn btn-sm btn-outline">Sebelumnya</a>
                        @endif

                        {{-- Page numbers --}}
                        @foreach(range(1, $beritas->lastPage()) as $page)
                            <a href="{{ $beritas->url($page) }}"
                               class="btn btn-sm {{ $beritas->currentPage() === $page ? 'btn-primary' : 'btn-outline' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        {{-- Next --}}
                        @if($beritas->hasMorePages())
                            <a href="{{ $beritas->nextPageUrl() }}" class="btn btn-sm btn-outline">Selanjutnya</a>
                        @else
                            <button class="btn btn-sm btn-outline" disabled>Selanjutnya</button>
                        @endif
                    </div>
                @endif
            @endif
        </div>

        {{-- Tag sidebar --}}
        <aside class="w-full md:w-1/6 mt-10 md:mt-0">
            <h2 class="text-md md:text-xl font-semibold tracking-tight mb-4 text-primary">
                Tag Berita
            </h2>
            <div class="flex flex-wrap md:flex-col gap-2">
                <a href="{{ route('home.berita.index') }}"
                   class="badge {{ !$tagId ? 'badge-primary' : 'badge-ghost' }} font-semibold py-3 px-3 cursor-pointer">
                    Semua
                </a>
                @foreach($tags as $tag)
                    <a href="{{ route('home.berita.index', ['tag' => $tag->id]) }}"
                       class="badge {{ (int)$tagId === $tag->id ? 'badge-primary' : 'badge-ghost' }} font-semibold py-3 px-3 cursor-pointer">
                        {{ $tag->tagline }}
                    </a>
                @endforeach
            </div>
        </aside>

    </main>
</div>

@include('home.partials.footer')
@endsection
