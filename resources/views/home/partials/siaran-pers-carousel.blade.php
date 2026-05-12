{{-- ============================================================
     SIARAN PERS – Carousel (3/4) + Pengumuman Sidebar (1/4)
     ============================================================ --}}

{{-- ===== DESKTOP (xl+) ===== --}}
<section id="siaran-pers" class="hidden xl:flex items-start relative mb-20 max-w-7xl w-full px-4 sm:px-8">
    <div class="flex gap-6 w-full">

        {{-- Siaran Pers carousel (3/4) --}}
        <div class="w-3/4">
            <h2 class="text-5xl font-semibold font-montserrat text-primary mb-6">
                Siaran Pers
            </h2>

            <div class="relative">
                {{-- Track --}}
                <div class="carousel carousel-center w-full gap-4">
                    @forelse($siaranPers ?? [] as $item)
                        <div class="carousel-item w-[calc(33.333%-0.667rem)]">
                            <a href="{{ route('publikasi.berita.show', $item->slug) }}"
                                class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group w-full">
                                @if ($item->gambar_url)
                                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-40 bg-linear-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900 dark:to-emerald-800"></div>
                                @endif
                                <div class="p-4 flex flex-col flex-1 font-montserrat">
                                    @if ($item->tags->isNotEmpty())
                                        <div class="flex flex-wrap gap-1 mb-2">
                                            @foreach ($item->tags->take(3) as $tag)
                                                <span class="badge badge-sm badge-outline">{{ $tag->tagline }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-base-content/60 text-xs mt-auto">
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        @for ($i = 0; $i < 3; $i++)
                            <div class="carousel-item w-[calc(33.333%-0.667rem)]">
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
                <a href="{{ route('siaran-pers.index') }}"
                    class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
                    Lihat Semua Siaran Pers
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        {{-- Pengumuman Sidebar (1/4) --}}
        <div class="w-1/4">
            @include('home.partials.pengumuman-sidebar', ['pengumuman' => $pengumuman])
        </div>

    </div>
</section>

{{-- ===== MOBILE (< xl) ===== --}}
<section id="siaran-pers-mobile" class="xl:hidden relative mb-10 w-full max-w-xs sm:max-w-xl md:max-w-3xl lg:max-w-5xl px-4">
    <div class="flex flex-col gap-6">

        {{-- Siaran Pers --}}
        <div>
            <h2 class="text-3xl font-semibold font-montserrat text-primary mb-6 text-center">
                Siaran Pers
            </h2>

            <div class="relative">
                <div class="carousel carousel-center w-full gap-4">
                    @forelse($siaranPers ?? [] as $item)
                        <div class="carousel-item w-4/5 sm:w-[calc(50%-0.5rem)]">
                            <a href="{{ route('publikasi.berita.show', $item->slug) }}"
                                class="rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col group w-full">
                                @if ($item->gambar_url)
                                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-40 bg-linear-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900 dark:to-emerald-800"></div>
                                @endif
                                <div class="p-4 flex flex-col flex-1 font-montserrat">
                                    @if ($item->tags->isNotEmpty())
                                        <div class="flex flex-wrap gap-1 mb-2">
                                            @foreach ($item->tags->take(3) as $tag)
                                                <span class="badge badge-sm badge-outline">{{ $tag->tagline }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-base-content/60 text-xs mt-auto">
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="font-montserrat text-gray-400 dark:text-gray-500 text-center w-full py-8">Belum ada siaran pers.</p>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('siaran-pers.index') }}"
                    class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold hover:underline text-sm">
                    Lihat Semua Siaran Pers
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        {{-- Pengumuman Sidebar --}}
        <div>
            @include('home.partials.pengumuman-sidebar', ['pengumuman' => $pengumuman])
        </div>

    </div>
</section>

