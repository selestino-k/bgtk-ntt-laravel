<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - BGTK Provinsi NTT</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/assets/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|inter:400,500,600,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33409da17b.js" crossorigin="anonymous"></script>

    <script>
        const t = localStorage.getItem('theme');
        if (t) document.documentElement.setAttribute('data-theme', t);
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @yield('content')

    @stack('scripts')
</body>

</html>
