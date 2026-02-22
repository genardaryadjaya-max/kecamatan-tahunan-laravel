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
                Potensi Daerah
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Kekayaan dan Potensi Kecamatan Tahunan
            </p>
        </div>
    </section>

    <!-- Filter -->
    <section class="py-6 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('potensi.index') }}"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all {{ !request('category') ? 'bg-gradient-to-r from-gold to-gold-dark text-forest' : 'glass text-white/60 hover:text-gold-light hover:bg-white/10' }}">
                    Semua
                </a>
                @php
                    $categoryLabels = [
                        'pertanian' => 'Pertanian',
                        'industri' => 'Industri & Kerajinan',
                        'wisata' => 'Wisata',
                        'peternakan' => 'Peternakan',
                        'ekonomi' => 'Ekonomi',
                        'seni budaya' => 'Seni Budaya',
                        'seni_budaya' => 'Seni Budaya',
                        'kuliner' => 'Kuliner',
                    ];
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('potensi.index', ['category' => $cat]) }}"
                        class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all {{ request('category') == $cat ? 'bg-gradient-to-r from-gold to-gold-dark text-forest' : 'glass text-white/60 hover:text-gold-light hover:bg-white/10' }}">
                        {{ $categoryLabels[$cat] ?? ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Grid -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($potensis->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($potensis as $potensi)
                        <a href="{{ route('potensi.show', $potensi->slug) }}" class="glass-card rounded-xl overflow-hidden group"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="relative overflow-hidden h-48">
                                <img src="{{ $potensi->image_url }}" alt="{{ $potensi->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    @php
                                        $categoryLabels = [
                                            'pertanian' => 'Pertanian',
                                            'industri' => 'Industri & Kerajinan',
                                            'wisata' => 'Wisata',
                                            'peternakan' => 'Peternakan',
                                            'ekonomi' => 'Ekonomi',
                                            'seni budaya' => 'Seni Budaya',
                                            'seni_budaya' => 'Seni Budaya',
                                            'kuliner' => 'Kuliner',
                                        ];
                                    @endphp
                                    <span class="bg-gold/90 text-forest text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $categoryLabels[$potensi->category] ?? ucfirst($potensi->category) }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white/90 mb-2 group-hover:text-gold-light transition">
                                    {{ $potensi->name }}</h3>
                                <p class="text-white/40 text-sm mb-4 line-clamp-3">{{ Str::limit($potensi->description, 100) }}</p>
                                <span class="text-gold/70 font-semibold text-sm">Selengkapnya →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-10">{{ $potensis->links() }}</div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-5xl text-white/10 mb-4"></i>
                    <p class="text-white/40 text-lg">Belum ada data potensi</p>
                </div>
            @endif
        </div>
    </section>
@endsection