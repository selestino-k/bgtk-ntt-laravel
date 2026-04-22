{{-- ============================================================
     BERITA TERKINI – DESKTOP (xl+)
     ============================================================ --}}
<section id="berita" class="hidden xl:flex items-start relative mb-20 mt-10 max-w-7xl w-full px-4 sm:px-8">
    <div class="relative z-10 flex flex-col gap-3 justify-center w-full">
        <div class="flex gap-6">

            {{-- News grid (3/4) --}}
            <div class="w-3/4">
                <h2 class="text-5xl font-semibold font-montserrat text-primary mb-3">
                    Berita Terkini
                </h2>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-6 font-inter">
                    Dapatkan informasi terbaru seputar kegiatan, program, dan inovasi BGTK Provinsi NTT.
                </p>

                <div class="grid grid-cols-3 gap-4">
                    @forelse($latestPosts as $beritas)
                        <a href="{{ route('publikasi.berita.show', $beritas->slug) }}"
                            class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group">
                            @if ($beritas->gambar_url)
                                <img src="{{ $beritas->gambar_url }}" alt="{{ $beritas->judul }}"
                                    class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-40 bg-linear-to-br from-blue-50 to-blue-100"></div>
                            @endif
                            <div class="p-4 flex flex-col flex-1">
                                @if ($beritas->tags->first())
                                    <span
                                        class="text-xs font-montserrat font-semibold text-blue-600 uppercase tracking-wide mb-2">
                                        {{ $beritas->tags->first()->tagline }}
                                    </span>
                                @endif
                                <h3
                                    class="font-montserrat font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                    {{ $beritas->judul }}
                                </h3>
                                <p class="font-inter text-gray-400 dark:text-gray-500 text-xs mt-auto">
                                    {{ \Carbon\Carbon::parse($beritas->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </p>
                            </div>
                        </a>
                    @empty
                        {{-- Skeleton placeholders --}}
                        @for ($i = 0; $i < 3; $i++)
                            <div
                                class="rounded-xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                                <div class="w-full h-40 bg-gray-100 dark:bg-gray-700 animate-pulse"></div>
                                <div class="p-4 space-y-2">
                                    <div class="h-3 bg-gray-100 dark:bg-gray-700 rounded w-1/3 animate-pulse"></div>
                                    <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-full animate-pulse"></div>
                                    <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-2/3 animate-pulse"></div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>

                <div class="mt-6">
                    <a href="/publikasi/berita-terkini"
                        class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
                        Lihat Semua Berita
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Pengumuman sidebar (1/4) --}}
            <div class="w-1/4">
                @include('home.partials.pengumuman-sidebar', ['pengumuman' => $pengumuman])
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     BERITA TERKINI – MOBILE (< xl)
     ============================================================ --}}
<section id="berita-mobile" class="xl:hidden relative mb-10 w-full max-w-xs sm:max-w-xl md:max-w-3xl lg:max-w-5xl px-4">
    <div class="relative z-10 flex flex-col gap-3 justify-center">
        <div class="text-center mb-6">
            <h2 class="text-3xl lg:text-5xl font-semibold font-montserrat text-primary">
                Berita Terkini
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($latestPosts as $berita)
                <a href="{{ route('publikasi.berita.show', $berita->slug) }}"
                    class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group">
                    @if ($berita->gambar_url)
                        <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}"
                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-40 bg-linear-to-br from-blue-50 to-blue-100"></div>
                    @endif
                    <div class="p-4 flex flex-col flex-1">
                        @if ($berita->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1 mb-1">
                                @foreach ($berita->tags->take(3) as $tag)
                                    <span class="badge badge-sm badge-outline">{{ $tag->tagline }}</span>
                                @endforeach
                            </div>
                        @endif
                        <h3
                            class="font-montserrat font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                            {{ $berita->judul }}
                        </h3>
                        <p class="font-inter text-gray-400 dark:text-gray-500 text-xs mt-auto">
                            {{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="font-inter text-gray-400 dark:text-gray-500 text-center col-span-2 py-8">Belum ada berita.</p>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="/berita"
                class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="mt-6">
            @include('home.partials.pengumuman-sidebar', ['pengumuman' => $pengumuman])
        </div>
    </div>
</section>
