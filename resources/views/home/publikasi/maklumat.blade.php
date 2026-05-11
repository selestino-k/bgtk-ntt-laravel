@extends('home.layouts.app')

@section('title', 'Maklumat Pelayanan | BGTK Provinsi NTT')

@section('content')
@include('home.partials.header')

<div id="maklumat-pelayanan" class="mt-20 flex place-items-start w-full px-10">
    <main class="relative z-10 gap-20 p-8 flex w-full">
        <div class="text-left w-full">

            {{-- Breadcrumb --}}
            <div class="mb-4 font-montserrat text-sm breadcrumbs">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-base-content/60 hover:text-primary">Beranda</a></li>
                    <li><span class="text-base-content/60">Publikasi</span></li>
                    <li><span class="text-primary font-semibold">Maklumat Pelayanan</span></li>
                </ul>
            </div>

            {{-- Heading --}}
            <h2 class="text-2xl md:text-5xl font-bold sm:tracking-tight mb-1 md:mb-3 font-montserrat text-primary">
                Maklumat Pelayanan
            </h2>

            {{-- Content --}}
            @php
                $maklumatDoc = $dokumens->first();
                $maklumatUrl = $maklumatDoc ? asset('storage/' . $maklumatDoc->file_url) : null;
            @endphp
            <div class="w-full grid lg:flex items-start gap-10">

                <div class="w-full lg:w-1/2 grid gap-4">
                    <h3 class="text-lg md:text-2xl font-semibold font-montserrat tracking-tight text-primary">
                        Balai Guru dan Tenaga Kependidikan (BGTK) Provinsi NTT
                    </h3>
                    <p class="font-inter text-base-content/70 text-sm md:text-base leading-relaxed">
                        Maklumat Pelayanan merupakan pernyataan tertulis berisi keseluruhan rincian kewajiban dan janji yang harus dipenuhi dalam pelayanan publik sesuai dengan standar pelayanan yang telah ditetapkan.
                    </p>
                    @if($maklumatUrl)
                        <a href="{{ $maklumatUrl }}"
                           download="{{ $maklumatDoc->file_name ?? 'maklumat-pelayanan' }}"
                           class="inline-flex items-center gap-2 w-max px-4 py-2 bg-primary text-white rounded-lg font-montserrat text-sm md:text-base hover:bg-primary/90 transition-colors duration-200">
                            <i class="fa-solid fa-download"></i>
                            Unduh Maklumat Pelayanan
                        </a>
                    @endif
                </div>

                <div class="w-full lg:w-1/2 flex justify-center">
                    @if($maklumatUrl)
                        <img
                            src="{{ $maklumatUrl }}"
                            alt="{{ $maklumatDoc->judul ?? 'Maklumat Pelayanan PPID BGTK NTT' }}"
                            class="w-full h-auto rounded-lg shadow-md"
                        >
                    @else
                        <div class="w-full flex items-center justify-center rounded-lg border border-base-200 bg-base-100 py-16 text-base-content/40 font-inter text-sm">
                            <span>Dokumen belum tersedia</span>
                        </div>
                    @endif
                </div>

            </div>

            {{-- Document Table --}}
            <div class="mt-12">
                <h3 class="text-xl md:text-2xl font-bold font-montserrat text-primary mb-4">
                    Dokumen Maklumat Pelayanan
                </h3>

                @if($dokumens->isEmpty())
                    <div class="text-center py-12 text-base-content/50 font-inter">
                        <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
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
                                @foreach($dokumens as $i => $dok)
                                    <tr class="hover:bg-base-200 transition-colors">
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="font-medium">{{ $dok->judul }}</td>
                                        <td class="hidden md:table-cell text-base-content/70 text-sm">
                                            {{ $dok->deskripsi ?? '-' }}
                                        </td>
                                        <td class="hidden sm:table-cell text-sm text-base-content/60">
                                            @php
                                                $mimeToExt = [
                                                    'application/pdf'                                                          => 'PDF',
                                                    'application/msword'                                                       => 'Word',
                                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'  => 'Word',
                                                    'application/vnd.ms-excel'                                                 => 'Excel',
                                                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'        => 'Excel',
                                                    'application/vnd.ms-powerpoint'                                            => 'PowerPoint',
                                                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'=> 'PowerPoint',
                                                    'image/jpeg'                                                               => 'Gambar',
                                                    'image/png'                                                                => 'Gambar',
                                                    'image/gif'                                                                => 'Gambar',
                                                    'image/webp'                                                               => 'Gambar',
                                                    'application/zip'                                                          => 'ZIP',
                                                    'application/x-zip-compressed'                                             => 'ZIP',
                                                    'application/x-rar-compressed'                                             => 'RAR',
                                                    'application/vnd.rar'                                                      => 'RAR',
                                                    'pdf'  => 'PDF',
                                                    'doc'  => 'Word',
                                                    'docx' => 'Word',
                                                    'xls'  => 'Excel',
                                                    'xlsx' => 'Excel',
                                                    'ppt'  => 'PowerPoint',
                                                    'pptx' => 'PowerPoint',
                                                    'jpg'  => 'Gambar',
                                                    'jpeg' => 'Gambar',
                                                    'png'  => 'Gambar',
                                                    'zip'  => 'ZIP',
                                                    'rar'  => 'RAR',
                                                ];
                                                $rawType = strtolower($dok->file_type ?? '');
                                                $fileLabel = $mimeToExt[$rawType] ?? strtoupper(last(explode('/', $rawType)));
                                            @endphp
                                            {{ $fileLabel }}
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

        </div>
    </main>
</div>

@include('home.partials.footer')
@endsection