<!DOCTYPE html>
<html lang="id" data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, nocache">

    <title>@yield('title', 'Panel Admin') | Panel Admin Web BGTK NTT</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|inter:400,500,600,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33409da17b.js" crossorigin="anonymous"></script>

    <script>
        // Apply saved theme before render to avoid flash
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-montserrat">

    {{-- Sidebar drawer layout --}}
    <div class="flex h-screen overflow-hidden bg-base-100">

        {{-- Sidebar --}}
        <aside id="admin-sidebar"
            class="flex-shrink-0 w-[250px] h-full flex flex-col bg-base-200 border-r border-base-300 transition-all duration-300 overflow-y-auto"
            aria-label="Sidebar navigasi admin">
            @include('admin.partials.sidebar')
        </aside>

        {{-- Main area --}}
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

            {{-- Topbar --}}
            @include('admin.partials.topbar')

            {{-- Page content --}}
            <main class="flex-1 overflow-y-auto bg-base-100">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')

    {{-- Sidebar toggle script --}}
    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>
