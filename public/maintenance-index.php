<?php
// Maintenance mode — upload this file as index.php to public_html during deployment
http_response_code(503);
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#297bbf">
    <meta name="robots" content="noindex, nofollow">
    <title>Sedang Dalam Pemeliharaan - BGTK Provinsi NTT</title>
    <link rel="icon" type="image/x-icon" href="images/assets/favicon.ico">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|inter:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" integrity="sha384-nRgPTkuX86pH8yjPJUAFuASXQSSl2/bBUiNV47vSYpKFxHJhbcrGnmlYpYJMeD7a" crossorigin="anonymous">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #297bbf;
            --bg-body: #fafafa;
            --text-main: #1a1a2e;
            --text-sub: #1a1a2e;
        }

        [data-theme="dark"] {
            --bg-body: #111827;
            --text-main: #e5e7eb;
            --text-sub: #e5e7eb;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        .page-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* Background image */
        .bg-image {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .bg-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
            filter: grayscale(100%);
        }
        [data-theme="dark"] .bg-image img {
            opacity: 0.3;
            filter: grayscale(100%) brightness(0.3);
        }

        /* Dark mode overlay for body bg */
        [data-theme="dark"] .page-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(17, 24, 39, 0.6);
            z-index: 1;
        }

        /* Main content */
        main {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            padding: 2rem;
            width: 100%;
            text-align: center;
        }

        /* Logo */
        .logo {
            width: 100%;
            max-width: 28rem;
        }
        .logo-dark { display: none; }
        [data-theme="dark"] .logo-light { display: none; }
        [data-theme="dark"] .logo-dark  { display: block; }

        /* Wrench icon */
        .icon-wrench {
            color: var(--primary);
            font-size: clamp(3rem, 8vw, 6rem);
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* Headings */
        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: clamp(1.875rem, 5vw, 3.75rem);
            color: var(--primary);
            margin-top: 1rem;
        }
        h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: clamp(1.25rem, 3vw, 1.875rem);
            color: var(--primary);
            margin-top: 0.5rem;
        }
        p.desc {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.0625rem;
            color: var(--text-sub);
            margin-top: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.75;
        }

        /* Theme toggle button */
        .theme-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 9999px;
            width: 2.5rem;
            height: 2.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: background 0.2s, color 0.2s;
        }
        .theme-toggle:hover {
            background: var(--primary);
            color: #fff;
        }
        .icon-moon  { display: block; }
        .icon-sun   { display: none;  }
        [data-theme="dark"] .icon-moon { display: none;  }
        [data-theme="dark"] .icon-sun  { display: block; }
    </style>
</head>

<body>
    <!-- Theme toggle -->
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark mode">
        <i class="fa-solid fa-moon icon-moon"></i>
        <i class="fa-solid fa-sun icon-sun"></i>
    </button>

    <div class="page-wrapper">
        <!-- Background image -->
        <div class="bg-image">
            <img src="images/assets/bgtk-background.webp" alt="Background">
        </div>

        <main>
            <!-- Logo light -->
            <img
                class="logo logo-light"
                src="images/assets/logo-web-bgtk-ntt.webp"
                alt="Logo BGTK NTT"
            >
            <!-- Logo dark -->
            <img
                class="logo logo-dark"
                src="images/assets/logo-web-bgtk-ntt-dark.webp"
                alt="Logo BGTK NTT"
            >

            <i class="fa-solid fa-wrench icon-wrench"></i>

            <h1>Pemeliharaan</h1>
            <h2>Sistem Sedang Diperbaiki</h2>

            <p class="desc">
                Mohon maaf atas ketidaknyamanannya. Website BGTK Provinsi NTT<br>
                sedang dalam proses pemeliharaan. Silakan kembali beberapa saat lagi.
            </p>
        </main>
    </div>

    <script>
        // Apply saved theme before render to avoid flash
        (function () {
            var t = localStorage.getItem('theme');
            if (t === 'mytheme-dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();

        function toggleTheme() {
            var html = document.documentElement;
            var isDark = html.getAttribute('data-theme') === 'dark';
            html.setAttribute('data-theme', isDark ? 'light' : 'dark');
            localStorage.setItem('theme', isDark ? 'mytheme' : 'mytheme-dark');
        }
    </script>
</body>

</html>
