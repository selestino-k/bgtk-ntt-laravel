@include('(home).partials.nav-mobile')

{{-- Main navbar --}}
<header class="fixed top-0 left-0 right-0 z-30 w-full py-2 bg-white/85 backdrop-blur-sm shadow-sm">
    <div class="flex h-16 max-w-screen items-center xl:justify-between px-4">

        {{-- Hamburger button (mobile only) --}}
        <div class="xl:hidden flex">
            <button onclick="openNavSheet()" class="btn btn-ghost btn-sm" aria-label="Open menu">
                <i class="fa-solid fa-bars text-xl text-primary"></i>
            </button>
        </div>

        {{-- Logo --}}
        <a href="/" class="flex items-center xl:px-2 px-6">
            <img src="/images/assets/logo-web-bgtk-ntt.webp" alt="Balai GTK Logo" class="h-10 w-auto"
                onerror="this.style.display='none'">
        </a>

        {{-- Desktop navigation menu --}}
        <nav class="hidden xl:flex items-center font-montserrat font-semibold text-primary gap-6">

            {{-- Profil --}}
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-sm text-sm text-primary font-semibold">
                    Profil <i class="fa-solid fa-chevron-down text-xs"></i>
                </label>
                <ul tabindex="0" class="dropdown-content menu bg-white/90 backdrop-blur-sm rounded-box z-10 w-52 p-2 shadow-xl border border-base-200">
                    <li><a href="/profil/sambutan-kata" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Sambutan Kata</a></li>
                    <li><a href="/profil/sejarah" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Sejarah</a></li>
                    <li><a href="/profil/struktur-organisasi" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Struktur Organisasi</a></li>
                    <li><a href="/profil/tupoksi" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Tugas Pokok dan Fungsi</a></li>
                    <li><a href="/profil/visi-misi" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Visi Misi</a></li>
                </ul>
            </div>

            {{-- Publikasi --}}
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-sm text-sm text-primary font-semibold">
                    Publikasi <i class="fa-solid fa-chevron-down text-xs"></i>
                </label>
                <ul tabindex="0" class="dropdown-content menu bg-white/90 backdrop-blur-sm rounded-box z-10 w-52 p-2 shadow-xl border border-base-200">
                    <li><a href="/publikasi/berita-terkini" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Berita Terkini</a></li>
                    <li><a href="/publikasi/pengumuman" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Pengumuman</a></li>
                    <li><a href="/publikasi/dokumen" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Dokumen</a></li>
                    <li><a href="/publikasi/sakip" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">SAKIP</a></li>
                    <li><a href="https://kemendikdasmen.go.id/pencarian/siaran-pers" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary  hover:bg-gray-700/10">Siaran Pers Kemendikdasmen</a></li>
                </ul>
            </div>

            {{-- ULT --}}
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-sm text-sm text-primary font-semibold">
                    ULT <i class="fa-solid fa-chevron-down text-xs"></i>
                </label>
                <ul tabindex="0" class="dropdown-content menu bg-white/90 backdrop-blur-sm rounded-box z-10 w-56 p-2 shadow-xl border border-base-200">
                    <li><a href="/ult/sarana-prasarana" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Sarana dan Prasarana</a></li>
                    <li><a href="https://s.id/ult-bgtkntt" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Survei Kepuasan Masyarakat (SKM)</a></li>
                    <li><a href="https://prod.lapor.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">SP4N Lapor</a></li>
                    <li><a href="https://wbs.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">WBS Itjen</a></li>
                    <li><a href="https://posko-pengaduan.itjen.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Aduan Itjen</a></li>
                    <li><a href="https://sippn.menpan.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">SIPPN</a></li>
                </ul>
            </div>

            {{-- PPID --}}
            <a href="/ppid" class="btn btn-ghost btn-sm text-sm text-primary font-semibold hover:text-primary/70 transition-colors">PPID</a>

            {{-- Aplikasi --}}
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-sm text-sm text-primary font-semibold">
                    Aplikasi <i class="fa-solid fa-chevron-down text-xs"></i>
                </label>
                <ul tabindex="0" class="dropdown-content menu bg-white/90 backdrop-blur-sm rounded-box z-10 w-52 p-2 shadow-xl border border-base-200">
                    <li><a href="https://mail.kemdikbud.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">e-Mail Kemendikdasmen</a></li>
                    <li><a href="https://data.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Portal Data Kemendikdasmen</a></li>
                    <li><a href="https://rumah.pendidikan.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Rumah Pendidikan</a></li>
                    <li><a href="https://data-sdm.kemdikbud.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">SIPdasmen</a></li>
                    <li><a href="https://dapo.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Dapodik</a></li>
                    <li><a href="https://info.gtk.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Info GTK</a></li>
                    <li><a href="https://raporpendidikan.kemendikdasmen.go.id/login" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">Rapor Pendidikan</a></li>
                    <li><a href="https://sinde.kemendikdasmen.go.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">SINDE</a></li>
                    <li><a href="https://skp.sdm.kemdikbud.go.id/skp/site/login.jsp" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-black hover:text-primary hover:bg-gray-700/10">e-SKP</a></li>
                </ul>
            </div>

            {{-- ZI-WBK --}}
            <a href="/zi-wbk" class="btn btn-ghost btn-sm text-sm text-primary font-semibold hover:text-primary/70 transition-colors">ZI-WBK</a>

            {{-- SSD --}}
            <a href="/ssd" class="btn btn-ghost btn-sm text-sm text-primary font-semibold hover:text-primary/70 transition-colors">SSD</a>

        </nav>

        {{-- Right partner logos (desktop only) --}}
        <div class="hidden xl:flex items-center gap-4">
            <img src="/images/assets/ramah-ori.webp" alt="Kemendikdasmen Ramah" class="h-12 w-auto"
                onerror="this.style.display='none'">
            <img src="/images/assets/pendidikan-bermutu-ori.webp" alt="Pendidikan Bermutu" class="h-12 w-auto"
                onerror="this.style.display='none'">
        </div>

    </div>
</header>


