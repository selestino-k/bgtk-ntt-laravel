@extends('home.layouts.app')

@section('title', 'Dokumen | BGTK Provinsi NTT')

@section('content')
@include('home.partials.header')

<div id="berita-terkini" class="mt-20 flex place-items-start w-full px-10">
    <main class="relative z-10 gap-20 p-8 flex w-full">
        <div class="text-left w-full">

            {{-- Breadcrumb --}}
            <div class="mb-4 font-montserrat text-sm breadcrumbs">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-base-content/60 hover:text-primary">Beranda</a></li>
                    <li><span class="text-base-content/60">Publikasi</span></li>
                    <li><span class="text-primary font-semibold">Dokumen</span></li>
                </ul>
            </div>

            {{-- Heading --}}
            <h2 class="text-2xl md:text-5xl font-bold sm:tracking-tight mb-1 md:mb-5 font-montserrat text-primary">
                Dokumen
            </h2>

            {{-- Description --}}
            <div class="mb-10 text-md md:text-base font-inter">
                Unduh berbagai regulasi, dokumen, dan buku yang dapat membantu Anda dalam pengembangan profesionalisme.
            </div>

            {{-- Search --}}
            <div class="mb-4 font-inter">
                <input
                    type="text"
                    id="dokumen-search"
                    placeholder="Cari dokumen..."
                    class="input input-bordered w-full max-w-sm text-sm"
                    onkeyup="filterDokumen()"
                >
            </div>

            {{-- Table --}}
            <div class="w-full flex-wrap font-inter overflow-x-auto">
                <table class="table w-full text-sm border-collapse" id="dokumen-table">
                    <thead>
                        <tr class="border-b-2 border-base-300 bg-base-200">
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content w-10">No.</th>
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content">Judul Dokumen</th>
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content whitespace-nowrap hidden sm:table-cell">Tanggal Unggah</th>
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content">Ukuran File</th>
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content">Kategori</th>
                            <th class="py-3 px-4 text-left font-montserrat font-semibold text-base-content">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dokumen-tbody">
                        @forelse($dokumens as $index => $doc)
                            @php
                                $fileUrl = \Illuminate\Support\Str::startsWith($doc->file_url, ['http://', 'https://'])
                                    ? $doc->file_url
                                    : asset('storage/' . $doc->file_url);
                                $bytes = $doc->file_size;
                                $units = ['B', 'KB', 'MB', 'GB'];
                                $i = 0;
                                while ($bytes >= 1024 && $i < count($units) - 1) {
                                    $bytes /= 1024;
                                    $i++;
                                }
                                $fileSize = $doc->file_size ? round($bytes, 2) . ' ' . $units[$i] : '-';
                            @endphp
                            <tr class="border-b border-base-200 hover:bg-base-100 transition-colors dokumen-row">
                                <td class="py-3 px-4 text-base-content/50">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 text-base-content dokumen-judul">{{ $doc->judul }}</td>
                                <td class="py-3 px-4 text-base-content/60 whitespace-nowrap hidden sm:table-cell">
                                    {{ \Carbon\Carbon::parse($doc->created_at)->locale('id')->isoFormat('D MMM YYYY') }}
                                </td>
                                <td class="py-3 px-4 text-base-content/60 whitespace-nowrap hidden sm:table-cell">
                                    {{ $fileSize }}
                                </td>
                                <td class="py-3 px-4 text-base-content/60 whitespace-nowrap hidden sm:table-cell">
                                    {{ $doc->kategori ?? '-' }}
                                </td>
                                <td class="py-3 px-4 text-base-content/60 whitespace-nowrap hidden sm:table-cell">
                                    @if($doc->file_url || $doc->file_name)
                                        <a href="{{ $doc->file_url ? $fileUrl : asset('storage/' . $doc->file_name) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="btn btn-sm btn-primary gap-1 inline-flex items-center font-medium">
                                            <i class="fa-solid fa-download text-xs"></i>
                                                            <span class="hidden sm:inline">Unduh</span>
                                        </a>
                                    @else
                                        <span class="text-base-content/30 text-xs">Tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="no-data-row">
                                <td colspan="4" class="py-10 text-center text-base-content/40 font-inter">
                                    Belum ada dokumen tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Empty state when search yields no results --}}
                <div id="no-results" class="hidden py-10 text-center text-base-content/40 font-inter">
                    Tidak ada dokumen yang cocok dengan pencarian.
                </div>
            </div>

        </div>
    </main>
</div>

@include('home.partials.footer')

@push('scripts')
<script>
    function filterDokumen() {
        const input = document.getElementById('dokumen-search').value.toLowerCase();
        const rows = document.querySelectorAll('.dokumen-row');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const judul = row.querySelector('.dokumen-judul').textContent.toLowerCase();
            if (judul.includes(input)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('no-results').classList.toggle('hidden', visibleCount > 0);
    }
</script>
@endpush

@endsection
