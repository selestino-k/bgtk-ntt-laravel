<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Static pages --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/ppid') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ult/sarana-prasarana') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/zi-wbk/area-perubahan') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/ssd') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ url('/publikasi/berita-terkini') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/publikasi/pengumuman') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/publikasi/dokumen') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Dynamic profile pages --}}
    @foreach ($profiles as $profile)
    <url>
        <loc>{{ url('/profil/' . $profile->slug) }}</loc>
        <lastmod>{{ $profile->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- Dynamic berita (news) pages --}}
    @foreach ($beritas as $berita)
    <url>
        <loc>{{ url('/publikasi/berita-terkini/' . $berita->slug) }}</loc>
        <lastmod>{{ $berita->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach

</urlset>
