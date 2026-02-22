@extends('layouts.admin')

@section('title', 'Edit ' . $profil->title)

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">Edit {{ $profil->title }}</h1>
                <a href="{{ route('admin.profil.index') }}" class="text-white/60 hover:text-white transition-colors"><i
                        class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>

            <form action="{{ route('admin.profil.update', $profil) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title (Read-Only) -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Judul Halaman</label>
                    <input type="text" name="title" value="{{ old('title', $profil->title) }}" readonly
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white/50 cursor-not-allowed">
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Konten Halaman *</label>
                    <textarea name="content" rows="12" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">{{ old('content', $profil->content) }}</textarea>
                    <p class="text-xs text-white/40 mt-1">Anda bisa menggunakan tag HTML dasar seperti &lt;p&gt;,
                        &lt;strong&gt;, &lt;ul&gt;.</p>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Gambar Header (Optional)</label>
                    @if($profil->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $profil->image) }}" alt="Preview"
                                class="h-40 w-full object-cover rounded-lg border border-white/10">
                            <p class="text-xs text-white/40 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light">
                    <p class="text-xs text-white/40 mt-1">Gambar ini akan muncl di bagian atas halaman profil.</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5">
                    <a href="{{ route('admin.profil.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection