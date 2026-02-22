<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Kecamatan Tahunan' }} - Website Resmi Kecamatan Tahunan</title>

    <meta name="description" content="{{ $description ?? 'Website Resmi Kecamatan Tahunan, Kabupaten Jepara' }}">
    <meta name="keywords" content="kecamatan tahunan, pemerintahan, jepara, website desa, berita">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac',
                            400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d',
                            800: '#166534', 900: '#14532d',
                        },
                        forest: { DEFAULT: '#1a2e1a', light: '#2f5233', accent: '#3d7a42' },
                        gold: { DEFAULT: '#c9a84c', light: '#e8c868', dark: '#9e7e2e' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Playfair Display', 'serif'],
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- Parallax & Custom Styles -->
    <style>
        /* ===== CSS VARIABLES - LIGHT MODE (default) ===== */
        :root,
        [data-theme="light"] {
            --bg-primary: #f0f7f0;
            --bg-secondary: #e2f0e2;
            --bg-card: #ffffff;
            --bg-glass: rgba(255, 255, 255, 0.90);
            --bg-glass-card: #ffffff;
            --text-primary: #1a3320;
            --text-secondary: #2d5a36;
            --text-muted: #5a7d5a;
            --border-color: rgba(45, 120, 55, 0.14);
            --shadow-color: rgba(20, 80, 30, 0.09);
            --scrollbar-bg: #d5edd8;
            --scrollbar-thumb: #4a9a50;
            --navbar-bg: rgba(255, 255, 255, 0.97);
            --section-sep: rgba(45, 120, 55, 0.10);
        }

        /* ===== DARK MODE ===== */
        [data-theme="dark"] {
            --bg-primary: #0a0f0a;
            --bg-secondary: #0f1a0f;
            --bg-card: rgba(20, 35, 20, 0.7);
            --bg-glass: rgba(26, 46, 26, 0.6);
            --bg-glass-card: rgba(20, 35, 20, 0.7);
            --text-primary: #e0e0e0;
            --text-secondary: #c8d8c8;
            --text-muted: rgba(255, 255, 255, 0.5);
            --border-color: rgba(255, 255, 255, 0.08);
            --shadow-color: rgba(0, 0, 0, 0.4);
            --scrollbar-bg: #0a0f0a;
            --scrollbar-thumb: #3d7a42;
            --navbar-bg: rgba(10, 15, 10, 0.92);
            --section-sep: rgba(10, 15, 10, 0.8);
        }

        /* ===== GLOBAL ===== */
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            transition: background 0.4s ease, color 0.4s ease;
        }

        /* ===== UTILITIES ===== */
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--scrollbar-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4ade80;
        }

        /* ===== SCROLL OFFSET untuk anchor links (kompensasi navbar sticky) ===== */
        section[id],
        div[id="content-start"] {
            scroll-margin-top: 80px;
        }

        /* ===== PARALLAX ===== */
        .parallax-section {
            position: relative;
            overflow: hidden;
        }

        .parallax-bg {
            position: absolute;
            inset: -20%;
            background-size: cover;
            background-position: center;
            will-change: transform;
            z-index: 0;
        }

        .parallax-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .parallax-content {
            position: relative;
            z-index: 2;
        }

        /* ===== GLASSMORPHISM ===== */
        .glass {
            background: var(--bg-glass);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--border-color);
            transition: background 0.4s ease, border-color 0.4s ease;
        }

        .glass-light {
            background: var(--bg-glass-card);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border: 1px solid var(--border-color);
        }

        .glass-card {
            background: var(--bg-glass-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ── LIGHT MODE: card menjadi putih solid dengan shadow lembut ── */
        [data-theme="light"] .glass,
        [data-theme="light"] .glass-light,
        [data-theme="light"] .glass-card {
            background: #ffffff !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border: 1px solid rgba(45, 120, 55, 0.14) !important;
            box-shadow: 0 2px 12px rgba(20, 80, 30, 0.08) !important;
        }

        [data-theme="light"] .glass-card:hover {
            background: #f5fbf5 !important;
            border-color: rgba(45, 140, 60, 0.28) !important;
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(20, 100, 40, 0.13) !important;
        }

        [data-theme="dark"] .glass-card:hover {
            background: rgba(30, 55, 30, 0.8);
            border-color: rgba(77, 170, 87, 0.3);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        /* ===== TEXT COLORS - LIGHT MODE overrides ===== */
        [data-theme="light"] .text-white {
            color: #1a3320 !important;
        }

        [data-theme="light"] .text-white\/90 {
            color: rgba(26, 51, 32, 0.92) !important;
        }

        [data-theme="light"] .text-white\/80 {
            color: rgba(26, 51, 32, 0.80) !important;
        }

        [data-theme="light"] .text-white\/70 {
            color: rgba(26, 51, 32, 0.70) !important;
        }

        [data-theme="light"] .text-white\/60 {
            color: rgba(26, 51, 32, 0.60) !important;
        }

        [data-theme="light"] .text-white\/50 {
            color: rgba(26, 51, 32, 0.55) !important;
        }

        [data-theme="light"] .text-white\/40 {
            color: rgba(26, 51, 32, 0.45) !important;
        }

        [data-theme="light"] .text-white\/30 {
            color: rgba(26, 51, 32, 0.38) !important;
        }

        [data-theme="light"] .text-white\/20 {
            color: rgba(26, 51, 32, 0.28) !important;
        }

        /* Revert text colors for explicitly dark sections in light mode */
        [data-theme="light"] .parallax-section .text-white,
        [data-theme="light"] .parallax-content .text-white,
        [data-theme="light"] footer .text-white { color: #ffffff !important; }

        /* Light mode navbar: always solid background, dark text */
        [data-theme="light"] #main-navbar {
            background: rgba(240, 245, 238, 0.97) !important;
            backdrop-filter: blur(12px);
            border-bottom: 2px solid transparent;
            border-image: linear-gradient(90deg, transparent, rgba(201,168,76,0.5), transparent) 1;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }
        [data-theme="light"] #main-navbar .text-white,
        [data-theme="light"] #main-navbar span.text-white { color: #1a3a1e !important; }
        [data-theme="light"] #main-navbar .text-white\/80 { color: rgba(26, 58, 30, 0.75) !important; }
        [data-theme="light"] #main-navbar .text-gold-light\/60 { color: rgba(158, 126, 46, 0.8) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/90,
        [data-theme="light"] .parallax-content .text-white\/90,
        [data-theme="light"] footer .text-white\/90 { color: rgba(255, 255, 255, 0.9) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/80,
        [data-theme="light"] .parallax-content .text-white\/80,
        [data-theme="light"] footer .text-white\/80 { color: rgba(255, 255, 255, 0.8) !important; }
        
        /* Navbar Dropdown Specific Fix: ensure text is dark inside the white glass card in light mode */
        [data-theme="light"] #main-navbar:not(.navbar-scrolled) .nav-dropdown .text-white\/80,
        [data-theme="light"] #main-navbar .nav-dropdown .text-white\/80 { color: rgba(26, 51, 32, 0.8) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/70,
        [data-theme="light"] .parallax-content .text-white\/70,
        [data-theme="light"] footer .text-white\/70 { color: rgba(255, 255, 255, 0.7) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/60,
        [data-theme="light"] .parallax-content .text-white\/60,
        [data-theme="light"] footer .text-white\/60 { color: rgba(255, 255, 255, 0.6) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/50,
        [data-theme="light"] .parallax-content .text-white\/50,
        [data-theme="light"] footer .text-white\/50 { color: rgba(255, 255, 255, 0.5) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/40,
        [data-theme="light"] .parallax-content .text-white\/40,
        [data-theme="light"] footer .text-white\/40 { color: rgba(255, 255, 255, 0.4) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/30,
        [data-theme="light"] .parallax-content .text-white\/30,
        [data-theme="light"] footer .text-white\/30 { color: rgba(255, 255, 255, 0.3) !important; }
        
        [data-theme="light"] .parallax-section .text-white\/20,
        [data-theme="light"] .parallax-content .text-white\/20,
        [data-theme="light"] footer .text-white\/20 { color: rgba(255, 255, 255, 0.2) !important; }

        /* Gold text di light mode lebih gelap agar kontras */
        [data-theme="light"] .text-gold-light {
            color: #8a6a2a !important;
        }

        [data-theme="light"] .text-gold {
            color: #9e7e2e !important;
        }

        /* ===== BORDER & BACKGROUND overrides - LIGHT MODE ===== */
        [data-theme="light"] .border-white\/5 {
            border-color: rgba(45, 120, 55, 0.12) !important;
        }

        [data-theme="light"] .border-white\/10 {
            border-color: rgba(45, 120, 55, 0.18) !important;
        }

        [data-theme="light"] .bg-white\/5 {
            background-color: rgba(45, 120, 55, 0.05) !important;
        }

        [data-theme="light"] .bg-white\/10 {
            background-color: rgba(45, 120, 55, 0.08) !important;
        }

        [data-theme="light"] .hover\:bg-white\/5:hover {
            background-color: rgba(45, 120, 55, 0.07) !important;
        }

        [data-theme="light"] .hover\:bg-white\/15:hover {
            background-color: rgba(45, 120, 55, 0.12) !important;
        }

        /* border-gold/40 → lebih subtle di light */
        [data-theme="light"] .border-gold\/40 {
            border-color: rgba(158, 126, 46, 0.30) !important;
        }

        [data-theme="light"] .hover\:bg-gold\/10:hover {
            background-color: rgba(158, 126, 46, 0.08) !important;
        }

        /* ===== DIVIDER LINES ===== */
        .section-line {
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, #c9a84c, #3d7a42);
        }

        /* ===== GLOW EFFECTS ===== */
        .glow-green {
            box-shadow: 0 0 30px rgba(61, 122, 66, 0.3);
        }

        .text-glow {
            text-shadow: 0 0 40px rgba(61, 122, 66, 0.4);
        }

        /* ===== LINE CLAMP ===== */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ===== LEAFLET ===== */
        .leaflet-container {
            border-radius: 12px;
            z-index: 1;
        }

        /* ===== GRADIENT TEXT ===== */
        .gradient-text {
            background: linear-gradient(135deg, #ffffff 0%, #c9a84c 50%, #4ade80 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== NOISE TEXTURE ===== */
        .noise::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.03;
            pointer-events: none;
            z-index: 0;
        }

        /* ===== JEPARA ORNAMENT (UKIRAN) ===== */
        .sidebar-ornament {
            position: absolute;
            background-repeat: no-repeat;
            background-size: contain;
            pointer-events: none;
            z-index: -1;
            transition: all 0.5s ease;
        }

        .variant-1 {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='currentColor' stroke-width='1.5'%3E%3Cpath d='M100 10 C130 40 120 80 100 100 C80 80 70 40 100 10 Z'/%3E%3Cpath d='M100 190 C130 160 120 120 100 100 C80 120 70 160 100 190 Z'/%3E%3Cpath d='M10 100 C40 70 80 80 100 100 C80 120 40 130 10 100 Z'/%3E%3Cpath d='M190 100 C160 70 120 80 100 100 C120 120 160 130 190 100 Z'/%3E%3Cpath d='M30 30 C60 40 80 60 100 100 C60 80 40 60 30 30 Z'/%3E%3Cpath d='M170 170 C140 160 120 140 100 100 C140 120 160 140 170 170 Z'/%3E%3Cpath d='M170 30 C140 40 120 60 100 100 C140 80 160 60 170 30 Z'/%3E%3Cpath d='M30 170 C60 160 80 140 100 100 C60 120 40 140 30 170 Z'/%3E%3Cpath d='M100 10 C160 10 190 40 190 100 C190 160 160 190 100 190 C40 190 10 160 10 100 C10 40 40 10 100 10 Z' stroke-dasharray='4 4'/%3E%3Ccircle cx='100' cy='100' r='10'/%3E%3Ccircle cx='100' cy='100' r='45' stroke-dasharray='2 4'/%3E%3Cpath d='M60 100 C60 80 80 60 100 60'/%3E%3Cpath d='M140 100 C140 120 120 140 100 140'/%3E%3C/g%3E%3C/svg%3E");
        }

        .variant-2 {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='currentColor' stroke-width='2'%3E%3Cpath d='M20 180 C80 180 120 120 100 80 C80 40 40 60 50 100 C60 140 120 140 160 100 C180 80 160 40 130 40 C100 40 60 100 90 150'/%3E%3Cpath d='M90 150 C120 180 160 160 170 130' stroke-dasharray='4 6'/%3E%3Ccircle cx='130' cy='40' r='5'/%3E%3Ccircle cx='20' cy='180' r='8'/%3E%3C/g%3E%3C/svg%3E");
        }

        .variant-3 {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='currentColor' stroke-width='1.5'%3E%3Crect x='50' y='50' width='100' height='100' transform='rotate(45 100 100)'/%3E%3Crect x='70' y='70' width='60' height='60' transform='rotate(45 100 100)' stroke-dasharray='4 4'/%3E%3Ccircle cx='100' cy='100' r='20'/%3E%3Cpath d='M100 20 L100 50 M100 150 L100 180 M20 100 L50 100 M150 100 L180 100'/%3E%3Ccircle cx='100' cy='100' r='70' stroke-dasharray='2 6'/%3E%3C/g%3E%3C/svg%3E");
        }

        [data-theme="light"] .sidebar-ornament {
            color: #2d7a35;
            opacity: 0.2;
        }

        [data-theme="dark"] .sidebar-ornament {
            color: #e8c868; /* Brighter gold */
            opacity: 0.35; /* Much more visible */
        }

        /* ===== SMOOTH FADE SECTIONS ===== */
        .section-separator {
            height: 120px;
            background: linear-gradient(180deg, transparent 0%, var(--section-sep) 50%, transparent 100%);
            position: relative;
        }

        .section-separator::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, 0.5), transparent);
        }

        /* ===== LIGHT MODE - HERO OVERLAY ===== */
        [data-theme="light"] .hero-overlay-dark {
            background: linear-gradient(to bottom, rgba(20, 60, 22, 0.70) 0%, rgba(0, 0, 0, 0.35) 50%, rgba(20, 60, 22, 0.80) 100%) !important;
        }

        /* Light mode text colors are handled by .navbar-scrolled in navbar.blade.php */


        *,
        *::before,
        *::after {
            transition: background-color 0.35s ease, border-color 0.35s ease, color 0.35s ease;
        }

        /* But NOT for transforms/animations - avoid jank */
        img,
        video,
        .parallax-bg,
        [data-aos],
        .gradient-text {
            transition: transform 0.4s ease, opacity 0.4s ease !important;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Back to Top -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 w-12 h-12 rounded-full glass glow-green text-white flex items-center justify-center opacity-0 invisible transition-all duration-500 hover:scale-110 z-50 cursor-pointer"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </button>



    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @stack('scripts')

    <script>
        // =========================================================
        // THEME MANAGEMENT (Light/Dark)
        // =========================================================
        const htmlEl = document.documentElement;

        function applyTheme(theme) {
            htmlEl.setAttribute('data-theme', theme);
            localStorage.setItem('site-theme', theme);
            
            const themeIcons = document.querySelectorAll('.theme-icon');
            themeIcons.forEach(icon => {
                icon.className = theme === 'dark' ? 'fas fa-sun theme-icon' : 'fas fa-moon theme-icon';
            });
            
            // Update leaflet tile if needed
            if (window._leafletMap) {
                updateMapTile(theme);
            }
        }

        function toggleTheme() {
            const current = htmlEl.getAttribute('data-theme') || 'light';
            applyTheme(current === 'dark' ? 'light' : 'dark');
        }

        // Load saved preference (default = dark)
        const savedTheme = localStorage.getItem('site-theme') || 'dark';
        applyTheme(savedTheme);

        // =========================================================
        // AOS Init
        // =========================================================
        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 80 });

        // =========================================================
        // Back to Top
        // =========================================================
        window.addEventListener('scroll', function () {
            const btn = document.getElementById('back-to-top');
            if (!btn) return;
            if (window.scrollY > 400) {
                btn.classList.remove('opacity-0', 'invisible');
                btn.classList.add('opacity-100', 'visible');
            } else {
                btn.classList.add('opacity-0', 'invisible');
                btn.classList.remove('opacity-100', 'visible');
            }
        });

        // =========================================================
        // Parallax on Scroll
        // =========================================================
        window.addEventListener('scroll', function () {
            document.querySelectorAll('.parallax-bg').forEach(el => {
                const speed = parseFloat(el.dataset.speed || 0.3);
                const rect = el.parentElement.getBoundingClientRect();
                const offset = (rect.top + rect.height / 2 - window.innerHeight / 2) * speed;
                el.style.transform = `translateY(${offset}px) scale(1.15)`;
            });
        });

        // =========================================================
        // Counter Animation
        // =========================================================
        document.querySelectorAll('[data-counter]').forEach(counter => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(counter.dataset.counter);
                        let current = 0;
                        const increment = target / 80;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                counter.textContent = target.toLocaleString('id-ID');
                                clearInterval(timer);
                            } else {
                                counter.textContent = Math.floor(current).toLocaleString('id-ID');
                            }
                        }, 20);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            observer.observe(counter);
        });

        // =========================================================
        // Smooth Scroll for hero anchor buttons
        // (Kompensasi navbar height agar judul section terlihat)
        // =========================================================
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('a[href^="#"]').forEach(link => {
                link.addEventListener('click', function (e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        const navbarHeight = 72; // tinggi navbar dalam px
                        const offsetTop = target.getBoundingClientRect().top + window.scrollY - navbarHeight;
                        window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>