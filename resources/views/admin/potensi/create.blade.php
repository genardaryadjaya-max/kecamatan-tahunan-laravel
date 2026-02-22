@extends('layouts.admin')

@section('title', 'Tambah Potensi')

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold text-white mb-6">Tambah Potensi Baru</h1>

            <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Nama Potensi *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Kategori *</label>
                        <select name="category" required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                            <option value="" class="bg-[#1e281e]">Pilih Kategori</option>
                            <option value="pertanian" class="bg-[#1e281e]" {{ old('category') == 'pertanian' ? 'selected' : '' }}>Pertanian
                            </option>
                            <option value="industri" class="bg-[#1e281e]" {{ old('category') == 'industri' ? 'selected' : '' }}>Industri &
                                Kerajinan</option>
                            <option value="wisata" class="bg-[#1e281e]" {{ old('category') == 'wisata' ? 'selected' : '' }}>Wisata</option>
                            <option value="peternakan" class="bg-[#1e281e]" {{ old('category') == 'peternakan' ? 'selected' : '' }}>Peternakan
                            </option>
                            <option value="seni budaya" class="bg-[#1e281e]" {{ old('category') == 'seni budaya' ? 'selected' : '' }}>Seni Budaya
                            </option>
                            <option value="kuliner" class="bg-[#1e281e]" {{ old('category') == 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                        </select>
                        @error('category') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Desa Tahunan"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Deskripsi Lengkap *</label>
                    <textarea name="description" rows="6" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Gambar Utama *</label>
                    <input type="file" name="image" accept="image/*" required onchange="previewImage(event)"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light @error('image') border-red-500 @enderror">
                    <p class="text-xs text-white/40 mt-1">Format: JPG, PNG, WEBP. Max: 2MB.</p>
                    <div class="mt-2">
                        <img id="imagePreview" src="" alt="Preview"
                            class="h-40 rounded-lg object-cover border border-white/10 hidden">
                    </div>
                    @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Gallery Upload -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Galeri Foto Lainnya (Multiple)</label>
                    <input type="file" name="gallery[]" accept="image/*" multiple onchange="previewGallery(event)"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light">
                    <div id="galleryPreview" class="mt-2 flex flex-wrap gap-2"></div>
                </div>

                <hr class="border-white/10 my-6">
                <h3 class="text-lg font-bold text-white mb-4">Informasi Kontak (Opsional)</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Telepon/WA</label>
                        <input type="text" name="contact" value="{{ old('contact') }}" placeholder="08123xxx"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>

                    <!-- Website -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Website/Sosmed</label>
                        <input type="url" name="website" value="{{ old('website') }}" placeholder="https://"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-white/20 focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center space-x-2 mt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="rounded bg-white/10 border-white/20 text-gold focus:ring-gold focus:ring-opacity-50 h-5 w-5">
                    <label for="is_active" class="text-sm text-white/80 select-none">Tampilkan Potensi Ini</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5 mt-6">
                    <a href="{{ route('admin.potensi.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">Simpan
                        Potensi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function previewGallery(event) {
            const container = document.getElementById('galleryPreview');
            container.innerHTML = '';
            const files = event.target.files;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-20 w-20 rounded object-cover border border-white/10';
                    container.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection