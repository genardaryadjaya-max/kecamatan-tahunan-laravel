<nav id="main-navbar" class="fixed top-0 w-full z-50 transition-all duration-500" x-data="{ 
        open: false, 
        profilOpen: false, 
        potensiOpen: false, 
        scrolled: false,
        profilTimer: null,
        potensiTimer: null,
        showProfil() { 
            clearTimeout(this.profilTimer); 
            this.profilOpen = true; 
        },
        hideProfil() { 
            this.profilTimer = setTimeout(() => { this.profilOpen = false; }, 200); 
        },
        showPotensi() { 
            clearTimeout(this.potensiTimer); 
            this.potensiOpen = true; 
        },
        hidePotensi() { 
            this.potensiTimer = setTimeout(() => { this.potensiOpen = false; }, 200); 
        }
    }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 60 })"
    :class="scrolled ? 'navbar-scrolled shadow-2xl py-2' : 'bg-transparent py-4'" style="background: transparent;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="relative">
                    <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara"
                        class="h-10 w-10 object-contain group-hover:scale-105 transition-all duration-300">
                </div>
                <div>
                    <span class="text-white font-bold text-lg tracking-wide block leading-tight">Kecamatan
                        Tahunan</span>
                    <span class="text-gold-light/60 text-[10px] uppercase tracking-[0.2em]">Kabupaten Jepara</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                   {{ request()->routeIs('home') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative" @mouseenter="showProfil()" @mouseleave="hideProfil()">
                    <button
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                            {{ request()->routeIs('profil.*') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        Profil
                        <svg class="ml-1 w-3.5 h-3.5 transition-transform" :class="profilOpen ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="profilOpen" @mouseenter="showProfil()" @mouseleave="hideProfil()"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        class="absolute left-0 mt-2 w-52 glass rounded-xl shadow-2xl py-1.5 z-50 nav-dropdown"
                        style="display: none;">
                        <a href="{{ route('profil.sejarah') }}"
                            class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Sejarah</a>
                        <a href="{{ route('profil.geografis') }}"
                            class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Letak
                            Geografis</a>
                        <a href="{{ route('profil.visi-misi') }}"
                            class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Visi
                            & Misi</a>
                        <a href="{{ route('profil.struktur') }}"
                            class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Struktur
                            Organisasi</a>
                    </div>
                </div>

                <!-- Potensi Dropdown -->
                <div class="relative" @mouseenter="showPotensi()" @mouseleave="hidePotensi()">
                    <button
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                            {{ request()->routeIs('potensi.*') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        Potensi
                        <svg class="ml-1 w-3.5 h-3.5 transition-transform" :class="potensiOpen ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="potensiOpen" @mouseenter="showPotensi()" @mouseleave="hidePotensi()"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="absolute left-0 mt-2 w-52 glass rounded-xl shadow-2xl py-1.5 z-50 nav-dropdown"
                        style="display: none;">
                        <a href="{{ route('potensi.index') }}"
                            class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Semua
                            Potensi</a>
                        @if(isset($potensiCategories) && $potensiCategories->count() > 0)
                            @foreach($potensiCategories as $cat)
                                <a href="{{ route('potensi.index', ['category' => $cat['slug']]) }}"
                                    class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">
                                    {{ $cat['label'] }}
                                </a>
                            @endforeach
                        @else
                            <a href="{{ route('potensi.index', ['category' => 'pertanian']) }}"
                                class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Pertanian</a>
                            <a href="{{ route('potensi.index', ['category' => 'industri']) }}"
                                class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Industri
                                & Kerajinan</a>
                            <a href="{{ route('potensi.index', ['category' => 'wisata']) }}"
                                class="block px-4 py-2.5 text-sm text-white/80 hover:text-gold-light hover:bg-white/10 transition">Wisata</a>
                        @endif
                        <div class="border-t border-white/10 my-1"></div>
                        <a href="{{ route('potensi.create.public') }}"
                            class="block px-4 py-2.5 text-sm text-gold font-bold hover:text-gold-light hover:bg-white/10 transition flex items-center">
                            <i class="fas fa-plus-circle mr-2 text-xs"></i> Daftarkan Potensi
                        </a>
                    </div>
                </div>

                <a href="{{ route('statistik') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                   {{ request()->routeIs('statistik') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Statistik</a>
                <a href="{{ route('unduhan') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                   {{ request()->routeIs('unduhan') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Unduhan</a>
                <a href="{{ route('faq') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300
                   {{ request()->routeIs('faq') ? 'bg-white/15 text-gold-light border border-gold/30' : 'text-white/80 hover:text-white hover:bg-white/10' }}">FAQ</a>

                <!-- Admin -->
                <a href="{{ route('login') }}"
                    class="ml-3 flex items-center px-4 py-2 rounded-lg text-sm font-semibold border border-gold/50 text-gold-light hover:bg-gold/20 hover:border-gold transition-all duration-300">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Admin
                </a>

                <!-- Dark/Light Mode Toggle -->
                <button title="Toggle dark/light mode" onclick="toggleTheme()" 
                    class="ml-2 w-9 h-9 flex items-center justify-center rounded-lg border border-gold/50 text-gold-light hover:bg-gold/20 hover:border-gold transition-all duration-300">
                    <i class="fas fa-moon theme-icon"></i>
                </button>
            </div>

            <!-- Mobile Button -->
            <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-white hover:bg-white/10 transition">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Nav -->
        <div x-show="open" x-transition class="lg:hidden border-t border-white/10 mt-3 pt-3 pb-4 space-y-1"
            style="display:none">
            <a href="{{ route('home') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">Beranda</a>
            <div x-data="{ sub: false }">
                <button @click="sub=!sub"
                    class="w-full flex justify-between px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">
                    Profil <svg class="w-4 h-4 transition" :class="sub?'rotate-180':''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="sub" x-transition class="pl-6 space-y-1 mt-1" style="display:none">
                    <a href="{{ route('profil.sejarah') }}"
                        class="block px-4 py-2 text-sm text-white/60 hover:text-gold-light rounded-lg">Sejarah</a>
                    <a href="{{ route('profil.geografis') }}"
                        class="block px-4 py-2 text-sm text-white/60 hover:text-gold-light rounded-lg">Letak
                        Geografis</a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="block px-4 py-2 text-sm text-white/60 hover:text-gold-light rounded-lg">Visi & Misi</a>
                    <a href="{{ route('profil.struktur') }}"
                        class="block px-4 py-2 text-sm text-white/60 hover:text-gold-light rounded-lg">Struktur
                        Organisasi</a>
                </div>
            </div>
            <a href="{{ route('potensi.index') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">Potensi</a>
            <a href="{{ route('potensi.create.public') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-gold font-bold hover:text-gold-light hover:bg-white/10 flex items-center">
                <i class="fas fa-plus-circle mr-2 text-xs"></i> Daftarkan Potensi
            </a>
            <a href="{{ route('statistik') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">Statistik</a>
            <a href="{{ route('unduhan') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">Unduhan</a>
            <a href="{{ route('faq') }}"
                class="block px-4 py-2.5 rounded-lg text-sm text-white/80 hover:text-white hover:bg-white/10">FAQ</a>
            
            <div class="flex items-center space-x-2 mx-4 mt-2">
                <a href="{{ route('login') }}"
                    class="flex-1 text-center px-4 py-2.5 border border-gold/50 text-gold-light rounded-lg text-sm font-semibold hover:bg-gold/20">Admin</a>
                
                <button title="Toggle dark/light mode" onclick="toggleTheme()" 
                    class="w-10 h-[42px] flex items-center justify-center rounded-lg border border-gold/50 text-gold-light hover:bg-gold/20 hover:border-gold transition-all duration-300">
                    <i class="fas fa-moon theme-icon"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar scrolled state - respects theme */
    [data-theme="light"] .navbar-scrolled {
        background: rgba(225, 248, 228, 0.96) !important;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-bottom: 1px solid rgba(60, 130, 65, 0.2);
    }

    [data-theme="dark"] .navbar-scrolled {
        background: rgba(26, 46, 26, 0.95) !important;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
    }

    /* Light mode: nav links readable on light background initially (unless over hero), but since we want transparent first over hero, we need white text initially in light mode, dark text locally scroled. But wait... the text is white by default in the blade component. */
    [data-theme="light"] #main-navbar.navbar-scrolled a,
    [data-theme="light"] #main-navbar.navbar-scrolled button,
    [data-theme="light"] #main-navbar.navbar-scrolled span {
        color: #1a3a1e !important;
    }

    [data-theme="light"] #main-navbar.navbar-scrolled a:hover,
    [data-theme="light"] #main-navbar.navbar-scrolled button:hover {
        color: #3d7a42 !important;
        background-color: rgba(60, 130, 65, 0.1) !important;
    }
    
    [data-theme="light"] #main-navbar.navbar-scrolled .bg-white\/15,
    [data-theme="light"] #main-navbar.navbar-scrolled .text-gold-light {
        color: #9e7e2e !important;
        border-color: #9e7e2e !important;
    }
</style>