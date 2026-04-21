{{-- Sidebar Logo --}}
<div class="flex items-center justify-center p-4 border-b border-base-300">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/assets/logo-web-bgtk-ntt.webp') }}" alt="Logo BGTK NTT"
            class="h-10 w-auto object-contain dark:hidden" />
        <img src="{{ asset('images/assets/logo-web-bgtk-ntt-dark.webp') }}" alt="Logo BGTK NTT"
            class="h-10 w-auto object-contain hidden dark:block" />
    </a>
</div>

{{-- Sidebar Navigation --}}
<nav class="flex-1 px-3 py-4 space-y-1" aria-label="Menu admin">

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-gauge-high w-4 text-center"></i>
        <span>Dashboard</span>
    </a>

    {{-- Konten section --}}
    <div class="pt-4 pb-1 px-3">
        <p class="text-xs font-semibold uppercase tracking-wider text-base-content/50">Konten</p>
    </div>

    {{-- Berita --}}
    <a href="{{ route('admin.publikasi.berita.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.publikasi.berita.*') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-newspaper w-4 text-center"></i>
        <span>Berita</span>
    </a>

    {{-- Pengumuman --}}
    <a href="{{ route('admin.publikasi.pengumuman.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.publikasi.pengumuman.*') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-bullhorn w-4 text-center"></i>
        <span>Pengumuman</span>
    </a>

    {{-- Dokumen --}}
    <a href="{{ route('admin.publikasi.dokumen.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.publikasi.dokumen.*') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-file-lines w-4 text-center"></i>
        <span>Dokumen</span>
    </a>

    {{-- Manajemen section --}}
    <div class="pt-4 pb-1 px-3">
        <p class="text-xs font-semibold uppercase tracking-wider text-base-content/50">Manajemen</p>
    </div>

    {{-- Tag --}}
    <a href="{{ route('admin.publikasi.tag.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.publikasi.tag.*') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-tags w-4 text-center"></i>
        <span>Tag</span>
    </a>

    {{-- Profil --}}
    <a href="{{ route('admin.profil.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('admin.profiles.*') ? 'bg-primary text-primary-content' : 'text-base-content hover:bg-base-300' }}">
        <i class="fa-solid fa-id-card w-4 text-center"></i>
        <span>Profil</span>
    </a>

</nav>

{{-- Sidebar Footer: User info + Logout --}}
<div class="p-4 border-t border-base-300">
    <div class="flex items-center gap-3 mb-3">
        <div class="avatar placeholder">
            <div class="bg-primary text-primary-content rounded-full w-9 h-9 flex items-center justify-center">
                <span class="text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                </span>
            </div>
        </div>
        <div class="min-w-0">
            <p class="text-sm font-semibold truncate text-base-content">
                {{ Auth::user()->username ?? 'Admin' }}
            </p>
            <p class="text-xs text-base-content/60 capitalize">
                {{ Auth::user()->role ?? 'Admin' }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="flex items-center gap-2 w-full px-3 py-2 rounded-lg text-sm font-medium text-error hover:bg-error/10 transition-colors">
            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
            <span>Keluar</span>
        </button>
    </form>
</div>
