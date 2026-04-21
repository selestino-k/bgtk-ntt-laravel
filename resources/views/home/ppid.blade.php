@extends('home.layouts.app')

@section('title', 'PPID')

@section('content')
@include('home.partials.header')

<div class="mt-20 w-full flex justify-center px-4 md:px-10">
    <div id="ppid" class="w-full max-w-7xl">
        <main class="relative z-10 flex flex-col gap-3 p-8 w-full">

            {{-- PPID Main --}}
            <div id="ppid-main" class="text-left">
                <h2 class="text-2xl md:text-5xl font-bold font-montserrat tracking-tight mb-1 md:mb-5 text-primary">
                    Pejabat Pengelola Informasi dan Dokumentasi (PPID)
                </h2>
                <p class="md:text-base mt-4 font-inter">
                    PPID adalah kepanjangan dari Pejabat Pengelola Informasi dan Dokumentasi. PPID berfungsi sebagai pengelola dan penyampai dokumen yang dimiliki oleh badan publik sesuai dengan amanat UU 14/2008 tentang Keterbukaan Informasi Publik. Dengan keberadaan PPID, maka masyarakat yang akan menyampaikan permohonan informasi lebih mudah dan tidak berbelit-belit karena dilayani melalui satu pintu.
                </p>

                <div class="w-full grid lg:flex mt-10 items-center gap-10">

                    <div class="w-full md:w-1/2 pr-4 grid">
                        <h2 class="text-2xl lg:text-5xl font-bold font-montserrat tracking-tight mb-1 text-primary">
                            Maklumat Pelayanan
                        </h2>
                        <h3 class="text-md lg:text-2xl font-semibold font-montserrat tracking-tight mb-3 md:mb-5 pr-3 text-primary">
                            Balai Guru dan Tenaga Kependidikan (BGTK) Provinsi NTT
                        </h3>
                        <a href="/maklumat-pelayanan-ppid-bbgtk-ntt"
                           class="inline-flex items-center gap-2 w-max px-4 py-2 bg-primary text-white rounded-lg font-montserrat text-sm lg:text-base hover:bg-primary/90 transition-colors duration-200">
                            <i class="fa-solid fa-download"></i>
                            Unduh Maklumat Pelayanan
                        </a>
                    </div>

                    <div class="w-full md:w-1/2 flex justify-center mt-5 md:mt-0 mb-5 md:mb-0">
                        <img
                            src="{{ asset('images/maklumat-pelayanan-bbgtk-jateng1759111258.jpg') }}"
                            alt="Maklumat Pelayanan PPID BGTK NTT"
                            class="w-[80vw] md:w-full h-auto rounded-lg shadow-md"
                        >
                    </div>

                </div>
            </div>

            {{-- PPID Informasi Cards --}}
            <div id="ppid-item" class="xl:mt-15 mt-8 sm:mt-10 mb-9 flex flex-col justify-center relative max-w-7xl items-center">
                <div class="text-center">
                    <h2 class="md:text-3xl lg:text-5xl text-3xl font-bold font-montserrat tracking-tight text-primary">
                        Informasi
                    </h2>
                </div>

                <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 mt-10 items-stretch font-montserrat gap-6">

                    {{-- Rencana Strategis --}}
                    <a href="/ppid/rencana-strategis"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-book-open text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Rencana Strategis</h3>
                    </a>

                    {{-- Perjanjian Kinerja --}}
                    <a href="/ppid/perjanjian-kinerja"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-file-lines text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Perjanjian Kinerja</h3>
                    </a>

                    {{-- Laporan Kinerja --}}
                    <a href="/ppid/laporan-kinerja"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-chart-line text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Laporan Kinerja</h3>
                    </a>

                    {{-- Penghargaan --}}
                    <a href="/ppid/penghargaan"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-award text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Penghargaan</h3>
                    </a>

                    {{-- PPID Kemendikdasmen --}}
                    <a href="https://ppid.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-globe text-primary text-4xl mb-1"></i>
                        <h3 class="text-md font-semibold text-primary">PPID Kemendikdasmen</h3>
                    </a>

                </div>
            </div>

        </main>
    </div>
</div>

@include('home.partials.footer')

@endsection
