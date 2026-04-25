@extends('home.layouts.app')

@section('title', 'ZI-WBK')

@section('content')
    @include('home.partials.header')

    <div id="zi-wbk" class="mt-20 w-full max-w-7xl px-4 md:px-10 font-montserrat">
        <main class="relative z-10 flex flex-col gap-3 p-8 w-full">

            {{-- Breadcrumb --}}
            <div class="text-sm text-base-content/50">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span class="mx-2">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
                <span>ZI-WBK</span>
                <span class="mx-2">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
                <span class="text-primary">Area Perubahan</span>
            </div>

            <div>
                <h2 class="text-2xl md:text-5xl font-bold tracking-tight mb-1 md:mb-5 text-primary">
                    Area Perubahan ZI-WBK
                </h2>
                <div class="flex justify-center w-full gap-2">
                    <img src="{{ asset('images/assets/zi-wbk-area-perubahan.webp') }}" alt="Area Perubahan ZI-WBK"
                        class="w-full h-auto rounded-lg mx-auto mt-4 object-cover object-center" />
                </div>

                <p class="text-balance md:text-base font-inter mt-4">
                    Pimpinan dan pegawai di Satuan Kerja perlu memahami dan berkomitmen mengenai substansi dari enam area
                    perubahan menuju Reformasi Birokrasi yang di dalamnya ada yang dinamakan Zona Integritas Wilayah Bebas
                    dari Korupsi (WBK) dan Wilayah Birokrasi Bersih dan Melayani (WBBM). Hal itu dilakukan melalui
                    keterlibatan pimpinan secara aktif dalam melakukan monitoring dan evaluasi pembangunan ZI. Selain itu,
                    pimpinan juga harus berdialog dengan seluruh pegawai secara berjenjang.
                </p>

                <p class="text-balance md:text-base font-inter mt-4">
                    Enam area perubahan tersebut meliputi:
                </p>

                <ol class="list-decimal list-inside mt-4 space-y-2 text-balance md:text-base font-inter">
                    <li>
                        <span class="font-bold">Manajemen Perubahan:</span> Melibatkan perubahan pola pikir dan budaya kerja
                        pegawai untuk mendukung reformasi birokrasi.
                    </li>
                    <li>
                        <span class="font-bold">Penataan Tata Laksana:</span> Melakukan penyederhanaan proses bisnis dan
                        prosedur kerja untuk meningkatkan efisiensi dan efektivitas pelayanan publik.
                    </li>
                    <li>
                        <span class="font-bold">Penataan Sistem Manajemen SDM:</span> Meningkatkan kompetensi, integritas,
                        dan profesionalisme pegawai melalui pelatihan dan pengembangan karir.
                    </li>
                    <li>
                        <span class="font-bold">Penguatan Akuntabilitas Kinerja:</span> Menerapkan sistem pengukuran kinerja
                        yang transparan dan akuntabel untuk memastikan pencapaian tujuan organisasi.
                    </li>
                    <li>
                        <span class="font-bold">Penguatan Pengawasan:</span> Meningkatkan fungsi pengawasan internal dan
                        eksternal untuk mencegah penyimpangan dan korupsi.
                    </li>
                    <li>
                        <span class="font-bold">Peningkatan Kualitas Pelayanan Publik:</span> Meningkatkan aksesibilitas,
                        kecepatan, dan kualitas pelayanan kepada masyarakat.
                    </li>
                </ol>
            </div>

        </main>
    </div>

    @include('home.partials.footer')
@endsection
