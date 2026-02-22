@extends('layouts.admin')

@section('title', 'Layanan Publik')

@section('content')
    <div class="container-fluid px-4 py-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center mb-6">
            <h1 class="h3 mb-0 text-white font-bold">Layanan Publik</h1>
            <a href="{{ route('admin.layanan.create') }}"
                class="px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg">
                <i class="fas fa-plus me-2"></i>Tambah Layanan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-white/5">
                <h6 class="m-0 font-bold text-white">Daftar Layanan</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Ikon</th>
                            <th class="px-6 py-3">Nama Layanan</th>
                            <th class="px-6 py-3">URL Tautan</th>
                            <th class="px-6 py-3 text-center">Urutan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($layanans as $index => $layanan)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="h-10 w-10 bg-gold/10 rounded-full flex items-center justify-center text-lg text-gold border border-gold/20 mx-auto">
                                        <i class="{{ $layanan->icon ?? 'fas fa-link' }}"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-white">{{ $layanan->name }}</td>
                                <td class="px-6 py-4">
                                    @if($layanan->url)
                                        <a href="{{ $layanan->url }}" target="_blank" class="text-gold hover:text-white transition-colors text-xs flex items-center">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Tautan
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center font-mono">{{ $layanan->order }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $layanan->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                        {{ $layanan->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.layanan.edit', $layanan) }}" class="text-gold hover:text-white transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-white/30">
                                    <i class="fas fa-id-card text-4xl mb-3 block"></i>
                                    Belum ada data layanan publik.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
