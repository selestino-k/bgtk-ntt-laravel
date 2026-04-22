<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk | Panel Admin CMS BGTK NTT</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/assets/favicon.ico') }}">
    <meta name="description"
        content="Selamat datang di panel admin CMS BGTK Provinsi NTT. Masuk untuk mengelola konten dan informasi terkait BGTK NTT dengan mudah dan efisien." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/33409da17b.js" crossorigin="anonymous"></script>
    <style>
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
            box-shadow: 0 0 0px 1000px #ffffff inset !important;
            -webkit-text-fill-color: #111827 !important;
            caret-color: #111827 !important;
        }
    </style>
</head>

<body>
    <div class="relative grid w-full min-h-screen">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/assets/bgtk-background.webp') }}" alt="Background"
                class="w-full h-full object-cover opacity-85 dark:opacity-50" />
        </div>
        {{-- Dark mode toggle --}}
        <div id="dark-mode-toggle" class="absolute top-4 right-4 z-10 flex items-center gap-2">
            <i class="fa-solid fa-sun dark:text-white text-gray-900"></i>

            <input type="checkbox" checked="unchecked" class="toggle toggle-sm" />
            <i class="fa-solid fa-moon dark:text-white text-gray-900"></i>
        </div>

        {{-- Login Card --}}
        <main
            class="font-montserrat relative z-10 w-full max-w-md mx-auto my-auto space-y-6 p-8 rounded-xl shadow-lg bg-white/90 dark:bg-gray-800/90">
            {{-- Logo & Header --}}
            <div class="space-y-2 text-center">
                <div class="pb-6 flex items-center justify-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/assets/logo-web-bgtk-ntt.webp') }}" alt="Logo BGTK NTT"
                            width="300" height="100"
                            class="object-contain opacity-100 hover:opacity-80 transition-opacity dark:hidden" />
                        <img src="{{ asset('images/assets/logo-web-bgtk-ntt-dark.webp') }}" alt="Logo BGTK NTT Dark"
                            width="300" height="100"
                            class="object-contain hover:opacity-80 transition-opacity hidden dark:block" />
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-primary mb-1">Selamat Datang</h1>
                <h2 class="text-base text-gray-900 dark:text-gray-100">Panel Admin CMS <br />BGTK Provinsi NTT</h2>
            </div>

            {{-- Login Form --}}
            <form method="POST" action="/login" class="space-y-4">
                @csrf

                {{-- Username --}}
                <div class="space-y-1  text-gray-900 dark:text-gray-100 ">
                    <label for="username" class="block text-sm font-medium">
                        Username
                    </label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required
                        autofocus autocomplete="username" placeholder="Masukkan username"
                        class="input input-bordered w-full @error('username') input-error @enderror bg-white! dark:bg-gray-800! rounded-lg" />
                    @error('username')
                        <p class="text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1  text-gray-900 dark:text-gray-100 ">
                    <label for="password" class="block text-sm font-medium">
                        Password
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="input input-bordered w-full @error('password') input-error @enderror bg-white! dark:bg-gray-800! rounded-lg" />
                    @error('password')
                        <p class="text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-full mt-2">
                    Masuk
                </button>
            </form>
        </main>
    </div>
</body>

</html>
