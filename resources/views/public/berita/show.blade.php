@extends('layouts.app')

@section('content')

    <article class="pt-16">
        {{-- Breadcrumb bar --}}
        <div id="berita-breadcrumb-bar" class="py-3 border-b">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav id="berita-breadcrumb-nav" class="text-sm">
                    <a href="{{ route('home') }}" class="hover:text-gold-light transition">Beranda</a>
                    <span class="mx-2 opacity-30">/</span>
                    <a href="{{ route('berita.index') }}" class="hover:text-gold-light transition">Berita</a>
                    <span class="mx-2 opacity-30">/</span>
                    <span class="opacity-50">{{ Str::limit($berita->title, 50) }}</span>
                </nav>
            </div>
        </div>
        <style>
            [data-theme="dark"] #berita-breadcrumb-bar  { background-color: #151f15; border-color: rgba(255,255,255,0.06); }
            [data-theme="dark"] #berita-breadcrumb-nav  { color: rgba(255,255,255,0.55); }
            [data-theme="light"] #berita-breadcrumb-bar { background-color: #eef2ed; border-color: rgba(0,0,0,0.07); }
            [data-theme="light"] #berita-breadcrumb-nav { color: rgba(30,50,30,0.65); }
        </style>

        {{-- Main Content --}}
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
            <div class="glass-card rounded-2xl overflow-hidden">

                {{-- Full Image (natural size, no cropping) --}}
                @if($berita->image)
                    <div class="w-full bg-black/30">
                        <img src="{{ $berita->image_url }}" alt="{{ $berita->title }}"
                            class="w-full h-auto object-contain max-h-[600px]">
                    </div>
                @endif

                {{-- Article Body --}}
                <div class="p-6 md:p-10">
                    @if($berita->category)
                        <div class="mb-4">
                            <span class="bg-gradient-to-r from-gold to-gold-dark text-forest text-sm font-bold px-4 py-1.5 rounded-full">
                                {{ $berita->category }}
                            </span>
                        </div>
                    @endif

                    <h1 class="text-3xl md:text-4xl font-display font-extrabold text-white mb-5">
                        {{ $berita->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-white/40 mb-6 pb-6 border-b border-white/10">
                        <div class="flex items-center"><i class="far fa-calendar mr-1.5 text-gold/60"></i>{{ $berita->published_at ? $berita->published_at->format('d F Y') : '-' }}</div>
                        <div class="flex items-center"><i class="far fa-user mr-1.5 text-gold/60"></i>{{ $berita->creator->name ?? 'Admin' }}</div>
                        <div class="flex items-center"><i class="far fa-eye mr-1.5 text-gold/60"></i>{{ $berita->views ?? 0 }} views</div>
                    </div>

                    <div class="prose prose-lg prose-invert max-w-none prose-headings:text-white prose-headings:font-display prose-a:text-gold-light prose-strong:text-white/90 prose-p:text-white/70 prose-li:text-white/70">
                        {!! $berita->content !!}
                    </div>

                    {{-- Source URL Button --}}
                    @php
                        $sourceUrl = null;
                        if (preg_match('/Sumber:\s*<a href="([^"]+)"/i', $berita->content, $urlMatches)) {
                            $sourceUrl = $urlMatches[1];
                        } elseif (preg_match('/href="(https?:\/\/[^"]+)"/i', $berita->content, $urlMatches)) {
                            $sourceUrl = $urlMatches[1];
                        }
                    @endphp
                    @if($sourceUrl)
                        <div class="mt-8 pt-6 border-t border-white/10">
                            <a href="{{ $sourceUrl }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gold/10 hover:bg-gold border border-gold/30 hover:border-gold text-gold hover:text-forest font-bold rounded-xl transition-all duration-300">
                                <i class="fas fa-external-link-alt"></i>
                                Baca Artikel Asli
                            </a>
                        </div>
                    @endif

                    {{-- Share --}}
                    <div class="mt-8 pt-6 border-t border-white/10">
                        <h4 class="text-sm font-bold text-white/80 mb-3 uppercase tracking-wide">Bagikan:</h4>
                        <div class="flex gap-2.5">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('berita.show', $berita->slug) }}" target="_blank"
                                class="w-10 h-10 bg-[#1877f2] rounded-lg flex items-center justify-center text-white hover:opacity-80 transition"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ route('berita.show', $berita->slug) }}&text={{ $berita->title }}" target="_blank"
                                class="w-10 h-10 bg-[#1da1f2] rounded-lg flex items-center justify-center text-white hover:opacity-80 transition"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ $berita->title }} {{ route('berita.show', $berita->slug) }}" target="_blank"
                                class="w-10 h-10 bg-[#25d366] rounded-lg flex items-center justify-center text-white hover:opacity-80 transition"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>


    <!-- Related -->
    @if($related->count() > 0)
        <section class="py-12 border-t border-white/5">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="section-line"></div>
                    <h2 class="text-2xl font-display font-bold text-white">Berita Terkait</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($related as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="glass-card rounded-xl overflow-hidden group">
                            <div class="relative overflow-hidden h-44">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-4">
                                <h3
                                    class="text-base font-bold text-white/90 mb-1.5 line-clamp-2 group-hover:text-gold-light transition">
                                    {{ $item->title }}</h3>
                                <p class="text-white/40 text-sm line-clamp-2 mb-2">{{ $item->excerpt_text }}</p>
                                <span class="text-gold/70 font-semibold text-sm">Baca Selengkapnya →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection