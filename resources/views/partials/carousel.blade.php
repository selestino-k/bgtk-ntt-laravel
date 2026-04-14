<section id="home" class="relative w-screen mb-5 mt-16">
    @if(count($carouselPhotos) > 0)

        {{-- Radio inputs MUST be siblings of .slides-wrapper and .carousel-controls --}}
        @foreach($carouselPhotos as $i => $photo)
            <input type="radio"
                   name="hero-carousel"
                   id="hero-slide-{{ $i }}"
                   class="absolute opacity-0 w-0 h-0 pointer-events-none"
                   {{ $i === 0 ? 'checked' : '' }}>
        @endforeach

        <div class="slides-wrapper relative h-[50vh] md:h-[70vh] lg:h-screen overflow-hidden">
            @foreach($carouselPhotos as $i => $photo)
                <div class="carousel-slide absolute inset-0">
                    <img src="{{ $photo['image_url'] ?? $photo }}"
                         alt="{{ $photo['title'] ?? 'BGTK NTT' }}"
                         class="w-full h-full object-cover"
                         loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                    @if(!empty($photo['caption']))
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6 md:p-10">
                            <p class="text-white font-montserrat font-semibold text-lg md:text-2xl">
                                {{ $photo['caption'] }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if(count($carouselPhotos) > 1)
            <div class="carousel-controls absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @foreach($carouselPhotos as $i => $photo)
                    <label for="hero-slide-{{ $i }}"
                           class="carousel-dot w-3 h-3 rounded-full cursor-pointer block">
                    </label>
                @endforeach
            </div>
        @endif

    @else
        {{-- Fallback gradient banner when no carousel photos are set --}}
        <div class="w-full h-[50vh] md:h-[70vh] bg-gradient-to-br from-primary to-blue-500 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="font-montserrat font-bold text-4xl md:text-6xl mb-4 drop-shadow">BGTK NTT</h1>
                <p class="font-inter text-xl md:text-2xl opacity-90">Balai Guru Penggerak Provinsi NTT</p>
            </div>
        </div>
    @endif
</section>
