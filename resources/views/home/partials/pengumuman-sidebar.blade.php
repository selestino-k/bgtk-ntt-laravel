<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 sticky top-20">
    <h3 class="font-montserrat font-semibold text-lg text-primary mb-4 pb-2 border-b border-gray-100">
        Pengumuman
    </h3>

    @forelse($pengumuman ?? [] as $item)
        <a href="{{ route('publikasi.berita.show', $item->slug) }}"
           class="block mb-4 pb-4 border-b border-gray-50 last:border-0 last:mb-0 last:pb-0 hover:text-primary transition-colors group">
            <p class="font-inter text-sm text-gray-800 line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                {{ $item->judul }}
            </p>
            <p class="font-inter text-xs text-gray-400">
                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
            </p>
        </a>
    @empty
        <p class="font-inter text-sm text-gray-400 text-center py-6">
            Belum ada pengumuman.
        </p>
    @endforelse
</div>
