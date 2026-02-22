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
                Letak Geografis
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Kondisi Geografis Kecamatan Tahunan</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($profil)
                <div class="glass-card rounded-2xl p-6 md:p-10" data-aos="fade-up">
                    @if($profil->image)
                        <div class="mb-8 rounded-xl overflow-hidden">
                            <img src="{{ $profil->image_url }}" alt="{{ $profil->title }}" class="w-full rounded-xl">
                        </div>
                    @endif
                    <h2 class="text-3xl font-display font-bold text-white mb-6">{{ $profil->title }}</h2>
                    <div
                        class="prose prose-lg prose-invert max-w-none prose-p:text-white/70 prose-headings:text-white prose-headings:font-display">
                        {!! nl2br(e($profil->content)) !!}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-map-marked-alt text-5xl text-white/10 mb-4"></i>
                    <p class="text-white/40 text-lg">Konten belum tersedia</p>
                </div>
            @endif
        </div>
    </section>
@endsection