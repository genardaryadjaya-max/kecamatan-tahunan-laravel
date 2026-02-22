@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container-fluid px-4">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.profil.index') }}" class="text-white/40 hover:text-white transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-white">Struktur Organisasi</h1>
                <p class="text-white/50 text-sm mt-1">Kelola data struktur organisasi kecamatan</p>
            </div>
        </div>
        <a href="{{ route('admin.struktur.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-xl transition-all shadow-lg">
            <i class="fas fa-plus"></i> Tambah Anggota
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-500/20 border border-green-500/40 text-green-300 rounded-xl text-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white/40 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white/40 uppercase">Foto</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white/40 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white/40 uppercase">Jabatan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white/40 uppercase">Atasan</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-white/40 uppercase">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-white/40 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/3">
                @forelse($allStruktur as $i => $s)
                    <tr class="hover:bg-white/3 transition-colors">
                        <td class="px-4 py-3 text-white/40">{{ $i+1 }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ $s->photo ? asset('storage/'.$s->photo) : asset('images/placeholder-avatar.png') }}"
                                 alt="{{ $s->name }}" class="w-10 h-10 rounded-full object-cover border border-white/10">
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-white">{{ $s->name }}</div>
                            @if($s->nip)
                                <div class="text-xs text-white/40">NIP: {{ $s->nip }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-white/70">{{ $s->position }}</td>
                        <td class="px-4 py-3 text-white/50 text-xs">
                            @if($s->parent)
                                {{ $s->parent->name }}
                            @else
                                <span class="text-gold/50 italic">— Puncak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-0.5 text-xs rounded-full font-semibold
                                {{ $s->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.struktur.edit', $s) }}"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-gold/10 text-gold hover:bg-gold hover:text-forest transition-all" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.struktur.destroy', $s) }}" method="POST"
                                    onsubmit="return confirm('Hapus anggota ini?')">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-white/30">
                            <i class="fas fa-sitemap text-3xl mb-3 block opacity-30"></i>
                            Belum ada data struktur organisasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
