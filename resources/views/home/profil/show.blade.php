@extends('home.layouts.app')

@section('title', $profile->judul . ' | BGTK Provinsi NTT')

@section('content')
@include('home.partials.header')

<div class="mt-20 w-full px-4 md:px-10 font-montserrat">
    <main class="relative z-10 py-10 max-w-4xl mx-auto">

        {{-- Breadcrumb --}}
        <div class="text-sm text-base-content/50 mb-4">
            <a href="/" class="hover:text-primary">Beranda</a>
            <span class="mx-2">
                <i class="fas fa-chevron-right text-xs"></i>
            </span>
            <span class="text-primary">{{ $profile->judul }}</span>
        </div>

        {{-- Header --}}
        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 text-primary">
            {{ $profile->judul }}
        </h1>

        @if ($profile->sub_judul)
            <p class="text-lg text-base-content/60 mb-8">{{ $profile->sub_judul }}</p>
        @endif

        {{-- Image --}}
        @if ($profile->gambar)
            @php
                $gambarUrl = \Illuminate\Support\Str::startsWith($profile->gambar, ['http://', 'https://'])
                    ? $profile->gambar
                    : asset('storage/' . $profile->gambar);
            @endphp
            <div class="mb-8">
                <img src="{{ $gambarUrl }}" alt="{{ $profile->judul }}"
                     class="w-full h-full object-cover rounded-xl shadow-md">
            </div>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($profile->isi_konten)) !!}
        </div>

    </main>
</div>

@include('home.partials.footer')

@endsection
