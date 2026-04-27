<section id="home" class="relative w-screen mb-5 mt-16">

    @if(count($slideshowPhotos) > 0)

        <div class="carousel w-full h-[70vh]" id="heroCarousel">
            @foreach($slideshowPhotos as $photo)
                <div id="hero-slide-{{ $loop->index }}" class="carousel-item relative w-full">
                    <img src="{{ $photo->gambar_url }}"
                         alt="{{ $photo->judul ?? 'BGTK NTT' }}"
                         class="w-full h-full object-cover"
                         loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                    @if(!empty($photo->deskripsi))
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/60 to-transparent p-6 md:p-10">
                            <p class="text-white font-montserrat font-semibold text-lg md:text-2xl">
                                {{ $photo->deskripsi }}
                            </p>
                        </div>
                    @endif
                    @if($loop->count > 1)
                        <div class="absolute left-5 right-5 top-1/2 -translate-y-1/2 flex justify-between z-10">
                            <button type="button"
                                    data-carousel-prev
                                    class="btn btn-circle bg-black/30 border-0 text-white hover:bg-black/60"
                                    aria-label="Previous slide">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button"
                                    data-carousel-next
                                    class="btn btn-circle bg-black/30 border-0 text-white hover:bg-black/60"
                                    aria-label="Next slide">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if(count($slideshowPhotos) > 1)
            {{-- Dot indicators --}}
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @foreach($slideshowPhotos as $i => $photo)
                    <button type="button"
                       data-slide="{{ $i }}"
                       class="carousel-dot w-3 h-3 rounded-full block {{ $loop->first ? 'active' : '' }}"
                       aria-label="Go to slide {{ $i + 1 }}"></button>
                @endforeach
            </div>

            <script>
            (function () {
                const carousel = document.getElementById('heroCarousel');
                const dots     = Array.from(document.querySelectorAll('.carousel-dot'));
                const total    = {{ count($slideshowPhotos) }};
                let current    = 0;
                let timer;

                function goTo(n) {
                    current = (n + total) % total;
                    const target = document.getElementById('hero-slide-' + current);
                    carousel.scrollTo({ left: target.offsetLeft, behavior: 'smooth' });
                    dots.forEach(function (d, i) {
                        d.classList.toggle('active', i === current);
                    });
                }

                function startAuto() {
                    timer = setInterval(function () { goTo(current + 1); }, 5000);
                }

                function resetAuto() {
                    clearInterval(timer);
                    startAuto();
                }

                document.querySelectorAll('[data-carousel-next]').forEach(function (btn) {
                    btn.addEventListener('click', function () { goTo(current + 1); resetAuto(); });
                });

                document.querySelectorAll('[data-carousel-prev]').forEach(function (btn) {
                    btn.addEventListener('click', function () { goTo(current - 1); resetAuto(); });
                });

                dots.forEach(function (dot) {
                    dot.addEventListener('click', function () {
                        goTo(parseInt(dot.dataset.slide));
                        resetAuto();
                    });
                });

                startAuto();
            })();
            </script>
        @endif

    @else
        {{-- Fallback banner when no slideshow photos are active --}}
        <div class="w-full h-[70vh] flex items-center justify-center">
            <img src="/images/assets/carousel-home-light.png" alt="BGTK NTT" class="w-full h-full object-cover">
        </div>
    @endif

</section>
