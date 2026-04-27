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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" integrity="sha384-nRgPTkuX86pH8yjPJUAFuASXQSSl2/bBUiNV47vSYpKFxHJhbcrGnmlYpYJMeD7a" crossorigin="anonymous">

    <meta name="theme-color" content="#297bbf">


    <script nonce="{{ $cspNonce }}">
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
