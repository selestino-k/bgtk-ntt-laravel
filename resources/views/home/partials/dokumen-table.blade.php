<section id="documents" class="flex relative mb-14 items-start w-full max-w-2xl xl:max-w-7xl px-4 sm:px-8 overflow-x-auto xl:overflow-x-hidden">
    <div class="relative z-10 flex flex-col gap-3 justify-center w-full">
        <div class="text-center mb-6">
            <h2 class="text-3xl md:text-5xl font-semibold font-montserrat text-primary">
                <a href="/publikasi/dokumen"
                   class="hover:text-primary/70 transition-colors inline-flex items-center gap-2 justify-center">
                    Dokumen
                </a>
            </h2>
        </div>

        <div class="overflow-x-auto font-inter">
            <table class="w-full text-sm border-collapse min-w-135">
                <thead>
                    <tr class="border-b-2 border-gray-200 bg-gray-50">
                        <th class="py-3 px-4 text-left font-montserrat font-semibold text-gray-700 w-10">#</th>
                        <th class="py-3 px-4 text-left font-montserrat font-semibold text-gray-700">Judul Dokumen</th>
                        <th class="py-3 px-4 text-left font-montserrat font-semibold text-gray-700 whitespace-nowrap">Tanggal Unggah</th>
                        <th class="py-3 px-4 text-left font-montserrat font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $index => $doc)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-gray-400 font-inter">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-inter text-gray-800">{{ $doc['title'] }}</td>
                            <td class="py-3 px-4 text-gray-500 whitespace-nowrap font-inter">
                                {{ \Carbon\Carbon::parse($doc['created_at'])->locale('id')->isoFormat('D MMM YYYY') }}
                            </td>
                            <td class="py-3 px-4">
                                @if(!empty($doc['file_url']))
                                    <a href="{{ $doc['file_url'] }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1 text-primary hover:underline font-medium">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Unduh
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400 font-inter">
                                Belum ada dokumen tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($documents) > 0)
            <div class="mt-4 text-right">
                <a href="/publikasi/dokumen"
                   class="inline-flex items-center gap-2 text-primary font-montserrat font-semibold text-sm hover:underline">
                    Lihat Semua Dokumen
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
