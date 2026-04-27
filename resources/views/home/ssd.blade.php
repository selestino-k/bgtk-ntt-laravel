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

                    {{-- Item 1 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" checked="checked" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Apa Itu BGTK NTT?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>
                                BGTK Provinsi NTT adalah singkatan dari Balai Guru dan Tenaga Kependidikan Provinsi Nusa
                                Tenggara Timur. Lembaga ini merupakan Unit Pelaksana Teknis (UPT) di bawah Direktorat
                                Jenderal Guru, Tenaga Kependidikan dan Pendidikan Guru, Kementerian Pendidikan Dasar dan
                                Menengah yang bertugas untuk melaksanakan pengembangan dan pemberdayaan guru, kepala sekolah,
                                pendidik lainnya, dan tenaga kependidikan.
                            </p>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Di Mana BGTK NTT Berlokasi?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>
                                BGTK NTT berlokasi di Jl. Perintis Kemerdekaan I, Kayu Putih, Kec. Oebobo, Kota Kupang,
                                Nusa Tenggara Timur. <br/>
                                Lokasi di Google Maps dapat dilihat <a href="https://maps.app.goo.gl/fR76vqUh6ESDNZ8Z6" target="_blank"
                                    class="text-primary hover:underline font-bold">di sini</a>
                            </p>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Apa Saja Layanan yang Disediakan oleh BGTK NTT?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>BGTK NTT menyediakan berbagai layanan, antara lain:</p>
                            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                                <li>Pelatihan dan Pengembangan Profesional Guru</li>
                                <li>Workshop dan Seminar Pendidikan</li>
                                <li>Penyediaan Sumber Belajar dan Materi Pendidikan</li>
                                <li>Pendampingan dan Konsultasi bagi Guru dan Tenaga Kependidikan</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Item 4 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Bagaimana Cara Menghubungi BGTK NTT?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>Anda dapat menghubungi BGTK NTT melalui:</p>
                            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                                <li>Telepon: (0380) 821234</li>
                                <li>Email: bgtkntt@kemendikdasmen.go.id</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Item 5 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Apa itu program Koding dan Kecerdasan Artifisial (KKA)?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>
                                Program Koding dan KA merupakan program peningkatan kompetensi Guru yang diinisiasi oleh
                                Kementerian Pendidikan Dasar dan Menengah melalui Direktorat Jenderal Guru, Tenaga
                                Kependidikan dan Pendidikan Guru (GTKPG) dalam rangka mendukung program ASTA CITA Presiden
                                dan Wakil Presiden Republik Indonesia.
                            </p>
                        </div>
                    </div>

                    {{-- Item 6 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Bagaimana cara mendaftar program Koding dan Kecerdasan Artifisial (KKA)?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>
                                Pendaftaran bisa dilakukan melalui website:
                                <a href="https://kodingka.belajar.id" target="_blank"
                                    class="text-primary hover:underline">https://kodingka.belajar.id</a>.
                                Jika mendapati kesulitan dapat menghubungi BGTK NTT melalui kontak yang tersedia.
                            </p>
                        </div>
                    </div>

                    {{-- Item 7 --}}
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title font-montserrat text-primary font-semibold text-lg">
                            Apa saja persyaratan untuk mengikuti Program Koding dan KA?
                        </div>
                        <div class="collapse-content font-inter text-base-content">
                            <p>
                                Guru terdaftar di DAPODIK dan memiliki email belajar.id serta direkomendasikan oleh kepala
                                sekolah untuk mengikuti Program Koding dan Kecerdasan Artifisial.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    @include('home.partials.footer')
@endsection
