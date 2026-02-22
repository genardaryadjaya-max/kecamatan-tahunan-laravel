@extends('layouts.admin')

@section('title', 'Tautan Sosial & Pengaturan')

@section('content')
    <div class="container-fluid px-4 py-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center mb-6">
            <h1 class="h3 mb-0 text-white font-bold">Tautan Sosial</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden max-w-3xl">
            <div class="p-6 border-b border-white/5">
                <form action="{{ route('admin.setting.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Facebook -->
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2 flex items-center"><i class="fab fa-facebook text-blue-500 text-lg mr-2"></i> Facebook URL</label>
                            <input type="url" name="sosmed_facebook" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('sosmed_facebook', $sosmed['facebook']) }}" placeholder="https://facebook.com/...">
                            @error('sosmed_facebook') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Twitter / X -->
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2 flex items-center"><i class="fab fa-twitter text-blue-400 text-lg mr-2"></i> Twitter / X URL</label>
                            <input type="url" name="sosmed_twitter" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('sosmed_twitter', $sosmed['twitter']) }}" placeholder="https://twitter.com/...">
                            @error('sosmed_twitter') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2 flex items-center"><i class="fab fa-instagram text-pink-500 text-lg mr-2"></i> Instagram URL</label>
                            <input type="url" name="sosmed_instagram" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('sosmed_instagram', $sosmed['instagram']) }}" placeholder="https://instagram.com/...">
                            @error('sosmed_instagram') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- YouTube -->
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2 flex items-center"><i class="fab fa-youtube text-red-500 text-lg mr-2"></i> YouTube URL</label>
                            <input type="url" name="sosmed_youtube" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('sosmed_youtube', $sosmed['youtube']) }}" placeholder="https://youtube.com/...">
                            @error('sosmed_youtube') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/5 flex gap-3">
                        <button type="submit" class="px-6 py-2.5 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i> Simpan Tautan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
