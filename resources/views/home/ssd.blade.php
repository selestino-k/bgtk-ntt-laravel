@extends('home.layouts.app')

@section('title', 'SSD - Soal Sering Ditanya')

@section('content')
    @include('home.partials.header')

    <div id="faq" class="mt-20 w-full max-w-7xl px-4 md:px-10 font-montserrat">
        <main class="relative z-10 flex flex-col gap-3 p-8 w-full">

            {{-- Breadcrumb --}}
            <div class="text-sm text-base-content/50">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span class="mx-2">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
                <span class="text-primary">SSD</span>
            </div>

            <div>
                <h2 class="text-2xl md:text-5xl font-bold tracking-tight mb-1 md:mb-5 text-primary">
                    Soal Sering Ditanya (SSD)
                </h2>
                <p class="text-balance md:text-base font-inter mb-6">
                    Temukan jawaban atas pertanyaan yang sering diajukan seputar BGTK NTT dan layanannya.
                </p>

                {{-- FAQ Accordion --}}
                <div class="max-w-3xl w-full flex flex-col gap-2">

                    @forelse($pertanyaans as $item)
                        <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                            <input type="radio" name="faq-accordion" {{ $loop->first ? 'checked="checked"' : '' }} />
                            <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                                {{ $item->pertanyaan }}
                            </div>
                            <div class="collapse-content font-inter text-base-content">
                                <p>{!! nl2br(e($item->jawaban)) !!}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-base-content/60">Belum ada pertanyaan yang tersedia.</p>
                    @endforelse

                </div>
            </div>

        </main>
    </div>

    @include('home.partials.footer')
@endsection
