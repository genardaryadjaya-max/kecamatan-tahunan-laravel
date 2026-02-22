@extends('layouts.admin')

@section('title', isset($statistik) ? 'Edit Statistik' : 'Tambah Statistik')

@section('content')
    <div class="container-fluid px-4 py-8">
        <div class="max-w-4xl mx-auto bg-[#1e281e]/60 border border-white/5 rounded-xl overflow-hidden shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">{{ isset($statistik) ? 'Edit' : 'Tambah' }} Statistik</h1>
                <a href="{{ route('admin.statistik.index') }}" class="text-white/60 hover:text-white transition-colors"><i
                        class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>

            <form
                action="{{ isset($statistik) ? route('admin.statistik.update', $statistik) : route('admin.statistik.store') }}"
                method="POST" class="space-y-6">
                @csrf
                @if(isset($statistik)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Kategori *</label>
                        <select name="category" required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('category') border-red-500 @enderror">
                            <option value="" class="bg-[#1e281e]">Pilih Kategori</option>
                            @foreach(['penduduk' => 'Penduduk', 'pertanian' => 'Pertanian', 'kesehatan' => 'Kesehatan', 'pendidikan' => 'Pendidikan', 'ekonomi' => 'Ekonomi', 'infrastruktur' => 'Infrastruktur'] as $val => $label)
                                <option value="{{ $val }}" class="bg-[#1e281e]" {{ old('category', $statistik->category ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Year -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Tahun Data *</label>
                        <input type="number" name="year" value="{{ old('year', $statistik->year ?? date('Y')) }}" min="2000"
                            max="2100" required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('year') border-red-500 @enderror">
                        @error('year') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Label -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1">Label Statistik *</label>
                    <input type="text" name="label" value="{{ old('label', $statistik->label ?? '') }}"
                        placeholder="Contoh: Total Penduduk" required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('label') border-red-500 @enderror">
                    @error('label') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Value -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Nilai *</label>
                        <input type="text" name="value" value="{{ old('value', $statistik->value ?? '') }}"
                            placeholder="Contoh: 25,430" required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors @error('value') border-red-500 @enderror">
                        <p class="text-xs text-white/40 mt-1">Bisa angka atau teks (contoh: 25,430 atau 95%)</p>
                        @error('value') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Unit -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Satuan (Opsional)</label>
                        <input type="text" name="unit" value="{{ old('unit', $statistik->unit ?? '') }}"
                            placeholder="Jiwa/Ha/Unit"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Icon FontAwesome</label>
                        <input type="text" name="icon" value="{{ old('icon', $statistik->icon ?? '') }}"
                            placeholder="fas fa-users"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                        <p class="text-xs text-white/40 mt-1">Lihat <a href="https://fontawesome.com/v5/search"
                                target="_blank" class="text-gold hover:underline">FontAwesome 5</a></p>
                    </div>

                    <!-- Order -->
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1">Urutan Tampil</label>
                        <input type="number" name="order" value="{{ old('order', $statistik->order ?? 0) }}" min="0"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold/50 transition-colors">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-white/5">
                    <a href="{{ route('admin.statistik.index') }}"
                        class="px-6 py-2 rounded-lg border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-gold hover:bg-gold-dark text-forest font-bold rounded-lg transition-colors shadow-lg shadow-gold/20">
                        {{ isset($statistik) ? 'Update Statistik' : 'Simpan Statistik' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection