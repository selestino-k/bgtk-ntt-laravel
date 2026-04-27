@extends('errors.layout')

@section('title', '403 Forbidden')

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
                <h1 class="text-5xl sm:text-7xl lg:text-9xl font-bold font-montserrat text-primary">
                    403
                </h1>
                <h2 class="text-2xl lg:text-4xl mt-2 text-primary font-bold font-montserrat">
                    Forbidden
                </h2>
                <p class="text-lg mt-4 mb-6 font-semibold text-black dark:text-white font-montserrat">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                </p>
            </div>

            <div class="flex items-center gap-4 font-montserrat">
                <a
                    onclick="history.back()"
                    class="btn btn-md btn-outline text-md px-6 cursor-pointer"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ url('/') }}" class="btn btn-md btn-primary text-md px-6">
                    <i class="fa-solid fa-house"></i>
                    Beranda
                </a>
            </div>

        </main>
    </div>
</div>
@endsection
