@extends('layouts.admin')
@section('title', 'Kelola Statistik')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white font-display">Kelola Statistik Kecamatan</h1>
                <p class="text-white/40 text-sm mt-1">Data statistik yang tampil di halaman publik</p>
            </div>
            <a href="{{ route('admin.statistik.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-gold hover:bg-gold-dark text-forest font-bold rounded-xl transition-colors shadow-lg shadow-gold/20 whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Tambah Statistik
            </a>
        </div>

        {{-- Stats Overview --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $totalStat = $statistiks->total();
                $years = \App\Models\Statistik::selectRaw('DISTINCT year')->pluck('year');
                $categories = \App\Models\Statistik::selectRaw('DISTINCT category')->pluck('category');
            @endphp
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-white">{{ $totalStat }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Total Data</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-blue-400">{{ $years->count() }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Tahun</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-gold">{{ $categories->count() }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Kategori</div>
            </div>
            <div class="admin-card p-4 text-center">
                <div class="text-2xl font-bold text-green-400">{{ $years->first() ?? '-' }}</div>
                <div class="text-xs text-white/40 mt-1 uppercase tracking-wider">Tahun Terbaru</div>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-card overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h6 class="font-bold text-white">Daftar Statistik
                    <span class="ml-2 text-xs bg-white/10 text-white/60 px-2 py-0.5 rounded-full">{{ $statistiks->total() }}
                        data</span>
                </h6>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3 w-12">No</th>
                            <th class="px-6 py-3 w-20">Tahun</th>
                            <th class="px-6 py-3 w-32">Kategori</th>
                            <th class="px-6 py-3">Label</th>
                            <th class="px-6 py-3 w-28">Nilai</th>
                            <th class="px-6 py-3 w-28">Icon</th>
                            <th class="px-6 py-3 text-center w-16">Urut</th>
                            <th class="px-6 py-3 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($statistiks as $i => $stat)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-white/40 font-mono text-xs">{{ $statistiks->firstItem() + $i }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2.5 py-1 bg-white/10 text-white/70 rounded-full text-xs font-mono font-bold">{{ $stat->year }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $catColors = [
                                            'penduduk' => 'bg-blue-500/15 text-blue-400 border-blue-500/20',
                                            'pertanian' => 'bg-green-500/15 text-green-400 border-green-500/20',
                                            'kesehatan' => 'bg-red-500/15 text-red-400 border-red-500/20',
                                            'pendidikan' => 'bg-yellow-500/15 text-yellow-400 border-yellow-500/20',
                                            'ekonomi' => 'bg-orange-500/15 text-orange-400 border-orange-500/20',
                                            'infrastruktur' => 'bg-purple-500/15 text-purple-400 border-purple-500/20',
                                        ];
                                        $cc = $catColors[$stat->category] ?? 'bg-white/10 text-white/50 border-white/20';
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $cc }}">
                                        {{ ucfirst($stat->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-white">{{ $stat->label }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gold">{{ $stat->value }}</span>
                                    @if($stat->unit)
                                        <span class="text-xs text-white/40 ml-1">{{ $stat->unit }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($stat->icon)
                                        <div class="flex items-center gap-2">
                                            <i class="{{ $stat->icon }} text-gold text-sm"></i>
                                            <code class="text-xs text-white/30 bg-white/5 px-1 rounded">{{ $stat->icon }}</code>
                                        </div>
                                    @else
                                        <span class="text-white/20">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs text-white/50 font-mono">{{ $stat->order ?? 0 }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.statistik.edit', $stat) }}"
                                            class="h-8 w-8 flex items-center justify-center bg-gold/10 hover:bg-gold text-gold hover:text-forest rounded-lg transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.statistik.destroy', $stat) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf @method('DELETE')
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
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <i class="fas fa-chart-bar text-4xl text-white/10 mb-4 block"></i>
                                    <p class="text-white/30 text-sm">Belum ada data statistik</p>
                                    <a href="{{ route('admin.statistik.create') }}"
                                        class="inline-flex items-center mt-4 px-4 py-2 bg-gold/10 hover:bg-gold text-gold hover:text-forest rounded-lg transition-colors text-sm font-semibold">
                                        <i class="fas fa-plus mr-2"></i> Tambah Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($statistiks->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $statistiks->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection