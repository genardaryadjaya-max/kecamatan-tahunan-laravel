<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} - Admin Kecamatan Tahunan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CDN (Fallback) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac',
                            400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d',
                            800: '#166534', 900: '#14532d',
                        },
                        forest: { DEFAULT: '#1a2e1a', light: '#2f5233', accent: '#3d7a42', dark: '#0a0f0a' },
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

    <style>
        /* ===== GLOBAL ADMIN ===== */
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0f0a;
            color: #e0e0e0;
        }

        /* Sidebar Glass */
        .sidebar-glass {
            background: rgba(26, 46, 26, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Topbar Glass */
        .topbar-glass {
            background: rgba(10, 15, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Admin Cards */
        .admin-card {
            background: rgba(30, 40, 30, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0f0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #3d7a42;
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4ade80;
        }

        /* Form Inputs */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #c9a84c;
            box-shadow: 0 0 0 2px rgba(201, 168, 76, 0.2);
        }
    </style>
</head>

<body class="antialiased h-screen overflow-hidden flex" x-data="{ sidebarOpen: true }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 sidebar-glass transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto flex flex-col">

        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-white/5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                <div>
                    <span class="block text-white font-bold tracking-wide">Admin Panel</span>
                    <span class="block text-xs text-gold uppercase tracking-widest">Kecamatan</span>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="px-4 text-xs font-semibold text-white/40 uppercase tracking-wider mb-2">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-gold to-gold-dark text-forest font-bold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> Dashboard
            </a>

            <!-- Content Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.berita.*', 'admin.desa.*', 'admin.potensi.*', 'admin.layanan.*', 'admin.agenda.*', 'admin.statistik.*') ? 'true' : 'false' }} }"
                class="space-y-1 mt-4">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-white/70 rounded-xl hover:bg-white/5 hover:text-white transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-edit w-5 h-5 mr-3"></i> Konten Website
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-4 space-y-1">
                    <a href="{{ route('admin.berita.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.berita.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-newspaper w-4 mr-2"></i> Berita & Artikel
                    </a>
                    <a href="{{ route('admin.desa.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.desa.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-home w-4 mr-2"></i> Website Desa
                    </a>
                    <a href="{{ route('admin.potensi.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.potensi.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-gem w-4 mr-2"></i> Potensi Daerah
                    </a>
                    <a href="{{ route('admin.layanan.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.layanan.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-id-card w-4 mr-2"></i> Layanan Publik
                    </a>
                    <a href="{{ route('admin.agenda.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.agenda.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-calendar-alt w-4 mr-2"></i> Agenda Kegiatan
                    </a>
                    <a href="{{ route('admin.statistik.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.statistik.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-chart-bar w-4 mr-2"></i> Statistik
                    </a>
                </div>
            </div>

            <!-- Profil & Settings -->
            <div x-data="{ open: {{ request()->routeIs('admin.profil.*', 'admin.slider.*', 'admin.setting.*') ? 'true' : 'false' }} }"
                class="space-y-1 mt-2">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-white/70 rounded-xl hover:bg-white/5 hover:text-white transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i> Pengaturan
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-4 space-y-1">
                    <a href="{{ route('admin.profil.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.profil.*', 'admin.struktur.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-info-circle w-4 mr-2"></i> Profil Kecamatan
                    </a>
                    <a href="{{ route('admin.slider.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.slider.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-video w-4 mr-2"></i> Video Background
                    </a>
                    <a href="{{ route('admin.setting.index') }}"
                        class="block px-4 py-2 text-sm transition-colors {{ request()->routeIs('admin.setting.*') ? 'text-gold bg-white/5 font-semibold' : 'text-white/60 hover:text-gold hover:bg-white/5' }} rounded-lg">
                        <i class="fas fa-share-alt w-4 mr-2"></i> Tautan Sosial
                    </a>
                </div>
            </div>

            <a href="{{ route('home') }}" target="_blank"
                class="flex items-center px-4 py-3 mt-4 text-sm font-medium text-white/70 rounded-xl hover:bg-white/5 hover:text-white transition-colors">
                <i class="fas fa-external-link-alt w-5 h-5 mr-3"></i> Lihat Website
            </a>
        </nav>

        <!-- User Profile -->
        <div class="border-t border-white/5 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gold/20 flex items-center justify-center text-gold font-bold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-400 hover:text-red-300 flex items-center mt-0.5">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#0d120d]">

        <!-- Topbar Mobile -->
        <header class="flex items-center justify-between lg:hidden px-4 py-3 topbar-glass">
            <button @click="sidebarOpen = true" class="text-white/70 hover:text-white">
                <i class="fas fa-bars w-6 h-6"></i>
            </button>
            <span class="text-white font-bold">Admin Panel</span>
            <div class="w-6"></div> <!-- Spacer -->
        </header>

        <!-- Content Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-[#0d120d] to-[#121c12] p-6">
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl flex items-center"
                    x-data="{ show: true }" x-show="show">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-green-400 hover:text-white"><i
                            class="fas fa-times"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl flex items-center"
                    x-data="{ show: true }" x-show="show">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto text-red-400 hover:text-white"><i
                            class="fas fa-times"></i></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>

</html>