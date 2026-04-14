<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Replace these with Eloquent queries once models are set up
    $carouselPhotos = [];
    $latestPosts    = [];
    $documents      = [];
    $pengumuman     = [];

    return view('home', compact('carouselPhotos', 'latestPosts', 'documents', 'pengumuman'));
});
