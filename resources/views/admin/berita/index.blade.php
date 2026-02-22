@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
    <div class="container-fluid px-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-white">Kelola Berita & Pengumuman</h1>
            <div class="flex gap-2">
                <button onclick="scrapeBerita()"
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white font-bold rounded-lg transition-colors border border-white/20 flex items-center gap-2">
                    <i class="fas fa-link"></i>Scrape dari URL
                </button>
                <a href="{{ route('admin.berita.create') }}"
                    class="px-4 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>Tambah Berita
                </a>
            </div>
        </div>

        <div class="bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-white/5">
                <h6 class="m-0 font-bold text-white">Daftar Berita ({{ $beritas->total() }})</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-white/70">
                    <thead class="bg-white/5 text-xs uppercase font-medium text-white/50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($beritas as $index => $berita)
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-4">{{ $beritas->firstItem() + $index }}</td>
                                            <td class="px-6 py-4">
                                                @if($berita->image)
                                                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}"
                                                        class="h-12 w-16 object-cover rounded">
                                                @else
                                                    <div
                                                        class="h-12 w-16 bg-white/10 rounded flex items-center justify-center text-xs text-white/30">
                                                        No Img</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 font-medium text-white">{{ Str::limit($berita->title, 40) }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold 
                                                        {{ $berita->category == 'pengumuman' ? 'bg-red-500/10 text-red-400' :
                            ($berita->category == 'kegiatan' ? 'bg-green-500/10 text-green-400' : 'bg-blue-500/10 text-blue-400') }}">
                                                    {{ ucfirst($berita->category) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-xs font-mono">{{ $berita->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-bold {{ $berita->is_published ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-500' }}">
                                                    {{ $berita->is_published ? 'PUBLISH' : 'DRAFT' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="{{ route('admin.berita.edit', $berita) }}"
                                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-gold/10 text-gold hover:bg-gold hover:text-forest transition-all" title="Edit">
                                                        <i class="fas fa-edit text-xs"></i>
                                                    </a>
                                                    <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST"
                                                        onsubmit="return confirm('Hapus berita ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all"
                                                            title="Hapus"><i class="fas fa-trash text-xs"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-white/30">
                                    <i class="fas fa-newspaper text-4xl mb-3 block"></i>
                                    Belum ada berita.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($beritas->hasPages())
                <div class="p-4 border-t border-white/5">
                    {{ $beritas->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Scrape Script -->
    <script>
        function scrapeBerita() {
            const url = prompt("Masukkan URL berita yang ingin di-scrape:\nContoh: https://www.detik.com/...");
            if (url && url.trim() !== "") {
                if (url.startsWith('http://') || url.startsWith('https://')) {
                    // Tampilkan indikasi loading jika diperlukan (opsional, karena redirect akan reload page)
                    document.body.style.cursor = 'wait';
                    window.location.href = "{{ route('admin.berita.scrape') }}?url=" + encodeURIComponent(url.trim());
                } else {
                    alert("URL harus diawali dengan http:// atau https://");
                }
            }
        }
    </script>
@endsection