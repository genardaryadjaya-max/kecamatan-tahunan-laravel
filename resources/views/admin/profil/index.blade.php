@extends('layouts.admin')

@section('title', 'Profil Kecamatan')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Profil Kecamatan</h1>
        <p class="text-white/50 text-sm mt-1">Kelola konten halaman profil (Sejarah, Visi Misi, Struktur, dll).</p>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-500/20 border border-green-500/40 text-green-300 rounded-xl text-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ── Regular Profil Cards (Sejarah, Visi Misi, Geografis) ── --}}
        @foreach($profils as $profil)
            <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg group hover:border-gold/30 transition-all">
                <div class="relative h-40 bg-black/20 overflow-hidden">
                    @if($profil->image)
                        <img src="{{ asset('storage/' . $profil->image) }}" alt="{{ $profil->title }}"
                            class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white/20">
                            <i class="fas fa-file-alt text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1e281e] to-transparent"></div>
                    <h3 class="absolute bottom-4 left-4 text-xl font-bold text-white font-display">{{ $profil->title }}</h3>
                </div>
                <div class="p-5">
                    <div class="text-white/50 text-sm mb-4 line-clamp-2">
                        {!! Str::limit(strip_tags($profil->content), 120) !!}
                    </div>
                    <div class="flex justify-between items-center border-t border-white/5 pt-4">
                        <span class="text-xs text-white/30">Update: {{ $profil->updated_at->format('d M Y') }}</span>
                        <a href="{{ route('admin.profil.edit', $profil) }}"
                            class="px-4 py-2 bg-white/5 hover:bg-gold hover:text-forest text-gold rounded-lg text-sm font-bold transition-colors">
                            Edit Konten <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- ── Struktur Organisasi Special Card ── --}}
        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg group hover:border-gold/30 transition-all md:col-span-2">
            <div class="p-6 border-b border-white/5 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-white font-display flex items-center gap-2">
                        <i class="fas fa-sitemap text-gold/60"></i> Struktur Organisasi
                    </h3>
                    <p class="text-white/40 text-sm mt-1">
                        {{ $strukturCount }} anggota terdaftar •
                        Kelola jabatan dan nama pejabat kecamatan
                    </p>
                </div>
                <a href="{{ route('admin.struktur.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-xl text-sm transition-all">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>

            @if($strukturCount > 0)
                <div class="p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($strukturs->take(10) as $s)
                            <div class="flex flex-col items-center text-center group/card">
                                <div class="relative">
                                    <img src="{{ $s->photo ? asset('storage/'.$s->photo) : asset('images/placeholder-avatar.png') }}"
                                        alt="{{ $s->name }}"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-white/10 group-hover/card:border-gold/40 transition-all">
                                    @if(!$s->is_active)
                                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border border-[#1e281e]" title="Nonaktif"></span>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <p class="text-white text-xs font-semibold leading-tight">{{ Str::limit($s->name, 20) }}</p>
                                    <p class="text-gold/60 text-[10px] mt-0.5">{{ Str::limit($s->position, 22) }}</p>
                                </div>
                                <a href="{{ route('admin.struktur.edit', $s) }}"
                                    class="mt-2 text-[10px] text-white/30 hover:text-gold transition-colors">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        @endforeach
                        @if($strukturCount > 10)
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 rounded-full bg-white/5 border-2 border-white/10 flex items-center justify-center">
                                    <span class="text-white/40 text-sm font-bold">+{{ $strukturCount - 10 }}</span>
                                </div>
                                <p class="text-white/30 text-xs mt-2">lainnya</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="p-10 text-center text-white/30">
                    <i class="fas fa-sitemap text-4xl mb-3 block opacity-20"></i>
                    Belum ada data anggota. Klik "+ Tambah Anggota" untuk mulai.
                </div>
            @endif

            <div class="px-6 pb-5 flex justify-end border-t border-white/5 pt-4">
                <a href="{{ route('admin.struktur.index') }}"
                    class="px-4 py-2 bg-white/5 hover:bg-gold hover:text-forest text-gold rounded-lg text-sm font-bold transition-colors">
                    Kelola Semua Anggota <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection