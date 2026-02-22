@extends('layouts.admin')

@section('title', 'Edit Desa')

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">Edit Data Desa</h1>
                <a href="{{ route('admin.desa.index') }}" class="text-white/60 hover:text-white transition-colors"><i
                        class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>

            <form action="{{ route('admin.desa.update', $desa) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Nama Desa *</label>
                    <input type="text" name="name" value="{{ old('name', $desa->name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kepala Desa -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Kepala Desa</label>
                    <input type="text" name="kepala_desa" value="{{ old('kepala_desa', $desa->kepala_desa) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Website URL -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Website Desa (URL)</label>
                        <input type="url" name="website_url" value="{{ old('website_url', $desa->website_url) }}"
                            placeholder="https://..."
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-white/20 focus:outline-none focus:border-gold/50 transition-colors @error('website_url') border-red-500 @enderror">
                        @error('website_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Email Desa</label>
                        <input type="email" name="email" value="{{ old('email', $desa->email) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $desa->phone) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>

                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Logo</label>
                        <div class="flex items-center mb-2">
                            @if($desa->logo)
                                <img id="currentLogo" src="{{ asset('storage/' . $desa->logo) }}"
                                    class="h-10 w-10 object-contain rounded-full bg-white p-1 mr-2">
                            @endif
                            <span class="text-xs text-white/40">Logo saat ini</span>
                        </div>
                        <input type="file" name="logo" accept="image/*" onchange="previewLogo(event)"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light">
                        <div class="mt-2">
                            <img id="logoPreview" src="" alt="Preview"
                                class="h-20 w-20 rounded-full object-cover bg-white p-1 hidden">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Alamat Kantor Desa</label>
                    <textarea name="alamat" rows="2"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">{{ old('alamat', $desa->alamat) }}</textarea>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">{{ old('description', $desa->description) }}</textarea>
                </div>

                <!-- Status -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $desa->is_active) ? 'checked' : '' }}
                        class="rounded bg-white/10 border-white/20 text-gold focus:ring-gold focus:ring-opacity-50 h-5 w-5">
                    <label for="is_active" class="text-sm text-white/80 select-none">Aktifkan data desa ini</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5">
                    <a href="{{ route('admin.desa.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">Update
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