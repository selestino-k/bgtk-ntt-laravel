<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Profile;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $beritas = Berita::where('published', true)
            ->select('slug', 'updated_at')
            ->latest('updated_at')
            ->get();

        $profiles = Profile::select('slug', 'updated_at')->get();

        $content = view('sitemap', compact('beritas', 'profiles'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
