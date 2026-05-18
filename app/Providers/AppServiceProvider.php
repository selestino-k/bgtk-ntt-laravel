<?php

namespace App\Providers;

use App\Models\Links;
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

        View::composer(['home.partials.header', 'home.partials.nav-mobile'], function ($view) {
            $view->with('profiles', Profile::orderBy('id')->get());
            $view->with('appLinks', Links::where('is_active', true)->where('nama', '!=', 'YouTube iframe')->orderBy('id')->get());
        });

        View::composer('home.partials.sambutan', function ($view) {
            $youtubeLink = Links::where('nama', 'YouTube iframe')->where('is_active', true)->first();
            $embedUrl = null;
            if ($youtubeLink?->url) {
                $url = $youtubeLink->url;
                // Already an embed URL
                if (preg_match('#youtube\.com/embed/([a-zA-Z0-9_-]{11})#', $url, $m)) {
                    $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
                // Standard watch URL or youtu.be short link
                } elseif (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
                    $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
                }
            }
            $view->with('youtubeEmbedUrl', $embedUrl);
        });

        View::composer('home.partials.footer', function ($view) {
            $view->with('tags', Tag::whereRaw('LOWER(tagline) != ?', ['pengumuman'])->orderBy('tagline')->get());
        });
    }
}
