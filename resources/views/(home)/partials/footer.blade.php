<footer class="bg-primary w-full">
    <div class="container mx-auto px-4 py-12 md:px-6 max-w-7xl font-montserrat">
        <div class="grid sm:grid-cols-1 gap-8 md:grid-cols-3 place-items-center md:place-items-start">

            <div class="space-y-4 text-center md:text-left">
                <h2 class="lg:text-xl text-sm font-bold text-white">Hubungi Kami</h2>
                <div class="space-y-3 text-xs lg:text-sm text-white">
                    <div class="flex items-start sm:text-left">
                        <i class="fa-solid fa-map-pin mr-2 mt-0.5 shrink-0"></i>
                        <a href="https://maps.app.goo.gl/fR76vqUh6ESDNZ8Z6" target="_blank" rel="noopener noreferrer" class="text-left hover:underline cursor-pointer">
                            <span>
                                Jl. Perintis Kemerdekaan I, Kayu Putih<br>
                                Kec. Oebobo, Kota Kupang, Nusa Tenggara Timur
                            </span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-envelope mr-2"></i>
                        <span>bgtkntt@kemendikdasmen.go.id</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4 text-center md:text-left mb-30 md:mb-0">
                <h3 class="lg:text-xl text-sm font-bold text-white">Tag Berita</h3>
                <div class="flex w-full flex-wrap gap-2 px-3 items-center md:items-start justify-center md:justify-start">
                    @isset($tags)
                        @foreach($tags as $tag)
                            <a href="/publikasi/berita-terkini?tag={{ $tag->id }}"
                               class="badge {{ request('tag') == $tag->id ? 'badge-neutral' : 'badge-soft badge-neutral' }} px-2 py-1 text-xs font-semibold hover:opacity-80 cursor-pointer">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>

            <div class="space-y-4 text-center md:text-left">
                <h3 class="lg:text-xl text-sm font-bold text-white">Tautan Terkait</h3>
                <ul class="space-y-2 text-xs lg:text-sm text-white">
                    <li>
                        <a href="https://ijazah.data.kemendikdasmen.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Portal data Induk Ijazah
                        </a>
                    </li>
                    <li>
                        <a href="https://pisn.kemdiktisaintek.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Penomoran Ijazah dan Sertifikat Nasional (PISN)
                        </a>
                    </li>
                    <li>
                        <a href="https://pddikti.kemdiktisaintek.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Pangkalan Data Pendidikan Tinggi (PDDikti)
                        </a>
                    </li>
                    <li>
                        <a href="https://kemdiktisaintek.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Kemendiktisaintek
                        </a>
                    </li>
                    <li>
                        <a href="https://kemendikdasmen.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Kemendikdasmen
                        </a>
                    </li>
                    <li>
                        <a href="https://sapto.banpt.or.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Sistem Akreditasi Perguruan Tinggi Online
                        </a>
                    </li>
                    <li>
                        <a href="https://sinta.kemdiktisaintek.go.id/" class="hover:underline" target="_blank" rel="noopener noreferrer">
                            Sinta (Science and Technology Index)
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="lg:hidden mt-8 pt-8 justify-items-center text-sm text-white grid grid-cols-2 gap-4 md:flex md:items-center md:justify-between">
            <img src="/images/assets/ramah-ori-bordered.webp" alt="Kemendikdasmen Ramah" width="120" height="40">
            <img src="/images/assets/pendidikan-ori-bordered.webp" alt="Pendidikan Bermutu Untuk Semua" width="120" height="40">
        </div>

        <div class="mt-8 pt-8 text-start text-sm text-white flex items-end justify-between">
            <div>
                <p>&copy; {{ date('Y') }} BGTK Provinsi NTT</p>
            </div>
            <div class="ml-4 justify-center items-center flex gap-4">
                <a href="https://www.facebook.com/balaigurupenggerakntt/" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-facebook text-white text-xl inline-block hover:opacity-80"></i>
                </a>
                <a href="https://x.com/BGTK_NTT" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-x-twitter text-white text-xl inline-block hover:opacity-80"></i>
                </a>
                <a href="https://www.instagram.com/bgtkntt/" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-instagram text-white text-xl inline-block hover:opacity-80"></i>
                </a>
                <a href="https://www.tiktok.com/@bgtkntt" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-tiktok text-white text-xl inline-block hover:opacity-80"></i>
                </a>
                <a href="https://www.youtube.com/@bgtkntt/" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-youtube text-white text-2xl inline-block hover:opacity-80"></i>
                </a>
            </div>
        </div>

    </div>
</footer>


