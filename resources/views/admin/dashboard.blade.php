@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white font-display">Dashboard Overview</h1>
                <p class="text-white/40 text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name ?? 'Admin' }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gold uppercase tracking-widest font-bold">{{ date('l, d F Y') }}</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Berita Stats -->
            <div class="admin-card p-6 relative overflow-hidden group hover:border-gold/30 transition-colors">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-newspaper text-6xl text-white"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="text-white/50 text-sm font-medium uppercase tracking-wider mb-2">Total Berita</h3>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-bold text-white">{{ $stats['total_berita'] ?? 0 }}</span>
                        <span class="text-xs text-green-400 font-medium bg-green-400/10 px-2 py-0.5 rounded-full">
                            {{ $stats['published_berita'] ?? 0 }} Publis
                        </span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="{{ route('admin.berita.index') }}"
                            class="text-xs text-gold hover:text-white flex items-center transition-colors">
                            Kelola Berita <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Desa Stats -->
            <div class="admin-card p-6 relative overflow-hidden group hover:border-gold/30 transition-colors">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-home text-6xl text-white"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="text-white/50 text-sm font-medium uppercase tracking-wider mb-2">Data Desa</h3>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-bold text-white">{{ $stats['total_desa'] ?? 0 }}</span>
                        <span class="text-xs text-blue-400 font-medium bg-blue-400/10 px-2 py-0.5 rounded-full">
                            {{ $stats['active_desa'] ?? 0 }} Aktif
                        </span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="{{ route('admin.desa.index') }}"
                            class="text-xs text-gold hover:text-white flex items-center transition-colors">
                            Lihat Desa <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Potensi Stats -->
            <div class="admin-card p-6 relative overflow-hidden group hover:border-gold/30 transition-colors">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-gem text-6xl text-white"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="text-white/50 text-sm font-medium uppercase tracking-wider mb-2">Potensi Daerah</h3>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-bold text-white">{{ $stats['total_potensi'] ?? 0 }}</span>
                        <span class="text-xs text-green-400 font-medium bg-green-400/10 px-2 py-0.5 rounded-full">
                            {{ $stats['active_potensi'] ?? 0 }} Aktif
                        </span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="{{ route('admin.potensi.index') }}"
                            class="text-xs text-gold hover:text-white flex items-center transition-colors">
                            Kelola Potensi <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slider & Statistik Stats -->
            <div class="admin-card p-6 relative overflow-hidden group hover:border-gold/30 transition-colors">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-images text-6xl text-white"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="text-white/50 text-sm font-medium uppercase tracking-wider mb-2">Video Background & Data</h3>
                    <div class="flex items-baseline space-x-3">
                        <div>
                            <span class="text-2xl font-bold text-white">{{ $stats['total_slider'] ?? 0 }}</span>
                            <span class="text-xs text-purple-400 block">Video Bg</span>
                        </div>
                        <div class="border-l border-white/10 pl-3">
                            <span class="text-2xl font-bold text-white">{{ $stats['total_statistik'] ?? 0 }}</span>
                            <span class="text-xs text-orange-400 block">Statistik</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5 flex space-x-2">
                        <a href="{{ route('admin.slider.index') }}"
                            class="text-xs text-gold hover:text-white transition-colors">
                            Video Background <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <span class="text-white/20">|</span>
                        <a href="{{ route('admin.statistik.index') }}"
                            class="text-xs text-gold hover:text-white transition-colors">
                            Statistik <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Recent News -->
            <div class="lg:col-span-2 admin-card overflow-hidden">
                <div class="p-5 border-b border-white/5 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white font-display">Berita Terbaru</h3>
                    <a href="#" class="text-xs text-gold hover:text-white transition-colors">Lihat Semua</a>
                </div>
                <div class="p-0">
                    @if(isset($latest_berita) && $latest_berita->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-white/70">
                                <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                                    <tr>
                                        <th class="px-6 py-3">Judul Berita</th>
                                        <th class="px-6 py-3">Kategori</th>
                                        <th class="px-6 py-3">Tanggal</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($latest_berita as $berita)
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-4 font-medium text-white">{{ Str::limit($berita->title, 40) }}</td>
                                            <td class="px-6 py-4">{{ $berita->category }}</td>
                                            <td class="px-6 py-4 text-xs font-mono">{{ $berita->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold {{ $berita->is_published ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-500' }}">
                                                    {{ $berita->is_published ? 'PUBLISHED' : 'DRAFT' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center text-white/30">
                            <i class="fas fa-newspaper text-4xl mb-3 block"></i>
                            Belum ada berita.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card overflow-hidden">
                <div class="p-5 border-b border-white/5">
                    <h3 class="text-lg font-bold text-white font-display">Akses Cepat</h3>
                </div>
                <div class="p-5 grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.berita.create') }}"
                        class="flex flex-col items-center justify-center p-4 bg-white/5 hover:bg-gold/10 hover:border-gold/30 border border-transparent rounded-xl transition-all group text-center">
                        <i
                            class="fas fa-plus-circle text-2xl text-gold mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-white/80 group-hover:text-gold">Tambah Berita</span>
                    </a>
                    <a href="{{ route('admin.slider.create') }}"
                        class="flex flex-col items-center justify-center p-4 bg-white/5 hover:bg-gold/10 hover:border-gold/30 border border-transparent rounded-xl transition-all group text-center">
                        <i
                            class="fas fa-video text-2xl text-blue-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-white/80 group-hover:text-blue-400">Upload Video Background</span>
                    </a>
                    <a href="{{ route('admin.potensi.create') }}"
                        class="flex flex-col items-center justify-center p-4 bg-white/5 hover:bg-gold/10 hover:border-gold/30 border border-transparent rounded-xl transition-all group text-center">
                        <i class="fas fa-gem text-2xl text-green-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-white/80 group-hover:text-green-400">Tambah Potensi</span>
                    </a>
                    <a href="{{ route('admin.statistik.create') }}"
                        class="flex flex-col items-center justify-center p-4 bg-white/5 hover:bg-gold/10 hover:border-gold/30 border border-transparent rounded-xl transition-all group text-center">
                        <i
                            class="fas fa-chart-line text-2xl text-purple-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-white/80 group-hover:text-purple-400">Tambah Statistik</span>
                    </a>
                </div>

                <div class="p-5 border-t border-white/5 mt-auto">
                    <h4 class="text-xs font-bold text-white/40 uppercase tracking-widest mb-3">System Info</h4>
                    <div class="space-y-2 text-xs text-white/60">
                        <div class="flex justify-between">
                            <span>Laravel Version</span>
                            <span class="font-mono text-white">{{ app()->version() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>PHP Version</span>
                            <span class="font-mono text-white">{{ phpversion() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Server Time</span>
                            <span class="font-mono text-white">{{ date('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection