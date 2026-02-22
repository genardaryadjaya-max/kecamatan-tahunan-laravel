@extends('layouts.admin')

@section('title', 'Agenda Kegiatan')

@section('content')
    <div class="container-fluid px-4 py-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center mb-6">
            <h1 class="h3 mb-0 text-white font-bold">Agenda Kegiatan</h1>
            <a href="{{ route('admin.agenda.create') }}"
                class="px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg">
                <i class="fas fa-plus me-2"></i>Tambah Agenda
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
                <h6 class="m-0 font-bold text-white">Daftar Agenda Kegiatan</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Tanggal & Waktu</th>
                            <th class="px-6 py-3">Judul Agenda</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3 text-center">Tautan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($agendas as $index => $agenda)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-mono text-xs">
                                    <div class="text-white">{{ $agenda->date_time->format('d M Y') }}</div>
                                    <div class="text-gold">{{ $agenda->date_time->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-white">{{ $agenda->title }}</td>
                                <td class="px-6 py-4">{{ $agenda->location ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($agenda->link)
                                        <a href="{{ $agenda->link }}" target="_blank" class="text-gold hover:text-white transition-colors"><i class="fas fa-external-link-alt"></i></a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $agenda->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                        {{ $agenda->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.agenda.edit', $agenda) }}" class="text-gold hover:text-white transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus agenda ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-white/30">
                                    <i class="fas fa-calendar-alt text-4xl mb-3 block"></i>
                                    Belum ada data agenda kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
