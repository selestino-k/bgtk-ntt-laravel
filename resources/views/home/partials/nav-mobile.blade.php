<script nonce="{{ $cspNonce }}">
    document.addEventListener('DOMContentLoaded', function () {
        var sheet   = document.getElementById('nav-sheet');
        var overlay = document.getElementById('nav-overlay');
        var openBtn = document.getElementById('nav-open-btn');
        var closeBtn = document.getElementById('nav-close-btn');

        function openNavSheet() {
            sheet.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeNavSheet() {
            sheet.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        if (openBtn)  openBtn.addEventListener('click', openNavSheet);
        if (closeBtn) closeBtn.addEventListener('click', closeNavSheet);
        if (overlay)  overlay.addEventListener('click', closeNavSheet);
    });
</script>

{{-- Mobile drawer overlay --}}
<div id="nav-overlay" class="fixed inset-0 bg-black/40 z-40 hidden xl:hidden"></div>

{{-- Mobile slide-in sheet --}}
<div id="nav-sheet"
    class="fixed top-0 left-0 h-full w-72 bg-white dark:bg-base-200 z-50 shadow-xl overflow-y-auto transform -translate-x-full transition-transform duration-300 xl:hidden">
    <div class="flex items-center justify-between px-4 py-4">
        <a href="/" class="flex items-center gap-2">
        <img src="/images/assets/logo-web-bgtk-ntt.webp" alt="Balai GTK Logo" class="h-10 w-auto dark:hidden"
            onerror="this.style.display='none'">
        <img src="/images/assets/logo-web-bgtk-ntt-dark.webp" alt="Balai GTK Logo" class="h-10 w-auto hidden dark:block"
            onerror="this.style.display='none'">
         </a>
        <button id="nav-close-btn" class="btn btn-ghost btn-sm btn-circle">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>
    {{-- dark mode toggle --}}
    <div id="dark-mode-toggle" class="flex items-center gap-2 mx-6 my-4 mb-6">
        <i class="fa-solid fa-sun text-sm text-base-content"></i>
        <input type="checkbox" class="toggle toggle-sm toggle-primary" aria-label="Toggle dark mode" />
        <i class="fa-solid fa-moon text-sm text-base-content"></i>
    </div>
    <ul class="menu w-full font-montserrat text-sm font-medium text-primary dark:text-primary px-2 py-4 gap-6">
        <li>
            <details>
                <summary class="font-semibold text-primary">Profil</summary>
                <ul>
                    <li><a href="/profil/sambutan-kata">Sambutan Kata</a></li>
                    <li><a href="/profil/sejarah">Sejarah</a></li>
                    <li><a href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                    <li><a href="/profil/tupoksi">Tugas Pokok dan Fungsi</a></li>
                    <li><a href="/profil/visi-misi">Visi Misi</a></li>
                </ul>
            </details>
        </li>
        <li>
            <details>
                <summary class="font-semibold text-primary">Publikasi</summary>
                <ul>
                    <li><a href="/publikasi/berita-terkini">Berita Terkini</a></li>
                    <li><a href="/publikasi/pengumuman">Pengumuman</a></li>
                    <li><a href="/publikasi/siaran-pers">Siaran Pers</a></li>
                    <li><a href="/publikasi/dokumen">Dokumen</a></li>
                    <li><a href="/publikasi/maklumat-pelayanan">Maklumat Pelayanan</a></li>
                    
                </ul>
            </details>
        </li>
        <li>
            <details>
                <summary class="font-semibold text-primary">ULT</summary>
                <ul>
                    <li><a href="/ult/sarana-prasarana">Sarana dan Prasarana</a></li>
                    <li><a href="https://s.id/ult-bgtkntt" target="_blank" rel="noopener noreferrer">Survei Kepuasan
                            Masyarakat (SKM)</a></li>
                    <li><a href="https://prod.lapor.go.id/" target="_blank" rel="noopener noreferrer">SP4N Lapor</a>
                    </li>
                    <li><a href="https://wbs.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer">WBS
                            Itjen</a></li>
                    <li><a href="https://posko-pengaduan.itjen.kemendikdasmen.go.id/" target="_blank"
                            rel="noopener noreferrer">Aduan Itjen</a></li>
                    <li><a href="https://sippn.menpan.go.id/" target="_blank" rel="noopener noreferrer">SIPPN</a></li>
                </ul>
            </details>
        </li>
        <li><a href="/ppid" class="font-semibold text-primary hover:text-primary/70">PPID</a></li>
        <li>
            <details>
                <summary class="font-semibold text-primary">Aplikasi</summary>
                <ul>
                    @forelse ($appLinks as $appLink)
                        <li>
                            <a href="{{ $appLink->url }}" target="_blank" rel="noopener noreferrer">
                                {{ $appLink->nama }}
                            </a>
                        </li>
                    @empty
                        <li><a href="#">Belum ada aplikasi</a></li>
                    @endforelse
                </ul>
            </details>
        </li>
        <li><a href="/zi-wbk" class="font-semibold text-primary">ZI-WBK</a></li>
        <li><a href="/ssd" class="font-semibold text-primary">SSD</a></li>
    </ul>
</div>
