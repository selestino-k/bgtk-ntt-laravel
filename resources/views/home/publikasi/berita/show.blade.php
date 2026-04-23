@extends('home.layouts.app')

@section('title', $berita->judul . ' | BGTK Provinsi NTT')

@push('styles')
    @php
        $ogImage = $berita->gambar
            ? (\Illuminate\Support\Str::startsWith($berita->gambar, ['http://', 'https://'])
                ? $berita->gambar
                : asset('storage/' . $berita->gambar))
            : asset('images/assets/favicon.ico');
    @endphp
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $berita->judul }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($berita->isi), 160) }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="BGTK Provinsi NTT">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $berita->judul }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($berita->isi), 160) }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endpush

@section('content')
@include('home.partials.header')

<div class="mt-20 w-full px-4 md:px-10 font-montserrat">
    <main class="relative z-10 py-10 max-w-5xl mx-auto">

        {{-- Breadcrumb --}}
        <div class="text-sm text-base-content/50 mb-6">
            <a href="/" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('publikasi.berita.berita') }}" class="hover:text-primary">Berita Terkini</a>
            <span class="mx-2">/</span>
            <span class="text-primary">{{ $berita->judul }}</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Main Content --}}
            <article class="flex-1 min-w-0">

                {{-- Tags --}}
                @if ($berita->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($berita->tags as $tag)
                            <span class="badge badge-outline text-xs">{{ $tag->tagline }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Title --}}
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-3 text-primary">
                    {{ $berita->judul }}
                </h1>

                {{-- Meta --}}
                <div class="flex items-center gap-3 text-sm text-base-content/50 mb-6">
                    @if ($berita->author)
                        <span>{{ $berita->author->username ?? $berita->author->name }}</span>
                        <span>&bull;</span>
                    @endif
                    <span>{{ $berita->created_at->translatedFormat('d F Y') }}</span>
                    @if (($viewCounts['total'] ?? 0) > 0)
                        <span>&bull;</span>
                        <span title="{{ ($viewCounts['desktop'] ?? 0) }} desktop &bull; {{ ($viewCounts['mobile'] ?? 0) }} mobile">
                            <i class="fa-regular fa-eye mr-1"></i>{{ number_format($viewCounts['total'] ?? 0) }} kali dilihat
                        </span>
                    @endif
                </div>

                {{-- Image --}}
                @if ($berita->gambar)
                    @php
                        $gambarUrl = \Illuminate\Support\Str::startsWith($berita->gambar, ['http://', 'https://'])
                            ? $berita->gambar
                            : asset('storage/' . $berita->gambar);
                    @endphp
                    <div class="mb-8">
                        <img src="{{ $gambarUrl }}" alt="{{ $berita->judul }}"
                             class="w-full h-full object-cover rounded-xl shadow-md">
                    </div>
                @endif

                {{-- Content --}}
                <div class="prose prose-lg max-w-none font-inter">
                    {!! nl2br(e($berita->isi)) !!}
                </div>

            </article>

            {{-- Sidebar --}}
            @if ($recentBeritas->isNotEmpty())
                <aside class="lg:w-72 shrink-0">
                    <h2 class="text-lg font-bold text-primary mb-4">Berita Terkini</h2>
                    <ul class="space-y-4">
                        @foreach ($recentBeritas as $recent)
                            <li>
                                <a href="{{ route('publikasi.berita.show', $recent->slug) }}"
                                   class="flex gap-3 group">
                                    @if ($recent->gambar)
                                        @php
                                            $recentImg = \Illuminate\Support\Str::startsWith($recent->gambar, ['http://', 'https://'])
                                                ? $recent->gambar
                                                : asset('storage/' . $recent->gambar);
                                        @endphp
                                        <img src="{{ $recentImg }}" alt="{{ $recent->judul }}"
                                             class="w-20 h-14 object-cover rounded-lg shrink-0">
                                    @endif
                                    <div>
                                        <p class="text-sm font-semibold group-hover:text-primary line-clamp-2 leading-snug">
                                            {{ $recent->judul }}
                                        </p>
                                        <p class="text-xs text-base-content/50 mt-1">
                                            {{ $recent->created_at->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            @endif

        </div>
    </main>
</div>

@include('home.partials.footer')

@endsection
