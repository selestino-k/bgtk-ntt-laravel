<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Replace these with Eloquent queries once models are set up
    $carouselPhotos = [];
    $latestPosts    = [];
    $documents      = [];
    $pengumuman     = [];

    return view('(home).home', compact('carouselPhotos', 'latestPosts', 'documents', 'pengumuman'));
});

// Admin routes (views pending)
Route::prefix('admin')->name('admin.')->group(function () {
    //
});
