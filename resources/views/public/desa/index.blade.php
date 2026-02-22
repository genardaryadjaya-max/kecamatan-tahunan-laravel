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
                Website Desa
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Kunjungi website desa-desa di wilayah
                Kecamatan Tahunan</p>
        </div>
    </section>

    <!-- Desa Grid -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($desas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($desas as $desa)
                        <div class="glass-card rounded-xl overflow-hidden group" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 80 }}">
                            <div class="p-6 flex items-center justify-center bg-white/[0.02]">
                                <img src="{{ $desa->logo_url }}" alt="{{ $desa->name }}"
                                    class="h-28 w-28 object-contain group-hover:scale-110 transition duration-500" loading="lazy">
                            </div>
                            <div class="p-5 border-t border-white/5">
                                <h3 class="text-xl font-bold text-white/90 mb-2 group-hover:text-gold-light transition">
                                    {{ $desa->name }}</h3>
                                <p class="text-white/40 text-sm mb-4 line-clamp-3">{{ $desa->description }}</p>

                                @if($desa->contact)
                                    <div class="space-y-1.5 mb-4 text-sm text-white/30">
                                        @if(isset($desa->contact['phone']))
                                            <div class="flex items-center"><i class="fas fa-phone w-4 text-gold/40 text-xs"></i><span
                                                    class="ml-2">{{ $desa->contact['phone'] }}</span></div>
                                        @endif
                                        @if(isset($desa->contact['email']))
                                            <div class="flex items-center"><i class="fas fa-envelope w-4 text-gold/40 text-xs"></i><span
                                                    class="ml-2">{{ $desa->contact['email'] }}</span></div>
                                        @endif
                                    </div>
                                @endif

                                <a href="{{ $desa->website_url }}" target="_blank"
                                    class="block w-full text-center bg-gradient-to-r from-gold to-gold-dark text-forest font-bold py-2.5 rounded-lg hover:shadow-lg hover:shadow-gold/20 transition">
                                    <i class="fas fa-external-link-alt mr-1.5"></i> Kunjungi Website
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-home text-5xl text-white/10 mb-4"></i>
                    <h3 class="text-xl font-bold text-white/50 mb-2">Tidak Ada Data Desa</h3>
                    <p class="text-white/30">Belum ada data website desa.</p>
                </div>
            @endif
        </div>
    </section>

@endsection