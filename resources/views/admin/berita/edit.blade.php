@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">Edit Berita</h1>
                <a href="{{ route('admin.berita.index') }}" class="text-white/60 hover:text-white transition-colors"><i
                        class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>

            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title', $berita->title) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('title') border-red-500 @enderror">
                    @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Isi Berita *</label>
                    <textarea name="content" rows="8" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('content') border-red-500 @enderror">{{ old('content', $berita->content) }}</textarea>
                    @error('content') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Ringkasan (Optional)</label>
                    <textarea name="excerpt" rows="2"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white/80 focus:outline-none focus:border-gold/50 transition-colors">{{ old('excerpt', $berita->excerpt) }}</textarea>
                    <p class="text-xs text-white/40 mt-1">Ringkasan singkat untuk preview di halaman depan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Kategori *</label>
                        <select name="category" required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                            <option value="berita" {{ old('category', $berita->category) == 'berita' ? 'selected' : '' }}>
                                Berita</option>
                            <option value="pengumuman" {{ old('category', $berita->category) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="kegiatan" {{ old('category', $berita->category) == 'kegiatan' ? 'selected' : '' }}>
                                Kegiatan</option>
                            <option value="agenda" {{ old('category', $berita->category) == 'agenda' ? 'selected' : '' }}>
                                Agenda</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Tanggal Publish</label>
                        <input type="date" name="published_at"
                            value="{{ old('published_at', $berita->published_at ? $berita->published_at->format('Y-m-d') : '') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Gambar Utama</label>
                    @if($berita->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $berita->image) }}" alt="Preview"
                                class="h-32 rounded-lg object-cover">
                            <p class="text-xs text-white/40 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-forest hover:file:bg-gold-light @error('image') border-red-500 @enderror">
                    @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}
                        class="rounded bg-white/10 border-white/20 text-gold focus:ring-gold focus:ring-opacity-50 h-5 w-5">
                    <label for="is_published" class="text-sm text-white/80 select-none">Publish Berita Ini</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5">
                    <a href="{{ route('admin.berita.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">Update
                        Berita</button>
                </div>
            </form>
        </div>
    </div>
@endsection