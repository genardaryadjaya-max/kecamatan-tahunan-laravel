@extends('layouts.app')

@section('content')

    <!-- Page Header -->
    <section class="parallax-section h-[50vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');">
        </div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white text-glow mb-3" data-aos="fade-up">
                Hubungi Kami
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Kecamatan Tahunan siap melayani Anda
            </p>
        </div>
    </section>

    <!-- Contact -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Info -->
                <div class="glass-card rounded-2xl p-6 md:p-8" data-aos="fade-right">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="section-line"></div>
                        <h2 class="text-2xl font-display font-bold text-white">Informasi Kontak</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-12 h-12 glass-light rounded-xl flex items-center justify-center group-hover:border-gold/30 transition">
                                <i class="fas fa-map-marker-alt text-gold/80"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-white/90 mb-1">Alamat</h3>
                                <p class="text-white/50 text-sm">
                                    {{ $settings['alamat']->value ?? 'Jl. Raya Tahunan No. 123, Jepara, Jawa Tengah' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-12 h-12 glass-light rounded-xl flex items-center justify-center group-hover:border-gold/30 transition">
                                <i class="fas fa-phone text-gold/80"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-white/90 mb-1">Telepon</h3>
                                <p class="text-white/50 text-sm">{{ $settings['telepon']->value ?? '(0291) 123456' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-12 h-12 glass-light rounded-xl flex items-center justify-center group-hover:border-gold/30 transition">
                                <i class="fas fa-envelope text-gold/80"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-white/90 mb-1">Email</h3>
                                <p class="text-white/50 text-sm">{{ $settings['email']->value ?? 'info@kecamatantahunan.id'
                                    }}</p>
                            </div>
                        </div>
                        <div class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-12 h-12 glass-light rounded-xl flex items-center justify-center group-hover:border-gold/30 transition">
                                <i class="fas fa-clock text-gold/80"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-white/90 mb-1">Jam Pelayanan</h3>
                                <p class="text-white/50 text-sm">Senin - Jumat: 08:00 - 16:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div class="mt-8 pt-6 border-t border-white/5">
                        <h3 class="font-semibold text-white/80 mb-4 text-sm uppercase tracking-wide">Media Sosial</h3>
                        <div class="flex gap-3">
                            <a href="#"
                                class="w-10 h-10 bg-[#1877f2] rounded-lg text-white flex items-center justify-center hover:shadow-lg hover:shadow-blue-500/30 transition-all hover:-translate-y-1"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#"
                                class="w-10 h-10 bg-[#1da1f2] rounded-lg text-white flex items-center justify-center hover:shadow-lg hover:shadow-sky-400/30 transition-all hover:-translate-y-1"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#"
                                class="w-10 h-10 bg-gradient-to-br from-[#f09433] to-[#bc1888] rounded-lg text-white flex items-center justify-center hover:shadow-lg hover:shadow-pink-500/30 transition-all hover:-translate-y-1"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#"
                                class="w-10 h-10 bg-[#25d366] rounded-lg text-white flex items-center justify-center hover:shadow-lg hover:shadow-green-500/30 transition-all hover:-translate-y-1"><i
                                    class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="glass-card rounded-2xl p-2" data-aos="fade-left">
                    <div id="contact-map" style="height: 500px;" class="rounded-xl"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('contact-map')) {
                const map = L.map('contact-map', { scrollWheelZoom: false }).setView([-6.5892, 110.6684], 15);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OSM &copy; CARTO', maxZoom: 19
                }).addTo(map);
                L.marker([-6.5892, 110.6684]).addTo(map)
                    .bindPopup('<b style="color:#333">Kantor Kecamatan Tahunan</b><br><span style="color:#666">Jepara, Jawa Tengah</span>').openPopup();
            }
        });
    </script>
@endpush