@extends('layouts.admin')

@section('title', 'Tambah Desa')

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold text-white mb-6">Tambah Data Desa</h1>

            <form action="{{ route('admin.desa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Nama Desa *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Desa Tahunan"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kepala Desa -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Kepala Desa</label>
                    <input type="text" name="kepala_desa" value="{{ old('kepala_desa') }}" placeholder="Nama Kepala Desa"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Website URL -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Website Desa (URL)</label>
                        <input type="url" name="website_url" value="{{ old('website_url') }}"
                            placeholder="https://desa-tahunan.desa.id"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-white/20 focus:outline-none focus:border-gold/50 transition-colors @error('website_url') border-red-500 @enderror">
                        <p class="text-xs text-white/40 mt-1">Harus diawali dengan http:// atau https://</p>
                        @error('website_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Email Desa</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@desa.id"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08123456789"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>

                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Logo Desa</label>
                        <input type="file" name="logo" accept="image/*" onchange="previewLogo(event)"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light @error('logo') border-red-500 @enderror">
                        <p class="text-xs text-white/40 mt-1">Format: JPG, PNG. Max: 1MB.</p>
                        <div class="mt-2">
                            <img id="logoPreview" src="" alt="Preview"
                                class="h-20 w-20 rounded-full object-cover bg-white p-1 hidden">
                        </div>
                        @error('logo') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Alamat Kantor Desa</label>
                    <textarea name="alamat" rows="2"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">{{ old('alamat') }}</textarea>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">{{ old('description') }}</textarea>
                </div>

                <!-- Status -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="rounded bg-white/10 border-white/20 text-gold focus:ring-gold focus:ring-opacity-50 h-5 w-5">
                    <label for="is_active" class="text-sm text-white/80 select-none">Aktifkan data desa ini</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5">
                    <a href="{{ route('admin.desa.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logoPreview');
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
    </script>
@endsection