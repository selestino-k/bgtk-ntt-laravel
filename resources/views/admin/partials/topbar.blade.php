<header class="flex items-center justify-between px-4 py-3 bg-base-100 border-b border-base-300 shadow-sm">

    {{-- Left: Sidebar toggle + Breadcrumb --}}
    <div class="flex items-center gap-3">
        <button id="sidebar-toggle"
            class="btn btn-ghost btn-sm btn-square"
            aria-label="Toggle sidebar">
            <i class="fa-solid fa-bars text-base"></i>
        </button>

        @isset($breadcrumb)
            <div class="breadcrumbs text-sm hidden sm:flex">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}" class="text-base-content/60 hover:text-primary">Dashboard</a></li>
                    @foreach($breadcrumb as $label => $url)
                        @if($loop->last)
                            <li class="text-primary font-medium">{{ $label }}</li>
                        @else
                            <li><a href="{{ $url }}" class="text-base-content/60 hover:text-primary">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endisset
    </div>

    {{-- Right: Dark mode toggle --}}
    <div id="dark-mode-toggle" class="flex items-center gap-2">
        <i class="fa-solid fa-sun text-sm text-base-content"></i>
        <input type="checkbox" class="toggle toggle-sm toggle-primary" aria-label="Toggle dark mode" />
        <i class="fa-solid fa-moon text-sm text-base-content"></i>
    </div>

</header>
