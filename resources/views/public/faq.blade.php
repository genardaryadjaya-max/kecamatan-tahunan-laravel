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
                Pertanyaan Umum
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Frequently Asked Questions (FAQ)</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(isset($faqs) && $faqs->count() > 0)
                <div class="space-y-10">
                    @foreach($faqs as $category => $items)
                        <div data-aos="fade-up">
                            <!-- Category Header -->
                            <div class="flex items-center mb-6">
                                <div class="section-line"></div>
                                <h2 class="text-2xl md:text-3xl font-display font-bold text-white ml-4 capitalize">
                                    {{ str_replace('_', ' ', $category) }}
                                </h2>
                            </div>

                            <!-- FAQ Accordion -->
                            <div class="space-y-3" x-data="{ activeId: null }">
                                @foreach($items as $index => $faq)
                                    @php $uniqueId = $category . '_' . $faq->id; @endphp
                                    <div
                                        class="glass-card rounded-xl overflow-hidden border border-white/5 hover:border-gold/30 transition-colors">
                                        <!-- Question Button -->
                                        <button @click="activeId === '{{ $uniqueId }}' ? activeId = null : activeId = '{{ $uniqueId }}'"
                                            class="w-full flex items-start gap-4 p-5 text-left hover:bg-white/5 transition-colors group">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-gold/20 to-forest-accent/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                <i class="fas fa-question text-gold"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-white font-semibold group-hover:text-gold transition-colors pr-8">
                                                    {{ $faq->question }}
                                                </h3>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-chevron-down text-gold/60 transition-transform duration-300"
                                                    :class="activeId === '{{ $uniqueId }}' ? 'rotate-180' : ''"></i>
                                            </div>
                                        </button>

                                        <!-- Answer Panel -->
                                        <div x-show="activeId === '{{ $uniqueId }}'"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 -translate-y-4"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 -translate-y-4" class="border-t border-white/5 bg-white/5"
                                            style="display: none;">
                                            <div class="p-5 pl-[72px]">
                                                <div class="prose prose-sm prose-invert max-w-none">
                                                    <p class="text-white/70 leading-relaxed whitespace-pre-line">{{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Search Hint -->
                <div class="mt-12 glass-card rounded-xl p-6 text-center" data-aos="fade-up">
                    <i class="fas fa-lightbulb text-3xl text-gold/50 mb-3"></i>
                    <h3 class="text-white font-semibold mb-2">Tidak Menemukan Jawaban?</h3>
                    <p class="text-white/60 text-sm mb-4">Gunakan <kbd
                            class="px-2 py-1 bg-white/10 rounded text-gold font-mono text-xs">Ctrl+F</kbd> untuk mencari kata
                        kunci di halaman ini</p>
                    <a href="{{ route('kontak') }}"
                        class="inline-flex items-center text-gold hover:text-white transition-colors text-sm font-medium">
                        Atau hubungi kami langsung <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="glass-card rounded-2xl p-12 inline-block" data-aos="zoom-in">
                        <i class="fas fa-question-circle text-6xl text-white/10 mb-4"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">FAQ Belum Tersedia</h3>
                        <p class="text-white/40 max-w-md mx-auto">
                            Daftar pertanyaan umum sedang dalam penyusunan. Silakan hubungi kami untuk informasi lebih lanjut.
                        </p>
                        <a href="{{ route('kontak') }}"
                            class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl hover:shadow-lg hover:shadow-gold/30 transition-all">
                            <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="parallax-section py-16" data-aos="fade-up">
        <div class="parallax-bg" data-speed="0.15"
            style="background-image: url('{{ asset('images/29251003_city-walk.webp') }}');"></div>
        <div class="parallax-overlay bg-gradient-to-r from-forest/90 to-black/80"></div>
        <div class="parallax-content max-w-5xl mx-auto px-6">
            <div class="text-center mb-8">
                <div class="section-line mx-auto mb-4"></div>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white text-glow">
                    Link Berguna Lainnya
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('unduhan') }}"
                    class="glass-card rounded-xl p-6 text-center hover:border-gold/30 transition-all group">
                    <i class="fas fa-download text-3xl text-gold/60 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-white font-semibold mb-1 group-hover:text-gold transition-colors">Unduhan</h3>
                    <p class="text-sm text-white/40">Formulir & dokumen</p>
                </a>
                <a href="{{ route('kontak') }}"
                    class="glass-card rounded-xl p-6 text-center hover:border-gold/30 transition-all group">
                    <i
                        class="fas fa-phone-alt text-3xl text-green-400/60 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-white font-semibold mb-1 group-hover:text-green-400 transition-colors">Kontak</h3>
                    <p class="text-sm text-white/40">Hubungi kami</p>
                </a>
                <a href="{{ route('statistik') }}"
                    class="glass-card rounded-xl p-6 text-center hover:border-gold/30 transition-all group">
                    <i
                        class="fas fa-chart-bar text-3xl text-blue-400/60 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-white font-semibold mb-1 group-hover:text-blue-400 transition-colors">Statistik</h3>
                    <p class="text-sm text-white/40">Data kecamatan</p>
                </a>
            </div>
        </div>
    </section>

@endsection