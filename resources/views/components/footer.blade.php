<footer class="relative noise">
    <!-- Gradient top edge -->
    <div class="h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>

    <div class="bg-[#080d08] relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- Tentang Kami -->
                <div>
                    <div class="flex items-center space-x-3 mb-5">
                        <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo"
                            class="w-10 h-10 object-contain">
                        <div>
                            <h3 class="text-white font-bold">Kecamatan Tahunan</h3>
                            <p class="text-gold/60 text-[10px] uppercase tracking-widest">Kabupaten Jepara</p>
                        </div>
                    </div>
                    <p class="text-white/40 text-sm leading-relaxed">
                        Kecamatan Tahunan adalah salah satu kecamatan di Kabupaten Jepara, Jawa Tengah yang berkomitmen
                        memberikan pelayanan terbaik kepada masyarakat.
                    </p>
                    <div class="flex space-x-2.5 mt-5">
                        <a href="{{ \App\Models\Setting::get('sosmed_facebook') ?? '#' }}"
                            class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/60 hover:bg-gold/10 hover:text-gold hover:border-gold/30 transition"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ \App\Models\Setting::get('sosmed_twitter') ?? '#' }}"
                            class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/60 hover:bg-gold/10 hover:text-gold hover:border-gold/30 transition"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ \App\Models\Setting::get('sosmed_instagram') ?? '#' }}"
                            class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/60 hover:bg-gold/10 hover:text-gold hover:border-gold/30 transition"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ \App\Models\Setting::get('sosmed_youtube') ?? '#' }}"
                            class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-white/60 hover:bg-gold/10 hover:text-gold hover:border-gold/30 transition"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Link Cepat -->
                <div>
                    <h3 class="text-white font-bold mb-5 flex items-center">
                        <div class="section-line mr-3" style="width:30px"></div>Link Cepat
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Beranda</a></li>
                        <li><a href="{{ route('profil.sejarah') }}"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Profil</a></li>
                        <li><a href="{{ route('potensi.index') }}"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Potensi</a></li>
                        <li><a href="{{ route('berita.index') }}"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Berita</a></li>
                        <li><a href="#"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Statistik</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="text-white font-bold mb-5 flex items-center">
                        <div class="section-line mr-3" style="width:30px"></div>Layanan
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Administrasi
                                Kependudukan</a></li>
                        <li><a href="#"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Perizinan</a></li>
                        <li><a href="#"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Pengaduan
                                Masyarakat</a></li>
                        <li><a href="#"
                                class="text-white/40 hover:text-gold-light transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-[8px] mr-2 text-gold/40"></i>Informasi Publik</a>
                        </li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-white font-bold mb-5 flex items-center">
                        <div class="section-line mr-3" style="width:30px"></div>Kontak
                    </h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt text-gold/60 text-xs"></i>
                            </div>
                            <span class="text-white/40">Jl. Raya Tahunan No. 1, Jepara, Jawa Tengah</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-gold/60 text-xs"></i>
                            </div>
                            <span class="text-white/40">(0291) 123456</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-gold/60 text-xs"></i>
                            </div>
                            <span class="text-white/40">kecamatan@tahunan.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                <p class="text-center text-xs text-white/25">
                    &copy; {{ date('Y') }} Kecamatan Tahunan — Kabupaten Jepara, Jawa Tengah. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>