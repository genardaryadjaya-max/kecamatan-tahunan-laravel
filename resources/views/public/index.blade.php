@extends('layouts.app')

@section('content')

<!-- ====== SIREMA MODAL STATE WRAPPER ====== -->
<div x-data="{ siremaModal: false }">

    <!-- ██████████████████████████████████████████████████ -->
    <!-- ▌ HERO: Full Screen Video with Parallax          ▌ -->
    <!-- ██████████████████████████████████████████████████ -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Video Background with Parallax -->
        <div class="parallax-bg" data-speed="0.15">
            @php
                $slider = $sliders->first();
                $hasDbVideo = $slider && $slider->type === 'video' && $slider->video;
                $hasDbImage = $slider && $slider->type === 'image' && $slider->image;
            @endphp
            @if($hasDbVideo)
                <video autoplay muted loop playsinline class="w-full h-full object-cover scale-110">
                    <source src="{{ $slider->video_url }}" type="video/mp4">
                </video>
            @elseif($hasDbImage)
                <img src="{{ $slider->image_url }}" alt="Hero" class="w-full h-full object-cover scale-110">
            @else
                <video autoplay muted loop playsinline class="w-full h-full object-cover scale-110">
                    <source src="{{ asset('uploads/video/banner.mp4') }}" type="video/mp4">
                </video>
            @endif
        </div>

        
        <div class="parallax-overlay" style="background: linear-gradient(to bottom, rgba(10,30,12,0.82) 0%, rgba(0,0,0,0.45) 50%, rgba(10,30,12,0.88) 100%);"></div>
        <div class="parallax-overlay"
            style="background: radial-gradient(ellipse at center, transparent 30%, rgba(10,15,10,0.75) 100%);"></div>

        <!-- Hero Content -->
        <div class="parallax-content text-center max-w-5xl mx-auto px-6">
            <div class="mb-6" data-aos="fade-down" data-aos-duration="1200">
                <div class="section-line mx-auto mb-4"></div>
                <p class="text-gold/80 text-sm uppercase tracking-[0.3em] font-medium">Website Resmi</p>
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-display font-extrabold text-white mb-4 leading-[1.1] text-glow"
                data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"
                style="text-shadow: 0 4px 30px rgba(0,0,0,0.5);">
                Selamat Datang di<br>
                <span class="gradient-text">Kecamatan Tahunan</span>
            </h1>

            <p class="text-lg md:text-2xl text-white/90 font-medium max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="400"
                style="text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                Gerbang Pelayanan dan Potensi Jepara
            </p>
            
            <div class="flex flex-wrap justify-center gap-3 sm:gap-5 mt-8" data-aos="fade-up" data-aos-delay="600">
                <a href="#desa"
                    class="px-6 py-3 bg-gradient-to-r from-gold to-gold-dark text-forest-dark font-bold rounded-lg shadow-[0_0_15px_rgba(212,175,55,0.4)] hover:shadow-[0_0_25px_rgba(212,175,55,0.6)] transition-all duration-300 hover:-translate-y-1 flex items-center justify-center min-w-[160px]">
                    <i class="fas fa-home mr-2"></i> Website Desa
                </a>
                <a href="#potensi"
                    class="px-6 py-3 border border-gold/50 bg-forest-dark/80 text-gold-light font-bold rounded-lg hover:bg-forest transition-all duration-300 hover:-translate-y-1 flex items-center justify-center min-w-[160px] backdrop-blur-sm">
                    <i class="fas fa-leaf mr-2"></i> Potensi
                </a>
                <a href="#berita"
                    class="px-6 py-3 border border-gold/50 bg-forest-dark/80 text-gold-light font-bold rounded-lg hover:bg-forest transition-all duration-300 hover:-translate-y-1 flex items-center justify-center min-w-[160px] backdrop-blur-sm">
                    <i class="fas fa-newspaper mr-2"></i> Berita & Pengumuman
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-center animate-bounce">
            <a href="#content-start" class="text-white/50 hover:text-gold transition">
                <p class="text-xs uppercase tracking-widest mb-2">Scroll</p>
                <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>


    <!-- ██████████████████████████████████████████████████ -->
    <!-- ▌ MAIN CONTENT: Two Column + Sidebar             ▌ -->
    <!-- ██████████████████████████████████████████████████ -->
    <div id="content-start" class="relative" style="background: var(--bg-primary);">

        <!-- Divider -->
        <div class="w-full h-1 bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 relative">

                <!-- Decorative Jepara Carvings (Scattered globally in container) -->
                
                <!-- Top Left (behind Website Desa) -->
                <div class="sidebar-ornament variant-3" style="top: 50px; left: -180px; width: 250px; height: 250px; transform: rotate(-15deg);"></div>
                
                <!-- Mid Right (between Sirema & Agenda) -->
                <div class="sidebar-ornament variant-1" style="top: 300px; right: -250px; width: 350px; height: 350px; transform: rotate(10deg);"></div>
                
                <!-- Mid Left (beside Berita) -->
                <div class="sidebar-ornament variant-2" style="top: 750px; left: -220px; width: 300px; height: 300px; transform: rotate(45deg);"></div>
                
                <!-- Bottom Right (by Tautan Sosial) -->
                <div class="sidebar-ornament variant-3" style="top: 850px; right: -150px; width: 180px; height: 180px; transform: rotate(-30deg);"></div>
                
                <!-- Bottom Left (behind Maps / Visi Misi) -->
                <div class="sidebar-ornament variant-1" style="top: 1400px; left: -200px; width: 320px; height: 320px; transform: rotate(80deg);"></div>
                
                <!-- Deep Bottom Right (filling void) -->
                <div class="sidebar-ornament variant-2" style="top: 1350px; right: -120px; width: 220px; height: 220px; transform: rotate(-15deg);"></div>


                <!-- ====== LEFT COLUMN (Main Content) ====== -->
                <div class="lg:col-span-8 space-y-12">

                    <!-- ═══════════════════════════════════════ -->
                    <!-- WEBSITE DESA                           -->
                    <!-- ═══════════════════════════════════════ -->
                    <section id="desa" data-aos="fade-up" x-data="{
                        scrollAmount() {
                            const firstItem = this.$refs.desaContainer.firstElementChild;
                            return firstItem ? firstItem.offsetWidth + 16 : 300; // 16px is gap-4
                        },
                        scrollLeft() {
                            this.$refs.desaContainer.scrollBy({ left: -this.scrollAmount(), behavior: 'smooth' });
                        },
                        scrollRight() {
                            this.$refs.desaContainer.scrollBy({ left: this.scrollAmount(), behavior: 'smooth' });
                        }
                    }">
                        <div class="flex items-center justify-between border-b-[1px] border-gold/40 pb-2 mb-6">
                            <h2 class="text-xl md:text-2xl font-bold text-white">Website Desa di Kecamatan Tahunan</h2>
                            
                            <!-- Scroll Buttons -->
                            <div class="flex space-x-2">
                                <button @click="scrollLeft()" class="w-8 h-8 rounded-full bg-white/5 hover:bg-gold/20 flex items-center justify-center text-white/70 hover:text-gold transition-colors border border-white/10 hover:border-gold/30">
                                    <i class="fas fa-chevron-left text-sm"></i>
                                </button>
                                <button @click="scrollRight()" class="w-8 h-8 rounded-full bg-white/5 hover:bg-gold/20 flex items-center justify-center text-white/70 hover:text-gold transition-colors border border-white/10 hover:border-gold/30">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </button>
                            </div>
                        </div>

                        @if($desas->count() > 0)
                            <!-- Smooth scrolling container, hide-scrollbar -->
                            <div x-ref="desaContainer" class="flex overflow-x-auto gap-4 pb-4 snap-x snap-mandatory hide-scrollbar style-smooth-scroll" style="scroll-behavior: smooth;">
                                @foreach($desas as $desa)
                                    <a href="{{ $desa->website_url ?? '#' }}" target="_blank" 
                                       class="w-[calc(50%-8px)] sm:w-[calc(33.333%-10.66px)] lg:w-[calc(25%-12px)] flex-none snap-start glass-card rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                        <div class="w-16 h-16 mb-3 flex items-center justify-center">
                                            <img src="{{ $desa->logo_url }}" alt="{{ $desa->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                                        </div>
                                        <h3 class="font-semibold text-sm text-white leading-snug">{{ $desa->name }}</h3>
                                    </a>
                                @endforeach
                            </div>

                        @else
                            <div class="text-center py-6 glass-card rounded-xl">
                                <i class="fas fa-home text-3xl text-white/20 mb-2"></i>
                                <p class="text-white/40 text-sm">Belum ada data website desa</p>
                            </div>
                        @endif
                    </section>


                    <!-- ═══════════════════════════════════════ -->
                    <!-- POTENSI UNGGULAN                       -->
                    <!-- ═══════════════════════════════════════ -->
                    <section id="potensi" data-aos="fade-up" class="mb-12">
                        <div class="border-b-[1px] border-gold/40 pb-2 mb-6">
                            <h2 class="text-xl md:text-2xl font-bold text-white">Potensi Unggulan</h2>
                        </div>

                        @if(isset($potensis) && $potensis->count() > 0)
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($potensis->take(2) as $potensi)
                                    <div class="relative rounded-2xl overflow-hidden group h-56 border border-gold/20 shadow-lg">
                                        <img src="{{ $potensi->image_url }}" alt="{{ $potensi->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f1710] via-black/40 to-transparent"></div>
                                        
                                        <div class="absolute inset-0 p-5 flex flex-col justify-end">
                                            <h3 class="text-base font-bold mb-3 leading-tight drop-shadow-lg" style="color: #ffffff !important; text-shadow: 0 2px 8px rgba(0,0,0,0.8);">
                                                {{ $potensi->name }}
                                            </h3>
                                            <div>
                                                <a href="{{ route('potensi.show', $potensi->slug) }}" class="inline-block px-4 py-1.5 border border-gold/50 text-gold text-xs rounded-full hover:bg-gold hover:text-forest-dark transition font-bold backdrop-blur-md">
                                                    Selengkapnya
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 glass-card rounded-xl">
                                <i class="fas fa-leaf text-3xl text-white/20 mb-2"></i>
                                <p class="text-white/40 text-sm">Belum ada potensi daerah</p>
                            </div>
                        @endif

                        <div id="potensi-cta-banner" class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 p-5 rounded-2xl border">
                            <div>
                                <h4 id="potensi-cta-title" class="font-bold text-sm">Punya Potensi Daerah?</h4>
                                <p id="potensi-cta-desc" class="text-xs mt-1">Daftarkan usaha, kerajinan, atau wisata Anda agar lebih dikenal.</p>
                            </div>
                            <a href="{{ route('potensi.create.public') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gold/20 hover:bg-gold text-gold hover:text-forest-dark rounded-xl transition-all text-sm font-bold flex items-center justify-center whitespace-nowrap">
                                <i class="fas fa-plus-circle mr-2"></i> Daftarkan Potensi
                            </a>
                        </div>
                        <style>
                            /* Light Mode */
                            [data-theme="light"] #potensi-cta-banner { background-color: rgba(74, 103, 65, 0.05); border-color: rgba(180, 140, 60, 0.3); }
                            [data-theme="light"] #potensi-cta-title { color: #1a3a1e; }
                            [data-theme="light"] #potensi-cta-desc { color: rgba(26, 58, 30, 0.7); }
                            /* Dark Mode */
                            [data-theme="dark"] #potensi-cta-banner { background-color: #1a2a1a; border-color: rgba(180, 140, 60, 0.35); }
                            [data-theme="dark"] #potensi-cta-title { color: #e8c96a; }
                            [data-theme="dark"] #potensi-cta-desc { color: rgba(255, 255, 255, 0.8); }
                        </style>
                    </section>


                    <!-- ═══════════════════════════════════════ -->
                    <!-- BERITA TERKINI                         -->
                    <!-- ═══════════════════════════════════════ -->
                    <section id="berita" data-aos="fade-up">
                        <div class="border-b-[1px] border-gold/40 pb-2 mb-6">
                            <h2 class="text-xl md:text-2xl font-bold text-white">Berita Terkini</h2>
                        </div>

                        @if($beritas->count() > 0)
                            <div class="space-y-4">
                                @foreach($beritas->take(3) as $berita)
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="flex flex-col sm:flex-row gap-4 group pb-4 border-b border-white/5 last:border-0 hover:bg-white/5 p-2 -mx-2 rounded-lg transition">
                                        <!-- Image -->
                                        <div class="flex-shrink-0 w-full sm:w-32 h-24 overflow-hidden rounded-md border border-white/10 relative shadow-lg">
                                            <img src="{{ $berita->image_url }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition"></div>
                                        </div>
                                        <!-- Content -->
                                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                                            <h3 class="text-sm font-bold text-white/90 group-hover:text-gold transition mb-1.5 line-clamp-2">
                                                {{ $berita->title }}
                                            </h3>
                                            <p class="text-xs text-white/50 line-clamp-2 mb-2">
                                                {{ $berita->excerpt_text }}
                                            </p>
                                            <div class="text-[10px] text-white/40 font-mono flex items-center">
                                                <i class="far fa-calendar-alt text-gold/60 mr-1.5"></i>
                                                {{ $berita->published_at ? $berita->published_at->format('d M Y') : '-' }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center sm:text-left">
                                <a href="{{ route('berita.index') }}" class="text-gold text-sm font-bold hover:text-gold-light transition inline-flex items-center">
                                    Semua Berita <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 glass-card rounded-xl">
                                <i class="fas fa-newspaper text-3xl text-white/20 mb-2"></i>
                                <p class="text-white/40 text-sm">Belum ada berita</p>
                            </div>
                        @endif
                    </section>


                    <!-- ═══════════════════════════════════════ -->
                    <!-- PARALLAX BREAK IMAGE                   -->
                    <!-- ═══════════════════════════════════════ -->
                    <section class="parallax-section rounded-2xl overflow-hidden" style="height: 300px;" data-aos="zoom-in">
                        <div class="parallax-bg" data-speed="0.25"
                            style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');"></div>
                        <div class="parallax-overlay bg-gradient-to-r from-forest/80 to-black/60"></div>
                        <div class="parallax-content flex items-center justify-center h-full text-center px-6">
                            <div>
                                <p class="text-gold/80 text-xs uppercase tracking-[0.3em] mb-3">Kabupaten Jepara, Jawa
                                    Tengah</p>
                                <h3 class="text-3xl md:text-4xl font-display font-bold text-white text-glow">
                                    Maju Bersama Kecamatan Tahunan
                                </h3>
                            </div>
                        </div>
                    </section>


                    <!-- ═══════════════════════════════════════ -->
                    <!-- TENTANG KECAMATAN TAHUNAN (Map + Visi) -->
                    <!-- ═══════════════════════════════════════ -->
                    <section data-aos="fade-up" class="mb-12">
                        <div class="flex items-center space-x-4 mb-10">
                            <div class="section-line"></div>
                            <h2 class="text-3xl md:text-4xl font-display font-extrabold text-[var(--text-primary)] drop-shadow-sm">
                                Tentang Kecamatan Tahunan
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                            <!-- Map -->
                            <div class="rounded-2xl overflow-hidden glass-card border flex flex-col group relative" style="border-color: var(--border-color);" data-aos="fade-right" data-aos-delay="100">
                                <div class="px-5 py-4 flex justify-between items-center border-b border-white/5 relative z-10 bg-black/10">
                                    <h3 class="font-bold text-[var(--text-primary)] text-lg flex items-center tracking-wide">
                                        <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center mr-3 border border-gold/40 text-gold shadow-[0_0_10px_rgba(212,175,55,0.3)]">
                                            <i class="fas fa-map-marked-alt text-sm"></i>
                                        </div>
                                        Peta Wilayah
                                    </h3>
                                    <span class="text-[10px] uppercase font-bold text-gold tracking-widest border border-gold/30 bg-gold/10 px-3 py-1 rounded-full">Interaktif</span>
                                </div>
                                <div class="p-2 sm:p-3 flex-grow relative z-10 flex flex-col">
                                    <div id="kecamatan-map" class="w-full flex-grow min-h-[300px] sm:min-h-[400px] lg:min-h-[350px] rounded-xl border border-white/10 ring-1 ring-black/50 overflow-hidden relative z-0"></div>
                                </div>
                            </div>

                            <!-- Visi & Misi Tabs -->
                            <div class="glass-card rounded-2xl p-6 sm:p-8 flex flex-col data-aos="fade-left" data-aos-delay="200" style="border-color: var(--border-color);" x-data="{ activeTab: 'visi' }">
                                <div class="flex items-center space-x-3 mb-6 relative z-10 pb-4 border-b border-white/10">
                                    <div class="w-10 h-10 rounded-xl border border-gold/40 flex items-center justify-center bg-gradient-to-br from-gold/20 to-transparent text-gold shadow-[0_0_15px_rgba(212,175,55,0.3)] shrink-0">
                                        <i class="fas fa-bullseye text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl sm:text-3xl font-display font-bold text-[var(--text-primary)] tracking-wide leading-tight">Visi <span class="text-gold">&</span> Misi</h3>
                                        <p class="text-[10px] sm:text-xs text-[var(--text-muted)] uppercase tracking-widest mt-1">Arah Pembangunan Tahunan</p>
                                    </div>
                                </div>

                                <!-- Tab Controls -->
                                <div class="flex space-x-2 mb-6 border-b border-white/10 pb-2">
                                    <button @click="activeTab = 'visi'"
                                            :class="activeTab === 'visi' ? 'text-gold border-b-2 border-gold font-bold bg-gold/10' : 'text-[var(--text-muted)] hover:text-[var(--text-secondary)] hover:bg-white/5'"
                                            class="px-5 py-2 rounded-t-lg transition-all text-sm uppercase tracking-widest outline-none">
                                        <i class="fas fa-eye mr-2"></i> Visi
                                    </button>
                                    <button @click="activeTab = 'misi'"
                                            :class="activeTab === 'misi' ? 'text-gold border-b-2 border-gold font-bold bg-gold/10' : 'text-[var(--text-muted)] hover:text-[var(--text-secondary)] hover:bg-white/5'"
                                            class="px-5 py-2 rounded-t-lg transition-all text-sm uppercase tracking-widest outline-none">
                                        <i class="fas fa-tasks mr-2"></i> Misi
                                    </button>
                                </div>

                                <!-- Tab Content: Visi -->
                                <div x-show="activeTab === 'visi'" 
                                     x-transition:enter="transition ease-out duration-300 transform"
                                     x-transition:enter-start="opacity-0 translate-y-4"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="flex-1 flex flex-col justify-center pb-4">
                                    <div class="bg-black/20 p-6 rounded-xl border border-white/5 border-l-4 border-l-gold hover:bg-black/30 transition-all shadow-inner relative overflow-hidden h-full flex items-center">
                                        <i class="fas fa-quote-right absolute top-4 right-4 text-6xl text-white/5 rotate-12"></i>
                                        <p class="text-[var(--text-secondary)] text-sm sm:text-base leading-relaxed font-medium italic relative z-10">
                                            "Terwujudnya Kecamatan Tahunan Yang Maju, Sejahtera, Damai, dan Demokratis, Mandiri, Didukung oleh Sumber Daya Manusia yang Berkualitas Religius dan Berkarakter Mulia, serta Potensi Ekonomis Strategis yang Produktif, Kompetitif dan Berwawasan Lingkungan dalam Wadah NKRI"
                                        </p>
                                    </div>
                                </div>

                                <!-- Tab Content: Misi -->
                                <div x-show="activeTab === 'misi'" 
                                     x-transition:enter="transition ease-out duration-300 transform"
                                     x-transition:enter-start="opacity-0 translate-y-4"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="flex-1 overflow-y-auto pr-2 pb-4 hide-scrollbar" style="display: none; max-height: 250px;">
                                    <div class="space-y-3">
                                        <div class="flex items-start bg-black/10 p-4 rounded-xl border border-white/5 hover:border-gold/30 hover:bg-black/20 transition-all group/item shadow-sm">
                                            <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-gold/10 to-transparent text-gold border border-gold/40 rounded-lg flex items-center justify-center group-hover/item:bg-gold group-hover/item:text-forest-dark transition-all">
                                                <span class="font-bold text-sm">1</span>
                                            </span>
                                            <p class="text-[var(--text-secondary)] group-hover/item:text-[var(--text-primary)] text-sm leading-relaxed ml-4 transition-colors">Mendorong Percepatan Pembangunan di Segala Bidang Sesuai dengan Kaidah-Kaidah Pembangunan Desa dalam Wilayah Kecamatan</p>
                                        </div>
                                        <div class="flex items-start bg-black/10 p-4 rounded-xl border border-white/5 hover:border-gold/30 hover:bg-black/20 transition-all group/item shadow-sm">
                                            <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-gold/10 to-transparent text-gold border border-gold/40 rounded-lg flex items-center justify-center group-hover/item:bg-gold group-hover/item:text-forest-dark transition-all">
                                                <span class="font-bold text-sm">2</span>
                                            </span>
                                            <p class="text-[var(--text-secondary)] group-hover/item:text-[var(--text-primary)] text-sm leading-relaxed ml-4 transition-colors">Menjalankan Administrasi Publik Berdasarkan Prinsip Good Governance</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



            </div>
                <!-- END LEFT COLUMN -->


                <!-- ====== RIGHT SIDEBAR ====== -->
                <aside class="lg:col-span-4 space-y-8 relative">

                    <!-- ─── SIKEMA ─── -->
                    <div class="glass-card rounded-2xl p-6 border border-gold/20 relative overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                        <!-- BG accent -->
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-gold/10 blur-3xl rounded-full pointer-events-none"></div>

                        <div class="border-b-[1px] border-gold/40 pb-2 mb-5 shrink-0">
                            <h3 class="text-xl font-bold text-white uppercase tracking-widest">SIREMA</h3>
                            <p class="text-[10px] text-white/50">(Sistem Informasi Respons Masyarakat)</p>
                        </div>
                        
                        <p class="text-xs text-white/70 mb-5 font-mono leading-relaxed">
                            Punya keluhan, pertanyaan, atau laporan terkait fasilitas publik? Sampaikan langsung kepada kami!
                        </p>
                        
                        <button @click="siremaModal = true"
                            class="w-full bg-gradient-to-r from-gold to-gold-dark text-forest-dark font-bold text-center py-3 rounded-xl transition-all shadow-[0_0_10px_rgba(212,175,55,0.2)] hover:shadow-[0_0_20px_rgba(212,175,55,0.5)] hover:-translate-y-1 relative z-20">
                            <i class="fas fa-edit mr-2"></i> Lapor SIKEMA/SIREMA
                        </button>
                    </div>

                    <!-- ─── Layanan Publik Cepat ─── -->
                    <div class="glass-card rounded-2xl p-6 border border-gold/20" data-aos="fade-left" data-aos-delay="150">
                        <div class="border-b-[1px] border-gold/40 pb-2 mb-5">
                            <h3 class="text-lg font-bold text-white">Layanan Publik Cepat</h3>
                        </div>
                        @if($layanans->count() > 0)
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($layanans as $layanan)
                            <a href="{{ $layanan->url ?? '#' }}" class="bg-black/20 hover:bg-gold/20 border border-white/5 hover:border-gold/50 rounded-xl p-3 flex flex-col items-center justify-center text-center transition-all group">
                                <i class="{{ $layanan->icon ?? 'fas fa-link' }} text-2xl text-gold mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs text-white/80 group-hover:text-white font-medium">{{ $layanan->name }}</span>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-white/50 text-center py-4">Belum ada layanan publik.</p>
                        @endif
                    </div>

                    <!-- ─── Agenda Kegiatan ─── -->
                    <div class="glass-card rounded-2xl p-6 border border-gold/20" data-aos="fade-left" data-aos-delay="200">
                        <div class="border-b-[1px] border-gold/40 pb-2 mb-5">
                            <h3 class="text-lg font-bold text-white">Agenda Kegiatan</h3>
                        </div>
                        @if($agendas->count() > 0)
                        <div class="space-y-4">
                            @foreach($agendas as $agenda)
                            <div class="group border-l-[3px] border-gold pl-4 pb-4 border-b border-white/5 last:border-b-0 last:pb-0">
                                @if($agenda->link)
                                <a href="{{ $agenda->link }}" target="_blank" class="font-bold text-white/90 text-sm group-hover:text-gold transition mb-1 leading-snug block">
                                    {{ $agenda->title }} <i class="fas fa-external-link-alt text-[10px] ml-1 opacity-50"></i>
                                </a>
                                @else
                                <p class="font-bold text-white/90 text-sm group-hover:text-gold transition mb-1 leading-snug">
                                    {{ $agenda->title }}
                                </p>
                                @endif
                                <p class="text-[11px] text-white/40 flex items-center font-mono mt-1">
                                    {{ $agenda->date_time->format('d M Y | H:i') }} WIB
                                    @if($agenda->location)
                                    <span class="ml-2 text-gold-light truncate max-w-[120px]" title="{{ $agenda->location }}"><i class="fas fa-map-marker-alt text-[10px] mr-1"></i> {{ $agenda->location }}</span>
                                    @endif
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-white/50 text-center py-4">Tidak ada agenda terdekat.</p>
                        @endif
                    </div>

                    <!-- ─── Statistik Pengunjung & Sosial ─── -->
                    <div class="glass-card rounded-2xl p-6 border border-gold/20" data-aos="fade-left" data-aos-delay="300">
                        <div class="border-b-[1px] border-gold/40 pb-2 mb-5">
                            <h3 class="text-lg font-bold text-white">Tautan Sosial & Statistik</h3>
                        </div>
                        
                        <div class="flex justify-center space-x-4 mb-6">
                            @if($sosmed['facebook'])
                            <a href="{{ $sosmed['facebook'] }}" target="_blank" class="w-10 h-10 border border-white/20 hover:border-gold hover:text-gold text-white/70 rounded-full flex items-center justify-center transition-all bg-white/5 hover:bg-gold/10">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($sosmed['twitter'])
                            <a href="{{ $sosmed['twitter'] }}" target="_blank" class="w-10 h-10 border border-white/20 hover:border-gold hover:text-gold text-white/70 rounded-full flex items-center justify-center transition-all bg-white/5 hover:bg-gold/10">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                            @if($sosmed['instagram'])
                            <a href="{{ $sosmed['instagram'] }}" target="_blank" class="w-10 h-10 border border-white/20 hover:border-gold hover:text-gold text-white/70 rounded-full flex items-center justify-center transition-all bg-white/5 hover:bg-gold/10">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($sosmed['youtube'])
                            <a href="{{ $sosmed['youtube'] }}" target="_blank" class="w-10 h-10 border border-white/20 hover:border-gold hover:text-gold text-white/70 rounded-full flex items-center justify-center transition-all bg-white/5 hover:bg-gold/10">
                                <i class="fab fa-youtube"></i>
                            </a>
                            @endif
                            
                            @if(!array_filter($sosmed))
                            <p class="text-sm text-white/30 truncate">Tautan sosial belum diatur</p>
                            @endif
                        </div>
                        
                        <div class="space-y-3 pt-4 border-t border-white/10">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/50 text-xs">Hari Ini</span>
                                <span class="font-bold text-gold-light font-mono">1,234</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/50 text-xs">Total Kehadiran</span>
                                <span class="font-bold text-gold-light font-mono">156,432</span>
                            </div>
                    </div>

                </aside>
                <!-- END RIGHT SIDEBAR -->

            </div>
        </div>


        <!-- ██████████████████████████████████████████████████ -->
        <!-- ▌ PARALLAX CTA SECTION                           ▌ -->
        <!-- ██████████████████████████████████████████████████ -->
        <div class="section-separator mt-8"></div>

        <section class="parallax-section py-24" data-aos="fade-up">
            <div class="parallax-bg" data-speed="0.2"
                style="background-image: url('{{ asset('images/29251003_city-walk.webp') }}');"></div>
            <div class="parallax-overlay bg-gradient-to-r from-forest/90 via-forest/70 to-forest/90"></div>
            <div class="parallax-content max-w-4xl mx-auto text-center px-6">
                <div class="section-line mx-auto mb-4"></div>
                <p class="text-gold/80 text-xs uppercase tracking-[0.3em] mb-4">Layanan Publik</p>
                <h2 class="text-3xl md:text-5xl font-display font-extrabold text-white mb-4 text-glow">
                    Punya Keluhan atau Saran?
                </h2>
                <p class="text-lg text-white/60 mb-8 max-w-2xl mx-auto">
                    Gunakan SIKEMA (Sistem Keluhan Masyarakat) untuk menyampaikan aspirasi Anda
                </p>
                <a href="#"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl transition-all duration-300 hover:shadow-xl hover:shadow-gold/30 hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Sampaikan Keluhan
                </a>
            </div>
        </section>
    </div>

    <!-- ====== SIREMA MODAL FORM ====== -->
    <div x-show="siremaModal" x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden p-4"
        style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="siremaModal" x-transition.opacity.duration.300ms
             @click="siremaModal = false"
             class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div x-show="siremaModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             class="relative w-full max-w-md bg-[#0f1710] border border-gold/30 rounded-2xl shadow-2xl overflow-hidden z-[101]">
             
            <!-- Decorative Modal Accent -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-gold/10 blur-3xl rounded-full pointer-events-none"></div>
            <!-- Top Left Ornament -->
            <div class="variant-3 absolute top-0 left-0 w-24 h-24 text-gold/20 -translate-x-1/2 -translate-y-1/2 rotate-45 pointer-events-none"></div>

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gold/20 flex justify-between items-center bg-black/20">
                <div>
                    <h3 class="text-xl font-bold text-white tracking-wide">Layanan SIREMA</h3>
                    <p class="text-[10px] text-white/50 uppercase">Sistem Informasi Respons Masyarakat</p>
                </div>
                <button @click="siremaModal = false" class="text-white/50 hover:text-white transition-colors p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body (Form) -->
            <div class="p-6">
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs text-white/70 mb-1.5 font-bold">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama..." required
                            class="w-full bg-black/30 border border-gold/20 text-white text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold/60 focus:ring-1 focus:ring-gold/60 transition shadow-inner">
                    </div>
                    
                    <div>
                        <label class="block text-xs text-white/70 mb-1.5 font-bold">Kategori Laporan</label>
                        <select name="category" required
                            class="w-full bg-black/30 border border-gold/20 text-white text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold/60 focus:ring-1 focus:ring-gold/60 transition appearance-none shadow-inner">
                            <option value="" disabled selected class="text-gray-500">Pilih kategori...</option>
                            <option value="infrastruktur">Infrastruktur & Jalan</option>
                            <option value="pelayanan">Pelayanan Publik</option>
                            <option value="sosial">Bantuan Sosial</option>
                            <option value="ketertiban">Keamanan & Ketertiban</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs text-white/70 mb-1.5 font-bold">Deskripsi</label>
                        <textarea name="message" rows="4" placeholder="Tuliskan keluhan atau saran Anda secara detail..." required
                            class="w-full bg-black/30 border border-gold/20 text-white text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold/60 focus:ring-1 focus:ring-gold/60 transition resize-none shadow-inner"></textarea>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-gold to-gold-dark text-forest-dark font-bold text-center py-3 rounded-xl transition-all shadow-[0_4px_15px_rgba(212,175,55,0.3)] hover:shadow-[0_6px_25px_rgba(212,175,55,0.5)] hover:-translate-y-1 flex items-center justify-center text-sm uppercase tracking-wider">
                            <i class="fas fa-paper-plane mr-2"></i> Ajukan Laporan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- ====== END x-data WRAPPER ====== -->

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Leaflet Map - switching tile based on current theme
            if (document.getElementById('kecamatan-map')) {
                const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
                const darkTile  = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png';
                const lightTile = 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png';

                var kecMap = L.map('kecamatan-map', { scrollWheelZoom: false }).setView([-6.5916, 110.6746], 13);
                var tileLayer = L.tileLayer(currentTheme === 'dark' ? darkTile : lightTile, {
                    attribution: '&copy; OSM &copy; CARTO',
                    maxZoom: 19
                }).addTo(kecMap);

                L.marker([-6.5916, 110.6746]).addTo(kecMap)
                    .bindPopup('<b style="color:#333">Kecamatan Tahunan</b><br><span style="color:#666">Jepara, Jawa Tengah</span>').openPopup();

                // Store ref for theme-switching
                window._leafletMap = kecMap;
                window._leafletTileLayer = tileLayer;
                window._tileDark  = darkTile;
                window._tileLight = lightTile;

                // Override the global updateMapTile from layout
                window.updateMapTile = function(theme) {
                    if (window._leafletMap && window._leafletTileLayer) {
                        window._leafletMap.removeLayer(window._leafletTileLayer);
                        window._leafletTileLayer = L.tileLayer(
                            theme === 'dark' ? window._tileDark : window._tileLight,
                            { attribution: '&copy; OSM &copy; CARTO', maxZoom: 19 }
                        ).addTo(window._leafletMap);
                    }
                };
            }
        });
    </script>
@endpush