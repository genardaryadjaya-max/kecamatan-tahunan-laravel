@extends('layouts.app')

@section('title', 'Daftarkan Potensi Daerah')

@section('content')
<div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden min-h-screen">
    <!-- Background Effects -->
    <div class="theme-bg-top absolute top-0 inset-x-0 h-64 bg-gradient-to-b from-forest-dark via-forest-dark/80 to-transparent z-0 pointer-events-none"></div>
    <div class="absolute inset-0 bg-[url('{{ asset('images/noise.png') }}')] opacity-20 mix-blend-overlay z-0 pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-gold/10 rounded-full blur-3xl z-0 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto">
            <!-- Header section -->
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gold hover:text-white transition-colors text-sm mb-6 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
                <h1 class="text-3xl md:text-5xl font-display font-extrabold text-white mb-4 text-glow">
                    Daftarkan Potensi Anda
                </h1>
                <p class="text-lg text-white/60">
                    Bantu kami mengangkat potensi ekonomi, wisata, dan budaya yang ada di Kecamatan Tahunan agar lebih dikenal luas.
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl mb-8 flex items-start shadow-lg">
                    <i class="fas fa-check-circle mt-1 mr-4 text-xl"></i>
                    <div>
                        <h4 class="font-bold mb-1">Berhasil Dikirim!</h4>
                        <p class="text-sm opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="glass-card rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gold/5 blur-2xl rounded-full pointer-events-none"></div>
                <div class="variant-3 absolute top-0 right-0 w-24 h-24 text-gold/10 -translate-y-1/2 translate-x-1/2 rotate-45 pointer-events-none"></div>

                <form action="{{ route('potensi.store.public') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                    @csrf

                    <!-- Informasi Dasar -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-white border-b border-white/10 pb-2 flex items-center">
                            <i class="fas fa-info-circle text-gold mr-3"></i> Informasi Dasar
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Nama Potensi / Usaha <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Kerajinan Ukir Jati Abadi"
                                class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition">
                            @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-white/80 mb-2">Kategori <span class="text-red-400">*</span></label>
                                <select name="category" required class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition appearance-none cursor-pointer">
                                    <option value="" disabled selected class="potensi-option text-gray-500">Pilih kategori...</option>
                                    <option value="pertanian" class="potensi-option" {{ old('category') == 'pertanian' ? 'selected' : '' }}>Pertanian & Perkebunan</option>
                                    <option value="industri" class="potensi-option" {{ old('category') == 'industri' ? 'selected' : '' }}>Industri Kecil Menengah (IKM)</option>
                                    <option value="wisata" class="potensi-option" {{ old('category') == 'wisata' ? 'selected' : '' }}>Pariwisata</option>
                                    <option value="peternakan" class="potensi-option" {{ old('category') == 'peternakan' ? 'selected' : '' }}>Peternakan & Perikanan</option>
                                    <option value="jasa" class="potensi-option" {{ old('category') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                    <option value="lainnya" class="potensi-option" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('category') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-white/80 mb-2">Lokasi / Alamat Lengkap <span class="text-red-400">*</span></label>
                                <input type="text" name="location" value="{{ old('location') }}" required placeholder="Contoh: Desa Tahunan RT 01/RW 02"
                                    class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition">
                                @error('location') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Deskripsi Lengkap <span class="text-red-400">*</span></label>
                            <textarea name="description" rows="5" required placeholder="Ceritakan detail tentang potensi ini, keunggulannya, dan lain-lain..."
                                class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition resize-none">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="space-y-6 pt-4">
                        <h3 class="text-xl font-bold text-white border-b border-white/10 pb-2 flex items-center">
                            <i class="fas fa-camera text-gold mr-3"></i> Foto Potensi
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Foto Utama (Wajib) <span class="text-red-400">*</span></label>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg" required
                                class="potensi-input w-full text-sm text-white/60 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gold/10 file:text-gold hover:file:bg-gold/20 transition-all border border-white/10 rounded-xl p-2 bg-white/5">
                            <p class="text-white/40 text-xs mt-2">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            @error('image') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Galeri Tambahan (Opsional)</label>
                            <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/jpg" multiple
                                class="potensi-input w-full text-sm text-white/60 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-white/5 file:text-white/80 hover:file:bg-white/10 hover:text-white transition-all border border-white/10 rounded-xl p-2 bg-white/5">
                            <p class="text-white/40 text-xs mt-2">Bisa memilih lebih dari 1 foto sekaligus.</p>
                            @error('gallery.*') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="space-y-6 pt-4">
                        <h3 class="text-xl font-bold text-white border-b border-white/10 pb-2 flex items-center">
                            <i class="fas fa-address-book text-gold mr-3"></i> Informasi Kontak Pemilik
                        </h3>
                        <p class="text-white/40 text-xs mb-4">Pastikan kontak dapat dihubungi agar masyarakat yang tertarik bisa langsung menghubungi Anda.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-white/80 mb-2 flex items-center"><i class="fab fa-whatsapp text-green-400 mr-2"></i> Nomor WA</label>
                                <input type="text" name="contact" value="{{ old('contact') }}" placeholder="0812xxxx..."
                                    class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition">
                                @error('contact') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-white/80 mb-2 flex items-center"><i class="fas fa-envelope text-white/60 mr-2"></i> Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com"
                                    class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition">
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-white/80 mb-2 flex items-center"><i class="fas fa-globe text-white/60 mr-2"></i> Website / Sosmed</label>
                                <input type="url" name="website" value="{{ old('website') }}" placeholder="https://..."
                                    class="potensi-input w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition">
                                @error('website') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-white/10">
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-gold/30 hover:-translate-y-1 flex items-center justify-center shadow-md">
                            <i class="fas fa-paper-plane mr-3 text-lg"></i>
                            <span class="text-lg">Kirim Usulan Potensi</span>
                        </button>
                        <p class="text-white/30 text-xs mt-4 text-center sm:text-left">Catatan: Data yang Anda kirimkan akan ditinjau terlebih dahulu oleh pengelola kecamatan sebelum ditayangkan.</p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling khusus placeholder dan opsi select saat dalam light mode agar bisa terbaca */
    [data-theme="light"] .potensi-input::placeholder {
        color: rgba(26, 58, 30, 0.4) !important;
    }
    
    [data-theme="light"] select.potensi-input {
        color: #1a3a1e !important;
    }
    
    [data-theme="light"] .potensi-option {
        background-color: #f8faf8 !important;
        color: #1a3a1e !important;
    }
    
    [data-theme="dark"] .potensi-option {
        background-color: #0a110a !important;
        color: #f0fdf4 !important;
    }
    
    /* Tombol file upload saat di light mode */
    [data-theme="light"] input[type="file"].potensi-input::file-selector-button {
        background-color: rgba(158, 126, 46, 0.15) !important;
        color: #8a6a2a !important;
    }
    
    [data-theme="light"] input[name="gallery[]"].potensi-input::file-selector-button {
        background-color: rgba(45, 120, 55, 0.1) !important;
        color: #1a3a1e !important;
    }

    /* Sembunyikan gradien atas yang gelap di light mode agar navbar text terlihat */
    [data-theme="light"] .theme-bg-top {
        opacity: 0 !important;
        visibility: hidden !important;
    }

    /* Paksa teks navigasi header menjadi hijau gelap karena background atasnya sekarang terang */
    [data-theme="light"] #main-navbar:not(.navbar-scrolled) .text-white,
    [data-theme="light"] #main-navbar:not(.navbar-scrolled) .text-white\/80 {
        color: #1a3a1e !important;
    }
    
    [data-theme="light"] #main-navbar:not(.navbar-scrolled) .text-gold-light\/60 {
        color: #8a6a2a !important;
    }
</style>
@endsection
