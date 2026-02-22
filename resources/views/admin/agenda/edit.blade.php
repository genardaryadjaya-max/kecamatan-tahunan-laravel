@extends('layouts.admin')

@section('title', 'Edit Agenda Kegiatan')

@section('content')
    <div class="container-fluid px-4 py-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.agenda.index') }}" class="text-gold hover:text-white text-sm mb-2 inline-block transition-colors"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Agenda</a>
                <h1 class="h3 mb-0 text-white font-bold">Edit Agenda</h1>
            </div>
        </div>

        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden max-w-3xl">
            <div class="p-6 border-b border-white/5">
                <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Judul Agenda <span class="text-red-400">*</span></label>
                        <input type="text" name="title" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('title', $agenda->title) }}" required>
                        @error('title') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Tanggal & Waktu <span class="text-red-400">*</span></label>
                            <input type="datetime-local" name="date_time" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" style="color-scheme: dark;" value="{{ old('date_time', $agenda->date_time->format('Y-m-d\TH:i')) }}" required>
                            @error('date_time') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Lokasi Kegiatan</label>
                            <input type="text" name="location" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('location', $agenda->location) }}" placeholder="Contoh: Aula Kecamatan / Zoom">
                            @error('location') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Tautan Ekstra (Opsional)</label>
                        <input type="url" name="link" class="w-full bg-black/30 border border-white/10 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition-colors" value="{{ old('link', $agenda->link) }}" placeholder="https://...">
                        <p class="text-white/40 text-xs mt-1">Gunakan untuk link Zoom, pendaftaran, atau materi.</p>
                        @error('link') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Status</label>
                        <label class="relative inline-flex items-center cursor-pointer mt-2">
                            <input type="checkbox" name="is_active" class="sr-only peer" value="1" {{ old('is_active', $agenda->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gold"></div>
                            <span class="ml-3 text-sm font-medium text-white/70">Aktif Tampilkan</span>
                        </label>
                    </div>

                    <div class="pt-4 border-t border-white/5 flex gap-3">
                        <button type="submit" class="px-6 py-2.5 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i> Perbarui
                        </button>
                        <a href="{{ route('admin.agenda.index') }}" class="px-6 py-2.5 bg-white/5 hover:bg-white/10 text-white font-medium rounded-lg transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
