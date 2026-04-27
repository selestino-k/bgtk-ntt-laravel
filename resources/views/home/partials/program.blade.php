@php
    $defaultPrograms = [
        [
            'title' => 'Program Pembelajaran Mendalam (PM)',
            'link'  => '/program/ppm',
            'image' => '/images/assets/program/pm.png',
        ],
        [
            'title' => 'Koding dan Kecerdasan Artifisial (KKA)',
            'link'  => '/program/kka',
            'image' => '/images/assets/program/kka.png',
        ],
        [
            'title' => 'Program Pendidikan Profesi Guru (PPG)',
            'link'  => '/program/ppg',
            'image' => '/images/assets/program/ppg.png',
        ],
        [
            'title' => 'Program Pengembangan Keprofesian Guru (PKG) - Bahasa Inggris',
            'link'  => '/program/pkb',
            'image' => '/images/assets/program/pkg-bi.png',
        ],
        [
            'title' => 'Program Pengembangan Keprofesian Guru (PKG) - Bimbingan Konseling',
            'link'  => '/program/pkm',
            'image' => '/images/assets/program/pkg-bk.png',
        ],
        [
            'title' => 'Program Bakal Calon Kepala Sekolah (BCKS)',
            'link'  => '/program/bcks',
            'image' => '/images/assets/program/bcks.png',
        ],
    ];

    $programs = $programs ?? $defaultPrograms;
@endphp

<section id="program" class="mt-10 mb-10 lg:mb-16 flex relative max-w-7xl w-full items-center px-4 sm:px-8">
    <div class="relative z-10 flex flex-col gap-3 justify-center w-full">

        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-3xl lg:text-5xl font-semibold font-montserrat text-primary">
                Program Prioritas
            </h2>
        </div>

        {{-- Carousel wrapper --}}
        <div class="relative w-full" id="program-carousel-wrapper">
            <div id="program-carousel"
                 class="carousel carousel-center w-full gap-4 scroll-smooth snap-x snap-mandatory overflow-x-auto px-4 scroll-pl-4 scroll-pr-4">
                @foreach($programs as $index => $program)
                    <div id="program-slide-{{ $index }}"
                         class="carousel-item w-full max-w-xs basis-1/1 sm:basis-1/2 md:basis-1/3 xl:basis-1/4 shrink-0 snap-start place-items-center rounded border border-primary/30 h-64 flex items-center justify-center bg-white dark:bg-base-200 shadow-md">
                        <a href="{{ $program['link'] ?? '#' }}"
                           class="rounded-xl shadow-md hover:shadow-xl flex flex-col w-full group h-64 items-center justify-center p-4">
                            @if(!empty($program['image']))
                                <img src="{{ asset($program['image']) }}"
                                     alt="{{ $program['title'] }}"
                                     class="w-44 h-44 object-cover mx-auto group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-44 h-44 bg-linear-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400 text-lg font-inter">No Image Available</span>
                                </div>
                            @endif
                           
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Previous button --}}
            <button id="program-prev"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10
                           bg-primary/20 hover:bg-white text-primary border border-gray-300
                           rounded-full w-10 h-10 flex items-center justify-center shadow transition-colors"
                    aria-label="Previous">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            {{-- Next button --}}
            <button id="program-next"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10
                           bg-primary/20 hover:bg-white text-primary border border-gray-300
                           rounded-full w-10 h-10 flex items-center justify-center shadow transition-colors"
                    aria-label="Next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function () {
    const carousel = document.getElementById('program-carousel');
    if (!carousel) return;

    const prevBtn = document.getElementById('program-prev');
    const nextBtn = document.getElementById('program-next');
    const delay   = 3000;
    let timer;
    let userInteracting = false;

    function getItemWidth() {
        const first = carousel.querySelector('.carousel-item');
        if (!first) return 0;
        const style = getComputedStyle(carousel);
        const gap   = parseFloat(style.columnGap) || 16;
        return first.offsetWidth + gap;
    }

    function scrollBy(direction) {
        carousel.scrollBy({ left: direction * getItemWidth(), behavior: 'smooth' });
    }

    function scrollToStart() {
        carousel.scrollTo({ left: 0, behavior: 'smooth' });
    }

    function isAtEnd() {
        return carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - 4;
    }

    function autoplay() {
        if (userInteracting) return;
        if (isAtEnd()) {
            scrollToStart();
        } else {
            scrollBy(1);
        }
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(autoplay, delay);
    }

    nextBtn.addEventListener('click', () => {
        userInteracting = true;
        scrollBy(1);
        clearInterval(timer);
    });

    prevBtn.addEventListener('click', () => {
        userInteracting = true;
        scrollBy(-1);
        clearInterval(timer);
    });

    carousel.addEventListener('pointerdown', () => {
        userInteracting = true;
        clearInterval(timer);
    });

    carousel.addEventListener('pointerup',   resetTimer);
    carousel.addEventListener('pointerleave', resetTimer);

    resetTimer();
})();
</script>
@endpush
