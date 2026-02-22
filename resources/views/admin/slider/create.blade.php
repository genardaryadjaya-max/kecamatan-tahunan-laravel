@extends('layouts.admin')

@section('title', 'Tambah Video Background')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white font-display">Tambah Video Background</h1>
                <p class="text-white/40 text-sm mt-1">Upload gambar atau video untuk ditampilkan di latar belakang beranda</p>
            </div>
            <a href="{{ route('admin.slider.index') }}"
                class="px-4 py-2 bg-white/5 border border-white/10 text-white rounded-xl hover:bg-white/10 transition-all text-sm flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="admin-card p-6 md:p-8">
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title & Description -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gold mb-2 uppercase tracking-wide">Judul</label>
                        <input type="text" name="title"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:scale-[1.01] transition-transform"
                            placeholder="Judul Banner..." required>
                        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gold mb-2 uppercase tracking-wide">Link URL
                            (Opsional)</label>
                        <input type="url" name="link"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:scale-[1.01] transition-transform"
                            placeholder="https://...">
                        @error('link') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gold mb-2 uppercase tracking-wide">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:scale-[1.01] transition-transform"
                            placeholder="Deskripsi singkat..."></textarea>
                        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Media Section -->
                <div class="border-t border-white/10 pt-6">
                    <label class="block text-sm font-medium text-gold mb-4 uppercase tracking-wide">Konten Media</label>

                    <div>
                        <!-- Type Hidden Input (Default to Video) -->
                        <input type="hidden" name="type" value="video">

                        <!-- Video Input -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gold mb-2 uppercase tracking-wide">Upload Video
                                Background</label>
                            <label
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-white/20 hover:border-gold rounded-xl bg-white/5 hover:bg-white/10 transition-all cursor-pointer group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i
                                        class="fas fa-video text-3xl text-white/40 group-hover:text-gold transition-colors mb-3"></i>
                                    <p class="mb-2 text-sm text-white/70 font-semibold">Bawa/Klik untuk upload file video</p>
                                    <p class="text-xs text-white/40">MP4, WebM (Disarankan &lt; 20MB)</p>
                                </div>
                                <input type="file" name="video" class="hidden" accept="video/mp4,video/webm" id="video-upload" required>
                            </label>

                            <!-- Video Preview Script -->
                            <div id="video-preview-container" class="mt-4 hidden relative rounded-xl overflow-hidden border border-white/10 group bg-black/50 aspect-video">
                                <video id="video-preview" class="w-full h-full object-cover" controls muted loop></video>
                                <!-- Clear Button -->
                                <button type="button" onclick="clearVideoPreview()" class="absolute top-2 right-2 w-8 h-8 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>        @error('video') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Settings -->
                <div class="border-t border-white/10 pt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gold mb-2 uppercase tracking-wide">Urutan</label>
                        <input type="number" name="order" value="0"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:scale-[1.01] transition-transform">
                    </div>
                    <div class="flex items-center space-x-3 pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div
                                class="w-11 h-6 bg-white/10 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-gold/50 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gold">
                            </div>
                            <span class="ml-3 text-sm font-medium text-white/80">Aktifkan Video Background</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-white/10 pt-8 flex items-center justify-end space-x-4">
                    <button type="reset"
                        class="px-6 py-3 border border-white/10 text-white/60 rounded-xl hover:bg-white/5 hover:text-white transition-colors font-medium">
                        Reset
                    </button>
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl hover:shadow-lg hover:shadow-gold/20 hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i> Simpan Video Background
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection