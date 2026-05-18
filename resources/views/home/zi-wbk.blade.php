@extends('home.layouts.app')

@section('title', 'ZI-WBK')

@section('content')
    @include('home.partials.header')

    <div id="zi-wbk" class="mt-20 w-full px-4 md:px-10 font-montserrat justify-center">
        <main class="relative z-10 flex flex-col gap-3 p-8 w-full">

            {{-- Breadcrumb --}}
            <div class="text-sm text-base-content/50">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span class="mx-2">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
                <span>ZI-WBK</span>
            </div>

            <div class="text-left w-full mb-10">
                <h2 class="text-2xl md:text-5xl font-bold tracking-tight mb-1 text-primary">
                    ZI-WBK
                </h2>
                <h3 class="text-lg md:text-2xl font-semibold tracking-tight mb-3 text-primary">
                    Zona Integritas - Wilayah Bebas dari Korupsi
                </h3>
                <p class="text-sm md:text-base font-inter">
                    Zona Integritas (ZI) adalah predikat yang diberikan kepada instansi pemerintah yang telah berkomitmen untuk mewujudkan Wilayah Bebas dari Korupsi (WBK) dan Wilayah Birokrasi Bersih Melayani (WBBM). ZI-WBK merupakan bagian dari upaya reformasi birokrasi untuk meningkatkan kualitas pelayanan publik dan memberantas korupsi di lingkungan pemerintahan.
                </p>
                <p class="text-sm md:text-base font-inter mt-2">
                    BGTK Provinsi NTT berkomitmen untuk terus meningkatkan integritas dan kualitas pelayanan publik melalui implementasi Zona Integritas, dengan harapan dapat memberikan manfaat yang optimal bagi masyarakat dan mendukung terciptanya pemerintahan yang bersih dan akuntabel.
                </p>
                <p class="text-sm md:text-base font-inter mt-2">
                    Melalui halaman ini, Anda dapat mengakses berbagai dokumen terkait ZI-WBK yang telah kami kumpulkan dan kategorikan untuk memudahkan pencarian informasi yang Anda butuhkan.
                </p>
            </div>

            <div id='zi-wbk-images' class="flex flex-wrap gap-24 justify-center items-center mb-10">
                <img src="{{ asset('images/assets/berakhlak.png') }}" alt="ZI-WBK 1" class="w-48 h-auto object-contain dark:hidden">
                <img src="{{ asset('images/assets/berakhlak-dark.png') }}" alt="ZI-WBK 1" class="w-48 h-auto object-contain hidden dark:block">
                <img src="{{ asset('images/assets/berani-jujur-hebat.png') }}" alt="ZI-WBK 2"
                    class="w-24 h-auto object-contain">
                <img src="{{ asset('images/assets/sehat-tanpa-korupsi.png') }}" alt="ZI-WBK 2"
                    class="w-32 h-auto object-contain dark:hidden">
                <img src="{{ asset('images/assets/sehat-tanpa-korupsi-dark.png') }}" alt="ZI-WBK 2"
                    class="w-32 h-auto object-contain hidden dark:block">
                <img src="{{ asset('images/assets/bangga-melayani-bangsa.png') }}" alt="ZI-WBK 3"
                    class="w-48 h-auto object-contain">
            </div>

        </main>


        {{-- ZI-WBK Dokumen Tabs --}}
        <div id="zi-wbk-item" class="mb-9 flex flex-col justify-center items-center px-4 md:px-10 font-montserrat">
            <div class="text-center mb-6">
                <h2 class="md:text-3xl lg:text-4xl text-2xl font-bold font-montserrat tracking-tight text-primary">
                    Dokumen ZI-WBK
                </h2>
            </div>

            @php
                $tabCategories = [
                    'Manajemen Perubahan' => ['icon' => 'fa-arrows-rotate'],
                    'Penataan Tata Laksana' => ['icon' => 'fa-sitemap'],
                    'Penataan Sistem Manajemen SDM' => ['icon' => 'fa-users-gear'],
                    'Penguatan Akuntabilitas Kinerja' => ['icon' => 'fa-chart-line'],
                    'Penguatan Pengawasan' => ['icon' => 'fa-eye'],
                    'Peningkatan Kualitas Pelayanan Publik' => ['icon' => 'fa-bullhorn'],
                ];
            @endphp

            <div class="w-full max-w-7xl grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 font-montserrat">
                @foreach ($tabCategories as $kat => $meta)
                    <button type="button" data-ziwbk-tab="{{ $kat }}"
                        class="ziwbk-tab-btn border border-primary/50 rounded-xl p-4 flex flex-col gap-2 bg-base-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 text-left cursor-pointer">
                        <i class="fa-solid {{ $meta['icon'] }} text-primary text-3xl mb-1"></i>
                        <h3 class="text-sm font-semibold text-primary leading-tight">{{ $kat }}</h3>
                    </button>
                @endforeach
            </div>

            {{-- Document Table --}}
            <div id="ziwbk-dokumen-table" class="w-full max-w-7xl mt-8 hidden">
                <h3 id="ziwbk-table-title" class="text-xl font-bold font-montserrat text-primary mb-4"></h3>

                @foreach ($tabCategories as $kat => $meta)
                    <div class="ziwbk-tab-content hidden" data-content="{{ $kat }}">
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
                                                <td class="hidden sm:table-cell text-sm text-base-content/60">
                                                    @php
                                                        $mimeToExt = [
                                                            'application/pdf' => 'PDF',
                                                            'application/msword' => 'Word',
                                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' =>
                                                                'Word',
                                                            'application/vnd.ms-excel' => 'Excel',
                                                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' =>
                                                                'Excel',
                                                            'application/vnd.ms-powerpoint' => 'PowerPoint',
                                                            'application/vnd.openxmlformats-officedocument.presentationml.presentation' =>
                                                                'PowerPoint',
                                                            'image/jpeg' => 'Gambar',
                                                            'image/png' => 'Gambar',
                                                            'image/gif' => 'Gambar',
                                                            'image/webp' => 'Gambar',
                                                            'application/zip' => 'ZIP',
                                                            'application/x-zip-compressed' => 'ZIP',
                                                            'application/x-rar-compressed' => 'RAR',
                                                            'application/vnd.rar' => 'RAR',
                                                            'pdf' => 'PDF',
                                                            'doc' => 'Word',
                                                            'docx' => 'Word',
                                                            'xls' => 'Excel',
                                                            'xlsx' => 'Excel',
                                                            'ppt' => 'PowerPoint',
                                                            'pptx' => 'PowerPoint',
                                                            'jpg' => 'Gambar',
                                                            'jpeg' => 'Gambar',
                                                            'png' => 'Gambar',
                                                            'zip' => 'ZIP',
                                                            'rar' => 'RAR',
                                                        ];
                                                        $rawType = strtolower($dok->file_type ?? '');
                                                        $fileLabel =
                                                            $mimeToExt[$rawType] ??
                                                            strtoupper(last(explode('/', $rawType)));
                                                    @endphp
                                                    {{ $fileLabel }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $dok->file_url) }}" target="_blank"
                                                        rel="noopener noreferrer" class="btn btn-sm btn-primary gap-1">
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
    </div>

    @include('home.partials.footer')

    @push('scripts')
        <script nonce="{{ $cspNonce }}">
            (function() {
                const tabBtns = document.querySelectorAll('.ziwbk-tab-btn');
                const tableWrapper = document.getElementById('ziwbk-dokumen-table');
                const tableTitle = document.getElementById('ziwbk-table-title');
                const tabContents = document.querySelectorAll('.ziwbk-tab-content');

                let activeTab = null;

                tabBtns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const tab = btn.getAttribute('data-ziwbk-tab');

                        if (activeTab === tab) {
                            activeTab = null;
                            tableWrapper.classList.add('hidden');
                            tabBtns.forEach(function(b) {
                                b.classList.remove('bg-primary', 'border-primary');
                                b.querySelectorAll('i, h3').forEach(function(el) {
                                    el.classList.remove('text-primary-content');
                                    el.classList.add('text-primary');
                                });
                            });
                            return;
                        }

                        activeTab = tab;

                        tabBtns.forEach(function(b) {
                            const isActive = b.getAttribute('data-ziwbk-tab') === tab;
                            b.classList.toggle('bg-primary', isActive);
                            b.classList.toggle('border-primary', isActive);
                            b.querySelectorAll('i, h3').forEach(function(el) {
                                el.classList.toggle('text-primary-content', isActive);
                                el.classList.toggle('text-primary', !isActive);
                            });
                        });

                        tableTitle.textContent = tab;
                        tabContents.forEach(function(panel) {
                            panel.classList.toggle('hidden', panel.getAttribute('data-content') !==
                                tab);
                        });
                        tableWrapper.classList.remove('hidden');
                    });
                });
            })();
        </script>
    @endpush
@endsection
