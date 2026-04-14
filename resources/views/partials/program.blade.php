@php
    $defaultPrograms = [
        ['title' => 'Pendidikan Guru Penggerak', 'desc' => 'Program pengembangan kompetensi guru sebagai pemimpin pembelajaran yang mendorong tumbuh kembang murid secara holistik.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['title' => 'Sekolah Penggerak', 'desc' => 'Program peningkatan kualitas pembelajaran di sekolah berfokus pada pengembangan karakter, kompetensi, dan literasi peserta didik.', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['title' => 'Pendidikan Profesi Guru', 'desc' => 'Program sertifikasi profesi guru untuk menjamin kompetensi standar dan meningkatkan profesionalisme tenaga pendidik.', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
    ];
@endphp

<section id="program" class="mt-10 mb-10 lg:mb-16 flex relative max-w-7xl w-full items-center px-4 sm:px-8">
    <div class="relative z-10 flex flex-col gap-3 justify-center w-full">
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-3xl lg:text-5xl font-semibold font-montserrat text-primary">
                Program Prioritas
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($programs ?? [] as $program)
                <div class="rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow bg-white border border-gray-100">
                    @if(!empty($program['image']))
                        <img src="{{ $program['image'] }}" alt="{{ $program['title'] }}" class="w-full h-48 object-cover">
                    @else
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-montserrat font-semibold text-lg text-gray-900 mb-2">{{ $program['title'] }}</h3>
                        <p class="font-inter text-gray-600 text-sm leading-relaxed">{{ $program['description'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                @foreach($defaultPrograms as $program)
                    <div class="rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow bg-white border border-gray-100">
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $program['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="font-montserrat font-semibold text-lg text-gray-900 mb-2">{{ $program['title'] }}</h3>
                            <p class="font-inter text-gray-600 text-sm leading-relaxed">{{ $program['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>
