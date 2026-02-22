@extends('layouts.admin')

@section('title', 'Website Desa')

@section('content')
    <div class="container-fluid px-4 py-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center mb-6">
            <h1 class="h3 mb-0 text-white font-bold">Website Desa</h1>
            <a href="{{ route('admin.desa.create') }}"
                class="px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg">
                <i class="fas fa-plus me-2"></i>Tambah Desa
            </a>
        </div>

        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-white/5">
                <h6 class="m-0 font-bold text-white">Daftar Desa ({{ $desas->total() }})</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Logo</th>
                            <th class="px-6 py-3">Nama Desa</th>
                            <th class="px-6 py-3">Kepala Desa</th>
                            <th class="px-6 py-3">Kontak</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($desas as $index => $desa)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">{{ $desas->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    @if($desa->logo)
                                        <div class="h-10 w-10 bg-white rounded-full p-1">
                                            <img src="{{ asset('storage/' . $desa->logo) }}" alt="{{ $desa->name }}"
                                                class="h-full w-full object-contain rounded-full">
                                        </div>
                                    @else
                                        <div
                                            class="h-10 w-10 bg-white/10 rounded-full flex items-center justify-center text-xs text-white/30">
                                            <i class="fas fa-home"></i></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-white">
                                    {{ $desa->name }}
                                    @if($desa->website_url)
                                        <a href="{{ $desa->website_url }}" target="_blank"
                                            class="text-gold hover:text-white ml-2 text-xs"><i
                                                class="fas fa-external-link-alt"></i></a>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $desa->kepala_desa ?? '-' }}</td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    @if($desa->phone)
                                    <div class="mb-1"><i class="fas fa-phone mr-1 w-3"></i> {{ $desa->phone }}</div> @endif
                                    @if($desa->email)
                                    <div><i class="fas fa-envelope mr-1 w-3"></i> {{ $desa->email }}</div> @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-bold {{ $desa->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                        {{ $desa->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('admin.desa.edit', $desa) }}"
                                        class="text-gold hover:text-white transition-colors" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.desa.destroy', $desa) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Hapus data desa ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors"
                                            title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-white/30">
                                    <i class="fas fa-home text-4xl mb-3 block"></i>
                                    Belum ada data desa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($desas->hasPages())
                <div class="p-4 border-t border-white/5">
                    {{ $desas->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection