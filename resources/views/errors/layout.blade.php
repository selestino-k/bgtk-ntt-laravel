<!DOCTYPE html>
<html lang="id" data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#297bbf">
    <title>@yield('title') - BGTK Provinsi NTT</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/assets/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|inter:400,500,600,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33409da17b.js" crossorigin="anonymous"></script>

    {{-- Persist theme before first paint to avoid flash --}}
    <script>
        const t = localStorage.getItem('theme');
        if (t) document.documentElement.setAttribute('data-theme', t);
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter antialiased">
    <div class="flex w-full min-h-screen">
        @yield('content')
    </div>
</body>

</html>
