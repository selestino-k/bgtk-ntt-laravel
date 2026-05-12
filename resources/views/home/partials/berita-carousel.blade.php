{{-- ============================================================
     BERITA TERKINI – Carousel (Desktop xl+ / Mobile)
     ============================================================ --}}

{{-- ===== DESKTOP (xl+) ===== --}}
<section id="berita" class="hidden xl:block relative mb-12 mt-10 max-w-7xl w-full px-4 sm:px-8">
    <h2 class="text-5xl font-semibold font-montserrat text-primary mb-6">
        Berita Terkini
    </h2>

    <div class="relative">
        {{-- Carousel Track --}}
        <div id="berita-track" class="carousel carousel-center w-full gap-4">
            @forelse($latestPosts as $beritas)
                <div class="carousel-item w-[calc(20%-0.8rem)]">
                    <a href="{{ route('publikasi.berita.show', $beritas->slug) }}"
                        class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group w-full">
                        @if ($beritas->gambar_url)
                            <img src="{{ $beritas->gambar_url }}" alt="{{ $beritas->judul }}"
                                class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-40 bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800"></div>
                        @endif
                        <div class="p-4 flex flex-col flex-1 font-montserrat">
                            @if ($beritas->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($beritas->tags->take(3) as $tag)
                                        <span class="badge badge-sm badge-outline">{{ $tag->tagline }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $beritas->judul }}
                            </h3>
                            <p class="text-base-content/60 text-xs mt-auto">
                                {{ \Carbon\Carbon::parse($beritas->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>
                    </a>
                </div>
            @empty
                @for ($i = 0; $i < 5; $i++)
                    <div class="carousel-item w-[calc(20%-0.8rem)]">
                        <div class="rounded-xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 w-full">
                            <div class="w-full h-40 bg-gray-100 dark:bg-gray-700 animate-pulse"></div>
                            <div class="p-4 space-y-2">
                                <div class="h-3 bg-gray-100 dark:bg-gray-700 rounded w-1/3 animate-pulse"></div>
                                <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-full animate-pulse"></div>
                                <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-2/3 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('publikasi.berita.berita') }}"
            class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
            Lihat Semua Berita
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</section>

{{-- ===== MOBILE (< xl) ===== --}}
<section id="berita-mobile" class="xl:hidden relative mb-12 mt-10 w-full max-w-xs sm:max-w-xl md:max-w-3xl lg:max-w-5xl px-4">
    <h2 class="text-3xl font-semibold font-montserrat text-primary mb-6 text-center">
        Berita Terkini
    </h2>

    <div class="relative">
        {{-- Carousel Track --}}
        <div class="carousel carousel-center w-full gap-4">
            @forelse($latestPosts as $beritas)
                <div class="carousel-item w-4/5 sm:w-[calc(50%-0.5rem)] lg:w-[calc(33.333%-0.667rem)]">
                    <a href="{{ route('publikasi.berita.show', $beritas->slug) }}"
                        class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group w-full">
                        @if ($beritas->gambar_url)
                            <img src="{{ $beritas->gambar_url }}" alt="{{ $beritas->judul }}"
                                class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-40 bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800"></div>
                        @endif
                        <div class="p-4 flex flex-col flex-1 font-montserrat">
                            @if ($beritas->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($beritas->tags->take(3) as $tag)
                                        <span class="badge badge-sm badge-outline">{{ $tag->tagline }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $beritas->judul }}
                            </h3>
                            <p class="text-base-content/60 text-xs mt-auto">
                                {{ \Carbon\Carbon::parse($beritas->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>
                    </a>
                </div>
            @empty
                @for ($i = 0; $i < 3; $i++)
                    <div class="carousel-item w-4/5 sm:w-[calc(50%-0.5rem)] lg:w-[calc(33.333%-0.667rem)]">
                        <div class="rounded-xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 w-full">
                            <div class="w-full h-40 bg-gray-100 dark:bg-gray-700 animate-pulse"></div>
                            <div class="p-4 space-y-2">
                                <div class="h-3 bg-gray-100 dark:bg-gray-700 rounded w-1/3 animate-pulse"></div>
                                <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-full animate-pulse"></div>
                                <div class="h-4 bg-gray-100 dark:bg-gray-700 rounded w-2/3 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('publikasi.berita.berita') }}"
            class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
            Lihat Semua Berita
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</section>

