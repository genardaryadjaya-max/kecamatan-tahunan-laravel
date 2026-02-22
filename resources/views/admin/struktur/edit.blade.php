@extends('layouts.admin')
@section('title', 'Edit Anggota Struktur')
@section('content')
<div class="container-fluid px-4 py-8">
    <div class="max-w-2xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl p-6 shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-white">Edit: {{ $struktur->name }}</h1>
            <a href="{{ route('admin.struktur.index') }}" class="text-white/60 hover:text-white transition-colors text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500/30 rounded-lg text-red-300 text-sm">
                <ul class="list-disc ml-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.struktur.update', $struktur) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/70 mb-1 font-medium">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', $struktur->name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:border-gold/50 outline-none">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1 font-medium">Jabatan *</label>
                    <select name="position" required
                        class="w-full bg-[#1e281e] border border-white/10 rounded-lg px-4 py-2 text-white outline-none">
                        <option value="">— Pilih Jabatan —</option>
                        <option value="Camat" {{ old('position', $struktur->position) == 'Camat' ? 'selected' : '' }}>Camat</option>
                        <option value="Sekretaris Camat" {{ old('position', $struktur->position) == 'Sekretaris Camat' ? 'selected' : '' }}>Sekretaris Camat</option>
                        <option value="Kepala Sub Bagian Umum dan Kepegawaian" {{ old('position', $struktur->position) == 'Kepala Sub Bagian Umum dan Kepegawaian' ? 'selected' : '' }}>Kepala Sub Bagian Umum & Kepegawaian</option>
                        <option value="Kepala Sub Bagian Perencanaan dan Keuangan" {{ old('position', $struktur->position) == 'Kepala Sub Bagian Perencanaan dan Keuangan' ? 'selected' : '' }}>Kepala Sub Bagian Perencanaan & Keuangan</option>
                        <option value="Kepala Seksi Tata Kepemerintahan" {{ old('position', $struktur->position) == 'Kepala Seksi Tata Kepemerintahan' ? 'selected' : '' }}>Kepala Seksi Tata Kepemerintahan</option>
                        <option value="Kepala Seksi Ketentraman, Ketertiban Umum dan Pengamanan Pantai" {{ old('position', $struktur->position) == 'Kepala Seksi Ketentraman, Ketertiban Umum dan Pengamanan Pantai' ? 'selected' : '' }}>Kepala Seksi Ketentraman & Ketertiban Umum</option>
                        <option value="Kepala Seksi Pemberdayaan Masyarakat Desa dan Perekonomian" {{ old('position', $struktur->position) == 'Kepala Seksi Pemberdayaan Masyarakat Desa dan Perekonomian' ? 'selected' : '' }}>Kepala Seksi Pemberdayaan Masyarakat Desa</option>
                        <option value="Kepala Seksi Sosial dan Lingkungan Hidup" {{ old('position', $struktur->position) == 'Kepala Seksi Sosial dan Lingkungan Hidup' ? 'selected' : '' }}>Kepala Seksi Sosial & Lingkungan Hidup</option>
                        <option value="Kepala Seksi Pelayanan Umum" {{ old('position', $struktur->position) == 'Kepala Seksi Pelayanan Umum' ? 'selected' : '' }}>Kepala Seksi Pelayanan Umum</option>
                        <option value="Jabatan Fungsional" {{ old('position', $struktur->position) == 'Jabatan Fungsional' ? 'selected' : '' }}>Jabatan Fungsional</option>
                        <option value="Staf" {{ old('position', $struktur->position) == 'Staf' ? 'selected' : '' }}>Staf</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1 font-medium">NIP (Opsional)</label>
                    <input type="text" name="nip" value="{{ old('nip', $struktur->nip) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:border-gold/50 outline-none">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1 font-medium">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $struktur->order) }}" min="1"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:border-gold/50 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm text-white/70 mb-1 font-medium">Atasan / Parent (kosongkan jika puncak)</label>
                <select name="parent_id" class="w-full bg-[#1e281e] border border-white/10 rounded-lg px-4 py-2 text-white outline-none">
                    <option value="">— Tidak ada (Puncak Hierarki) —</option>
                    @foreach($parents as $p)
                        <option value="{{ $p->id }}" {{ old('parent_id', $struktur->parent_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->name }} — {{ $p->position }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-white/70 mb-1 font-medium">Deskripsi (Opsional)</label>
                <textarea name="description" rows="3"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:border-gold/50 outline-none">{{ old('description', $struktur->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm text-white/70 mb-1 font-medium">Foto (Opsional)</label>
                @if($struktur->photo)
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ asset('storage/'.$struktur->photo) }}" class="h-16 w-16 rounded-full object-cover border border-white/10">
                        <span class="text-xs text-white/40">Foto saat ini</span>
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:bg-gold file:text-forest">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $struktur->is_active) ? 'checked' : '' }}
                    class="w-4 h-4 accent-gold">
                <label for="is_active" class="text-sm text-white/70">Tampilkan di halaman publik</label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-white/5">
                <a href="{{ route('admin.struktur.index') }}"
                    class="px-5 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors text-sm">Batal</a>
                <button type="submit"
                    class="px-5 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow text-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
