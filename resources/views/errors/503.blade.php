@extends('errors.layout')

@section('title', 'Sedang Dalam Pemeliharaan')

@section('content')
<div class="grid w-full">
    <div class="flex items-center justify-center min-h-screen w-full relative">

        {{-- Background image --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img
                src="{{ asset('images/assets/bgtk-background.webp') }}"
                alt="Background"
                class="w-full h-full object-cover opacity-50 grayscale dark:brightness-[0.3]"
            />
        </div>

        <main class="relative z-10 flex flex-col gap-3 items-center p-8 w-full">

            {{-- Logo light --}}
            <img
                src="{{ asset('images/assets/logo-web-bgtk-ntt.webp') }}"
                alt="Logo BGTK"
                class="w-full max-w-md dark:hidden"
            />
            {{-- Logo dark --}}
            <img
                src="{{ asset('images/assets/logo-web-bgtk-ntt-dark.webp') }}"
                alt="Logo BGTK"
                class="w-full max-w-md hidden dark:block"
            />

            <div class="text-center mt-2 max-w-full">
                <div class="flex justify-center mb-4">
                    <i class="fa-solid fa-wrench text-primary text-5xl sm:text-7xl lg:text-9xl"></i>
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold font-montserrat text-primary mt-4">
                    Pemeliharaan
                </h1>
                <h2 class="text-xl lg:text-3xl mt-2 text-primary font-bold font-montserrat">
                    Sistem Sedang Diperbaiki
                </h2>
                <p class="text-lg mt-4 mb-6 font-semibold text-black dark:text-white font-montserrat">
                    Mohon maaf atas ketidaknyamanannya. Website BGTK Provinsi NTT<br>
                    sedang dalam proses pemeliharaan. Silakan kembali beberapa saat lagi.
                </p>
            </div>

        </main>
    </div>
</div>
@endsection
