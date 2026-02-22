@extends('layouts.admin')

@section('title', 'Kelola Potensi')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white font-display">Kelola Potensi Daerah</h1>
                <p class="text-white/40 text-sm mt-1">Tambah, edit, atau hapus data potensi kecamatan</p>
            </div>
            <a href="{{ route('admin.potensi.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-gold hover:bg-gold-dark text-forest font-bold rounded-xl transition-colors shadow-lg shadow-gold/20 whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Tambah Potensi
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $totalPotensi = $potensis->total();
                $activeCount = \App\Models\Potensi::where('is_active', true)->count();
                $categories = \App\Models\Potensi::distinct()->pluck('category');
            @endphp
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-white">{{ $totalPotensi }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Total Data</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-green-400">{{ $activeCount }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Aktif</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-yellow-400">{{ $totalPotensi - $activeCount }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Nonaktif</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-blue-400">{{ $categories->count() }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Kategori</div>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="admin-card overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h6 class="font-bold text-white">Daftar Potensi
                    <span class="ml-2 text-xs bg-white/10 text-white/60 px-2 py-0.5 rounded-full">{{ $potensis->total() }} data</span>
                </h6>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3 w-12">No</th>
                            <th class="px-6 py-3 w-20">Gambar</th>
                            <th class="px-6 py-3">Nama Potensi</th>
                            <th class="px-6 py-3 w-36">Kategori</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3 text-center w-24">Status</th>
                            <th class="px-6 py-3 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($potensis as $index => $potensi)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-white/40 font-mono text-xs">
                                    {{ $potensis->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($potensi->image)
                                        <img src="{{ asset('storage/' . $potensi->image) }}"
                                            alt="{{ $potensi->name }}"
                                            class="h-12 w-16 object-cover rounded-lg border border-white/10">
                                    @else
                                        <div class="h-12 w-16 bg-white/10 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-white/30"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $potensi->name }}</div>
                                    <div class="text-xs text-white/40 mt-0.5">{{ Str::limit($potensi->description, 55) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $categoryColors = [
                                            'pertanian'  => 'bg-green-500/15 text-green-400 border-green-500/20',
                                            'industri'   => 'bg-yellow-500/15 text-yellow-400 border-yellow-500/20',
                                            'wisata'     => 'bg-blue-500/15 text-blue-400 border-blue-500/20',
                                            'peternakan' => 'bg-purple-500/15 text-purple-400 border-purple-500/20',
                                            'seni budaya' => 'bg-pink-500/15 text-pink-400 border-pink-500/20',
                                            'seni_budaya' => 'bg-pink-500/15 text-pink-400 border-pink-500/20',
                                            'kuliner'    => 'bg-orange-500/15 text-orange-400 border-orange-500/20',
                                        ];
                                        $categoryLabels = [
                                            'pertanian'  => 'Pertanian',
                                            'industri'   => 'Industri & Kerajinan',
                                            'wisata'     => 'Wisata',
                                            'peternakan' => 'Peternakan',
                                            'seni budaya' => 'Seni Budaya',
                                            'seni_budaya' => 'Seni Budaya',
                                            'kuliner'    => 'Kuliner',
                                        ];
                                        $colorClass = $categoryColors[$potensi->category] ?? 'bg-white/10 text-white/60 border-white/20';
                                        $label = $categoryLabels[$potensi->category] ?? ucfirst($potensi->category);
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $colorClass }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($potensi->location)
                                        <div class="flex items-center gap-1.5 text-white/60">
                                            <i class="fas fa-map-marker-alt text-gold/70 text-xs"></i>
                                            <span>{{ Str::limit($potensi->location, 30) }}</span>
                                        </div>
                                    @else
                                        <span class="text-white/20">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($potensi->is_active)
                                        <span class="px-2.5 py-1 bg-green-500/15 text-green-400 border border-green-500/20 rounded-full text-xs font-semibold">Aktif</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-yellow-500/15 text-yellow-400 border border-yellow-500/20 rounded-full text-xs font-semibold" title="Menunggu persetujuan admin">Pending Validasi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.potensi.edit', $potensi) }}"
                                            class="h-8 w-8 flex items-center justify-center bg-gold/10 hover:bg-gold text-gold hover:text-forest rounded-lg transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <a href="{{ route('potensi.show', $potensi->slug) }}"
                                            class="h-8 w-8 flex items-center justify-center bg-blue-500/10 hover:bg-blue-500 text-blue-400 hover:text-white rounded-lg transition-colors"
                                            title="Lihat" target="_blank">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.potensi.destroy', $potensi) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus potensi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="h-8 w-8 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white rounded-lg transition-colors"
                                                title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <i class="fas fa-gem text-4xl text-white/10 mb-4 block"></i>
                                    <p class="text-white/30 text-sm">Belum ada data potensi</p>
                                    <a href="{{ route('admin.potensi.create') }}"
                                        class="inline-flex items-center mt-4 px-4 py-2 bg-gold/10 hover:bg-gold text-gold hover:text-forest rounded-lg transition-colors text-sm font-semibold">
                                        <i class="fas fa-plus mr-2"></i> Tambah Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($potensis->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $potensis->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection