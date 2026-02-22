@extends('layouts.app')

@section('content')

    <!-- Page Header with Parallax -->
    <section class="parallax-section h-[50vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');">
        </div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white text-glow mb-3" data-aos="fade-up">
                Berita & Pengumuman
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Informasi terkini dari Kecamatan
                Tahunan</p>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="py-6 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('berita.index') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                            class="w-full px-4 py-2.5 pl-10 rounded-lg glass text-white text-sm placeholder-white/30 focus:ring-2 focus:ring-gold/50 focus:outline-none border-0">
                        <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-white/30 text-sm"></i>
                    </div>
                </div>
                <div class="md:w-52">
                    <select name="category"
                        class="w-full px-4 py-2.5 rounded-lg glass text-white text-sm focus:ring-2 focus:ring-gold/50 focus:outline-none border-0 appearance-none"
                        onchange="this.form.submit()">
                        <option value="" class="bg-forest">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}
                                class="bg-forest">
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="px-5 py-2.5 bg-gradient-to-r from-gold to-gold-dark text-forest rounded-lg text-sm font-bold hover:shadow-lg hover:shadow-gold/20 transition">
                    <i class="fas fa-filter mr-1.5"></i> Filter
                </button>
            </form>
        </div>
    </section>

    <!-- Berita Grid -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($beritas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($beritas as $berita)
                        <a href="{{ route('berita.show', $berita->slug) }}" class="glass-card rounded-xl overflow-hidden group"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="relative overflow-hidden h-52">
                                <img src="{{ $berita->image_url }}" alt="{{ $berita->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                @if($berita->category)
                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="bg-gold/90 text-forest text-xs font-bold px-3 py-1 rounded-full">{{ $berita->category }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="flex items-center text-xs text-white/40 mb-2">
                                    <i class="far fa-calendar mr-1.5"></i>
                                    {{ $berita->published_at ? $berita->published_at->format('d M Y') : '-' }}
                                    <span class="mx-2">•</span>
                                    <i class="far fa-eye mr-1.5"></i>
                                    {{ $berita->views ?? 0 }} views
                                </div>
                                <h3
                                    class="text-lg font-bold text-white/90 mb-2 line-clamp-2 group-hover:text-gold-light transition">
                                    {{ $berita->title }}
                                </h3>
                                <p class="text-white/40 text-sm line-clamp-3 mb-3">{{ $berita->excerpt_text }}</p>
                                <span class="text-gold/80 font-semibold text-sm inline-flex items-center">
                                    Baca Selengkapnya <i
                                        class="fas fa-arrow-right ml-1.5 text-xs group-hover:translate-x-1 transition"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-10">{{ $beritas->links() }}</div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-newspaper text-5xl text-white/10 mb-4"></i>
                    <h3 class="text-xl font-bold text-white/50 mb-2">Tidak Ada Berita</h3>
                    <p class="text-white/30">Belum ada berita yang dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>

@endsection