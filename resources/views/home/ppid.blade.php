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
                            src="{{ asset('images/assets/maklumat-pelayanan-template.jpg') }}"
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
                    <button type="button" data-tab="Rencana Strategis"
                       class="ppid-tab-btn group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 text-left cursor-pointer">
                        <i class="fa-solid fa-book-open text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Rencana Strategis</h3>
                    </button>

                    {{-- Perjanjian Kinerja --}}
                    <button type="button" data-tab="Perjanjian Kinerja"
                       class="ppid-tab-btn group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 text-left cursor-pointer">
                        <i class="fa-solid fa-file-lines text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Perjanjian Kinerja</h3>
                    </button>

                    {{-- Laporan Kinerja --}}
                    <button type="button" data-tab="Laporan Kinerja"
                       class="ppid-tab-btn group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 text-left cursor-pointer">
                        <i class="fa-solid fa-chart-line text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Laporan Kinerja</h3>
                    </button>

                    {{-- Penghargaan --}}
                    <button type="button" data-tab="Penghargaan"
                       class="ppid-tab-btn group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 text-left cursor-pointer">
                        <i class="fa-solid fa-award text-primary text-4xl mb-1"></i>
                        <h3 class="text-xl font-semibold text-primary">Penghargaan</h3>
                    </button>

                    {{-- PPID Kemendikdasmen --}}
                    <a href="https://ppid.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer"
                       class="group border border-primary/50 rounded-xl p-6 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <i class="fa-solid fa-globe text-primary text-4xl mb-1"></i>
                        <h3 class="text-md font-semibold text-primary">PPID Kemendikdasmen</h3>
                    </a>

                </div>

                {{-- Document Table --}}
                <div id="ppid-dokumen-table" class="w-full mt-10 hidden">
                    <h3 id="ppid-table-title" class="text-2xl font-bold font-montserrat text-primary mb-4"></h3>

                    @php
                        $tabCategories = [
                            'Rencana Strategis'  => ['icon' => 'fa-book-open'],
                            'Perjanjian Kinerja' => ['icon' => 'fa-file-lines'],
                            'Laporan Kinerja'    => ['icon' => 'fa-chart-line'],
                            'Penghargaan'        => ['icon' => 'fa-award'],
                        ];
                    @endphp

                    @foreach ($tabCategories as $kat => $meta)
                        <div class="ppid-tab-content hidden" data-content="{{ $kat }}">
                            @php $items = $dokumens[$kat] ?? collect(); @endphp
                            @if ($items->isEmpty())
                                <div class="text-center py-12 text-base-content/50 font-inter">
                                    <i class="fa-solid {{ $meta['icon'] }} text-4xl mb-3"></i>
                                    <p>Belum ada dokumen untuk kategori ini.</p>
                                </div>
                            @else
                                <div class="overflow-x-auto rounded-xl border border-base-200 shadow-sm">
                                    <table class="table w-full font-inter">
                                        <thead class="font-montserrat text-base-content font-semibold">
                                            <tr>
                                                <th class="w-10">No.</th>
                                                <th>Judul</th>
                                                <th class="hidden md:table-cell">Deskripsi</th>
                                                <th class="hidden sm:table-cell">Jenis</th>
                                                <th class="text-center">Unduh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $i => $dok)
                                                <tr class="hover:bg-base-200 transition-colors">
                                                    <td class="text-center">{{ $i + 1 }}</td>
                                                    <td class="font-medium">{{ $dok->judul }}</td>
                                                    <td class="hidden md:table-cell text-base-content/70 text-sm">
                                                        {{ $dok->deskripsi ?? '-' }}
                                                    </td>
                                                    <td class="hidden sm:table-cell text-sm uppercase text-base-content/60">
                                                        {{ strtoupper($dok->file_type) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('storage/' . $dok->file_url) }}"
                                                           target="_blank" rel="noopener noreferrer"
                                                           class="btn btn-sm btn-primary gap-1">
                                                            <i class="fa-solid fa-download text-xs"></i>
                                                            <span class="hidden sm:inline">Unduh</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </main>
    </div>
</div>

@include('home.partials.footer')

@push('scripts')
<script>
    (function () {
        const tabBtns = document.querySelectorAll('.ppid-tab-btn');
        const tableWrapper = document.getElementById('ppid-dokumen-table');
        const tableTitle = document.getElementById('ppid-table-title');
        const tabContents = document.querySelectorAll('.ppid-tab-content');

        let activeTab = null;

        tabBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const tab = btn.getAttribute('data-tab');

                if (activeTab === tab) {
                    // Toggle off
                    activeTab = null;
                    tableWrapper.classList.add('hidden');
                    tabBtns.forEach(function (b) {
                        b.classList.remove('bg-primary', 'text-primary-content', 'border-primary');
                        b.querySelectorAll('i, h3').forEach(function (el) {
                            el.classList.remove('text-primary-content');
                            el.classList.add('text-primary');
                        });
                    });
                    return;
                }

                activeTab = tab;

                // Update button styles
                tabBtns.forEach(function (b) {
                    const isActive = b.getAttribute('data-tab') === tab;
                    b.classList.toggle('bg-primary', isActive);
                    b.classList.toggle('border-primary', isActive);
                    b.querySelectorAll('i, h3').forEach(function (el) {
                        el.classList.toggle('text-primary-content', isActive);
                        el.classList.toggle('text-primary', !isActive);
                    });
                });

                // Show table & correct content
                tableTitle.textContent = tab;
                tabContents.forEach(function (panel) {
                    panel.classList.toggle('hidden', panel.getAttribute('data-content') !== tab);
                });
                tableWrapper.classList.remove('hidden');

                
            });
        });
    })();
</script>
@endpush

@endsection
