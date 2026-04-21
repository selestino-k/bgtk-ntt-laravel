@extends('home.layouts.app')

@section('title', 'Sarana dan Prasarana')

@section('content')
@include('home.partials.header')

<div id="sarana-prasarana" class="mt-20 w-full px-4 md:px-10 font-montserrat">
    <main class="relative z-10 flex flex-col gap-3 py-8 w-full">

        {{-- Breadcrumb --}}
        <div class="text-sm text-base-content/50">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <span>ULT</span>
            <span class="mx-2">/</span>
            <span class="text-primary">Sarana dan Prasarana</span>
        </div>

        {{-- Heading --}}
        <div class="mb-8">
            <h2 class="text-2xl md:text-5xl font-bold tracking-tight mb-1 md:mb-5 text-primary">
                Sarana dan Prasarana
            </h2>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">

            @php
                $saranaData = [
                    [
                        'title' => 'Mess Garuda',
                        'image' => null,
                        'estimasiBiaya' => 'Rp 1.500.000 - Rp 3.000.000',
                        'estimasiSasaran' => [
                            'sd'  => 'SD : 3 Kelas (104 Peserta)',
                            'smp' => 'SMP : 2 Kelas (43 Peserta)',
                            'sma' => 'SMA/SMK : 1 Kelas (29 Peserta)',
                        ],
                    ],
                    [
                        'title' => 'Mess Nuri',
                        'image' => null,
                        'estimasiBiaya' => 'Rp 1.610.000 - Rp 3.267.000',
                        'estimasiSasaran' => [
                            'sd'  => 'SD : 6 Kelas (180 Peserta)',
                            'smp' => 'SMP : 3 Kelas (84 Peserta)',
                            'sma' => 'SMA/SMK : 3 Kelas (48 Peserta)',
                        ],
                    ],
                    [
                        'title' => 'Mess Rajawali',
                        'image' => null,
                        'estimasiBiaya' => 'Rp 1.767.000 - Rp 3.739.000',
                        'estimasiSasaran' => [
                            'sd'  => 'SD : 2 Kelas (41 Peserta)',
                            'smp' => 'SMP : 1 Kelas (22 Peserta)',
                            'sma' => 'SMA/SMK : 1 Kelas (10 Peserta)',
                        ],
                    ],
                    [
                        'title' => 'Asrama Pelajar',
                        'image' => null,
                        'estimasiBiaya' => 'Rp 1.500.000 - Rp 3.000.000',
                        'estimasiSasaran' => [
                            'sd'  => 'SD : 4 Kelas (120 Peserta)',
                            'smp' => 'SMP : 2 Kelas (60 Peserta)',
                            'sma' => 'SMA/SMK : 2 Kelas (40 Peserta)',
                        ],
                    ],
                ];
            @endphp

            @foreach($saranaData as $sarana)
                <div class="card bg-base-100 border border-base-300 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                    <figure class="overflow-hidden h-44 bg-base-200">
                        @if($sarana['image'])
                            <img src="{{ $sarana['image'] }}" alt="{{ $sarana['title'] }}"
                                 class="w-full h-full object-cover" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-regular fa-image text-4xl text-base-content/20"></i>
                            </div>
                        @endif
                    </figure>
                    <div class="card-body p-5 gap-3">
                        <h3 class="card-title text-base font-bold text-primary">{{ $sarana['title'] }}</h3>

                        <div>
                            <p class="text-xs font-semibold text-base-content/60 uppercase tracking-wide mb-1">Estimasi Biaya</p>
                            <p class="text-sm font-medium text-base-content">{{ $sarana['estimasiBiaya'] }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-base-content/60 uppercase tracking-wide mb-1">Estimasi Sasaran</p>
                            <ul class="space-y-0.5">
                                @foreach($sarana['estimasiSasaran'] as $sasaran)
                                    <li class="text-sm text-base-content/80">{{ $sasaran }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </main>
</div>

@include('home.partials.footer')
@endsection
