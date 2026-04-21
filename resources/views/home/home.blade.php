@extends('home.layouts.app')

@section('title', 'Balai Guru dan Tenaga Kependidikan Provinsi NTT')

@section('content')
@include('home.partials.header')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BGTK NTT – Balai Guru dan Tenaga Kependidikan Provinsi NTT</title>
    <meta name="description" content="Website resmi Balai Guru dan Tenaga Kependidikan Provinsi Nusa Tenggara Timur.">
    <meta name="keywords" content="BGTK NTT, Balai Guru dan Tenaga Kependidikan, Pendidikan NTT, Guru Penggerak, Pelatihan Guru, Inovasi Pendidikan, Program Pendidikan, Berita Pendidikan, Layanan Pendidikan, Pengumuman Pendidikan">
    <meta name="author" content="BGTK NTT">
    <meta property="og:title" content="BGTK NTT – Balai Guru dan Tenaga Kependidikan Provinsi NTT">
    <meta property="og:description" content="Website resmi Balai Guru dan Tenaga Kependidikan Provinsi Nusa Tenggara Timur.">
    <meta property="og:image" content="{{ asset('images/assets/opengraph-image.webp') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BGTK NTT – Balai Guru dan Tenaga Kependidikan Provinsi NTT">
    <meta name="twitter:description" content="Website resmi Balai Guru dan Tenaga Kependidikan Provinsi Nusa Tenggara Timur.">
    <meta name="twitter:image" content="{{ asset('images/assets/opengraph-image.webp') }}">
    <meta name="theme-color" content="#297bbf">
</head>

<div class="grid w-full overflow-x-hidden justify-items-center">

    @include('home.partials.carousel')

    @include('home.partials.sambutan')

    @include('home.partials.program')

    @include('home.partials.berita-carousel')

    @include('home.partials.dokumen-table')

</div>{{-- end grid wrapper --}}

@include('home.partials.footer')

@endsection
