@extends('layouts.app')

@section('content')

    <!-- Page Header -->
    <section class="parallax-section h-[50vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');">
        </div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white text-glow mb-3" data-aos="fade-up">
                Unduhan Dokumen
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Download dokumen dan formulir penting
            </p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(isset($unduhans) && $unduhans->count() > 0)
                <div class="space-y-10">
                    @foreach($unduhans as $category => $items)
                        <div data-aos="fade-up">
                            <!-- Category Header -->
                            <div class="flex items-center mb-6">
                                <div class="section-line"></div>
                                <h2 class="text-2xl md:text-3xl font-display font-bold text-white ml-4 capitalize">
                                    {{ str_replace('_', ' ', $category) }}
                                </h2>
                            </div>

                            <!-- Download Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($items as $file)
                                    <div class="glass-card rounded-xl p-5 hover:border-gold/30 transition-all group">
                                        <div class="flex items-start gap-4">
                                            <!-- File Icon -->
                                            <div
                                                class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-gold/20 to-forest-accent/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                @php
                                                    $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                    $iconClass = 'fas fa-file';
                                                    $iconColor = 'text-white/50';

                                                    if ($extension == 'pdf') {
                                                        $iconClass = 'far fa-file-pdf';
                                                        $iconColor = 'text-red-400';
                                                    } elseif (in_array($extension, ['doc', 'docx'])) {
                                                        $iconClass = 'far fa-file-word';
                                                        $iconColor = 'text-blue-400';
                                                    } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                        $iconClass = 'far fa-file-excel';
                                                        $iconColor = 'text-green-400';
                                                    } elseif (in_array($extension, ['zip', 'rar'])) {
                                                        $iconClass = 'far fa-file-archive';
                                                        $iconColor = 'text-yellow-400';
                                                    }
                                                @endphp
                                                <i class="{{ $iconClass }} text-2xl {{ $iconColor }}"></i>
                                            </div>

                                            <!-- File Info -->
                                            <div class="flex-1 min-w-0">
                                                <h3
                                                    class="text-white font-semibold mb-1 line-clamp-2 group-hover:text-gold transition-colors">
                                                    {{ $file->title }}
                                                </h3>
                                                @if($file->description)
                                                    <p class="text-sm text-white/40 mb-2 line-clamp-1">{{ $file->description }}</p>
                                                @endif
                                                <div class="flex items-center gap-3 text-xs text-white/30">
                                                    @if($file->file_size)
                                                        <span class="flex items-center"><i class="fas fa-hdd mr-1"></i>
                                                            {{ $file->file_size }}</span>
                                                    @endif
                                                    <span class="flex items-center"><i class="far fa-calendar mr-1"></i>
                                                        {{ $file->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>

                                            <!-- Download Button -->
                                            <div class="flex-shrink-0">
                                                <a href="{{ $file->download_url }}" download
                                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gold/20 hover:bg-gold text-gold hover:text-forest transition-all group-hover:scale-110">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="glass-card rounded-2xl p-12 inline-block" data-aos="zoom-in">
                        <i class="fas fa-folder-open text-6xl text-white/10 mb-4"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Dokumen</h3>
                        <p class="text-white/40 max-w-md mx-auto">
                            Dokumen unduhan belum tersedia. Silakan cek kembali nanti atau hubungi administrator.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Info Section -->
            @if(isset($unduhans) && $unduhans->count() > 0)
                <div class="mt-12 glass-card rounded-xl p-6" data-aos="fade-up">
                    <div class="flex items-start gap-4">
                        <i class="fas fa-info-circle text-2xl text-gold/60 mt-1"></i>
                        <div>
                            <h3 class="text-white font-semibold mb-2">Informasi Penting</h3>
                            <ul class="text-sm text-white/60 space-y-1">
                                <li>• Pastikan koneksi internet stabil sebelum mengunduh</li>
                                <li>• Gunakan aplikasi reader yang sesuai untuk membuka file</li>
                                <li>• Jika mengalami kesulitan, hubungi layanan informasi publik</li>
                                <li>• Dokumen ini sah dan resmi dari Kecamatan Tahunan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- CTA Section -->
    <section class="parallax-section py-16" data-aos="fade-up">
        <div class="parallax-bg" data-speed="0.15"
            style="background-image: url('{{ asset('images/29251003_city-walk.webp') }}');"></div>
        <div class="parallax-overlay bg-gradient-to-r from-forest/90 to-black/80"></div>
        <div class="parallax-content max-w-4xl mx-auto text-center px-6">
            <div class="section-line mx-auto mb-4"></div>
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4 text-glow">
                Butuh Bantuan?
            </h2>
            <p class="text-lg text-white/60 mb-6">
                Jika Anda tidak menemukan dokumen yang dicari atau memerlukan bantuan teknis, jangan ragu menghubungi kami
            </p>
            <a href="{{ route('kontak') }}"
                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-gold to-gold-dark text-forest font-bold rounded-xl hover:shadow-lg hover:shadow-gold/30 transition-all">
                <i class="fas fa-envelope mr-2"></i> Hubungi Kami
            </a>
        </div>
    </section>

@endsection