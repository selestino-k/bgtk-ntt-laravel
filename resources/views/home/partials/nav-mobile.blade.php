<script>
    function openNavSheet() {
        document.getElementById('nav-sheet').classList.remove('-translate-x-full');
        document.getElementById('nav-overlay').classList.remove('hidden');
    }

    function closeNavSheet() {
        document.getElementById('nav-sheet').classList.add('-translate-x-full');
        document.getElementById('nav-overlay').classList.add('hidden');
    }
</script>

{{-- Mobile drawer overlay --}}
<div id="nav-overlay" class="fixed inset-0 bg-black/40 z-40 hidden xl:hidden" onclick="closeNavSheet()"></div>

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
        <button onclick="closeNavSheet()" class="btn btn-ghost btn-sm btn-circle">
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
                    <li><a href="/publikasi/dokumen">Dokumen</a></li>
                    <li><a href="/publikasi/sakip">SAKIP</a></li>
                    <li><a href="https://kemendikdasmen.go.id/pencarian/siaran-pers" target="_blank"
                            rel="noopener noreferrer">Siaran Pers Kemendikdasmen</a></li>
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
                    <li><a href="https://mail.kemdikbud.go.id/" target="_blank" rel="noopener noreferrer">e-Mail
                            Kemendikdasmen</a></li>
                    <li><a href="https://data.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer">Portal
                            Data Kemendikdasmen</a></li>
                    <li><a href="https://rumah.pendidikan.go.id/" target="_blank" rel="noopener noreferrer">Rumah
                            Pendidikan</a></li>
                    <li><a href="https://data-sdm.kemdikbud.go.id/" target="_blank"
                            rel="noopener noreferrer">SIPdasmen</a></li>
                    <li><a href="https://dapo.kemendikdasmen.go.id/" target="_blank"
                            rel="noopener noreferrer">Dapodik</a></li>
                    <li><a href="https://info.gtk.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer">Info
                            GTK</a></li>
                    <li><a href="https://raporpendidikan.kemendikdasmen.go.id/login" target="_blank"
                            rel="noopener noreferrer">Rapor Pendidikan</a></li>
                    <li><a href="https://sinde.kemendikdasmen.go.id/" target="_blank"
                            rel="noopener noreferrer">SINDE</a></li>
                    <li><a href="https://skp.sdm.kemdikbud.go.id/skp/site/login.jsp" target="_blank"
                            rel="noopener noreferrer">e-SKP</a></li>
                </ul>
            </details>
        </li>
        <li><a href="/zi-wbk" class="font-semibold text-primary">ZI-WBK</a></li>
        <li><a href="/ssd" class="font-semibold text-primary">SSD</a></li>
    </ul>
</div>
