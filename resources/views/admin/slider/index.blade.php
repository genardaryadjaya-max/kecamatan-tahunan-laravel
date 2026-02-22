@extends('layouts.admin')

@section('title', 'Kelola Video Background')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white font-display">Video Background</h1>
                <p class="text-white/40 text-sm mt-1">Kelola video animasi looping yang tampil di beranda</p>
            </div>
            <a href="{{ route('admin.slider.create') }}"
                class="px-4 py-2 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl hover:shadow-lg hover:shadow-gold/20 transition-all text-sm flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Video Background
            </a>
        </div>

        <!-- Content -->
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Preview</th>
                            <th class="px-6 py-4">Judul & Deskripsi</th>
                            <th class="px-6 py-4 text-center">Tipe</th>
                            <th class="px-6 py-4 text-center">Urutan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($sliders as $index => $slider)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-6 py-4 text-center font-mono text-white/40">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div
                                        class="h-16 w-24 bg-white/5 rounded-lg overflow-hidden border border-white/10 relative">
                                        @if($slider->type == 'image' && $slider->image_url)
                                            <img src="{{ $slider->image_url }}" class="h-full w-full object-cover">
                                        @elseif($slider->type == 'video' && $slider->video_url)
                                            <video src="{{ $slider->video_url }}" class="h-full w-full object-cover"></video>
                                            <div class="absolute inset-0 flex items-center justify-center bg-black/40">
                                                <i class="fas fa-play text-white opacity-80"></i>
                                            </div>
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-white/20">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <h4 class="text-white font-medium mb-1">{{ $slider->title }}</h4>
                                    <p class="text-xs text-white/40 line-clamp-1">{{ $slider->description ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-bold uppercase {{ $slider->type == 'video' ? 'bg-red-500/10 text-red-400' : 'bg-blue-500/10 text-blue-400' }}">
                                        {{ $slider->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-mono text-white/60">{{ $slider->order }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="w-3 h-3 rounded-full inline-block {{ $slider->is_active ? 'bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]' : 'bg-white/20' }}"></span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                            class="p-2 bg-white/5 hover:bg-gold hover:text-forest text-white/60 rounded-lg transition-colors"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-white/5 hover:bg-red-500/80 hover:text-white text-white/60 rounded-lg transition-colors"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-white/30">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-images text-4xl mb-3 opacity-50"></i>
                                        <span class="text-lg font-medium">Belum ada video background</span>
                                        <p class="text-sm mt-1 max-w-sm mx-auto">Tambahkan video animasi looping untuk
                                            mempercantik halaman utama website.</p>
                                        <a href="{{ route('admin.slider.create') }}"
                                            class="mt-4 px-4 py-2 border border-white/10 hover:bg-white/5 rounded-lg text-sm text-gold transition-colors">
                                            <i class="fas fa-plus mr-1"></i> Tambah Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection