<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.tailwind');

        View::composer('home.partials.header', function ($view) {
            $view->with('profiles', Profile::orderBy('id')->get());
        });

        View::composer('home.partials.footer', function ($view) {
            $view->with('tags', Tag::whereRaw('LOWER(tagline) != ?', ['pengumuman'])->orderBy('tagline')->get());
        });
    }
}
