@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('partials.header')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BGTK NTT – Balai Guru dan Tenaga Kependidikan Provinsi NTT</title>
    <meta name="description" content="Website resmi Balai Guru Penggerak Provinsi Nusa Tenggara Timur.">

</head>

<div class="grid w-full overflow-x-hidden justify-items-center">

    @include('partials.carousel')

    @include('partials.sambutan')

    @include('partials.program')

    @include('partials.berita-carousel')


    @include('partials.dokumen-table')

</div>{{-- end grid wrapper --}}

@include('partials.footer')

@endsection
