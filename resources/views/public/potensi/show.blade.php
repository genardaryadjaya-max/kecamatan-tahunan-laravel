@extends('layouts.app')

@section('content')

    <!-- Page Header -->
    <section class="parallax-section h-[40vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ $potensi->image_url }}');"></div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            @php
                $categoryLabels = [
                    'pertanian' => 'Pertanian',
                    'industri' => 'Industri & Kerajinan',
                    'wisata' => 'Wisata',
                    'peternakan' => 'Peternakan',
                ];
            @endphp
            <span
                class="inline-block px-4 py-2 bg-green-500/20 border border-green-500/40 rounded-full text-green-400 font-semibold text-sm mb-4"
                data-aos="fade-up">
                <i class="fas fa-leaf mr-2"></i>{{ $categoryLabels[$potensi->category] ?? ucfirst($potensi->category) }}
            </span>
            <h1 class="text-3xl md:text-5xl font-display font-extrabold text-white text-glow mb-3" data-aos="fade-up"
                data-aos-delay="100">
                {{ $potensi->name }}
            </h1>
            @if($potensi->location)
                <p class="text-white/50 text-lg flex items-center justify-center" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-map-marker-alt mr-2"></i>{{ $potensi->location }}
                </p>
            @endif
        </div>
    </section>

    <!-- Content -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Gallery Grid -->
            @if($potensi->gallery && count(json_decode($potensi->gallery, true)) > 0)
                @php
                    $gallery = json_decode($potensi->gallery, true);
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8" data-aos="fade-up">
                    @foreach($gallery as $index => $image)
                        <div class="relative overflow-hidden rounded-xl {{ $index === 0 ? 'col-span-2 row-span-2 h-96' : 'h-44' }} group cursor-pointer"
                            onclick="openGallery({{ $index }})">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $potensi->name }} - {{ $index + 1 }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl"></i>
                            </div>
                        </div>
                        @if($loop->iteration >= 5)
                            @break
                        @endif
                    @endforeach
                    @if(count($gallery) > 5)
                        <div class="relative overflow-hidden rounded-xl h-44 bg-black/50 flex items-center justify-center cursor-pointer"
                            onclick="openGallery(5)">
                            <div class="text-center">
                                <i class="fas fa-images text-white/60 text-3xl mb-2"></i>
                                <p class="text-white font-semibold">+{{ count($gallery) - 5 }} Foto</p>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Single Image -->
                <div class="relative overflow-hidden rounded-2xl h-96 mb-8" data-aos="zoom-in">
                    <img src="{{ $potensi->image_url }}" alt="{{ $potensi->name }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Description -->
                    <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="section-line"></div>
                            <h2 class="text-2xl font-display font-bold text-white">Deskripsi</h2>
                        </div>
                        <div class="prose prose-invert max-w-none">
                            <p class="text-white/70 leading-relaxed whitespace-pre-line">{{ $potensi->description }}</p>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    @if($potensi->contact || $potensi->email || $potensi->website)
                        <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="section-line"></div>
                                <h2 class="text-2xl font-display font-bold text-white">Informasi Kontak</h2>
                            </div>
                            <div class="space-y-3">
                                @if($potensi->contact)
                                    <div class="flex items-center space-x-3 text-white/70">
                                        <i class="fas fa-phone w-5 text-gold"></i>
                                        <a href="tel:{{ $potensi->contact }}"
                                            class="hover:text-gold transition">{{ $potensi->contact }}</a>
                                    </div>
                                @endif
                                @if($potensi->email)
                                    <div class="flex items-center space-x-3 text-white/70">
                                        <i class="fas fa-envelope w-5 text-gold"></i>
                                        <a href="mailto:{{ $potensi->email }}"
                                            class="hover:text-gold transition">{{ $potensi->email }}</a>
                                    </div>
                                @endif
                                @if($potensi->website)
                                    <div class="flex items-center space-x-3 text-white/70">
                                        <i class="fas fa-globe w-5 text-gold"></i>
                                        <a href="{{ $potensi->website }}" target="_blank"
                                            class="hover:text-gold transition break-all">{{ $potensi->website }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- Quick Info -->
                    <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-gold"></i>
                            Informasi Cepat
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center py-2 border-b border-white/5">
                                <span class="text-white/50">Kategori</span>
                                <span
                                    class="text-white font-semibold">{{ $categoryLabels[$potensi->category] ?? ucfirst($potensi->category) }}</span>
                            </div>
                            @if($potensi->location)
                                <div class="flex justify-between items-start py-2 border-b border-white/5">
                                    <span class="text-white/50">Lokasi</span>
                                    <span class="text-white font-semibold text-right">{{ $potensi->location }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between items-center py-2">
                                <span class="text-white/50">Ditambahkan</span>
                                <span class="text-white font-semibold">{{ $potensi->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="glass-card rounded-xl p-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-share-alt mr-2 text-gold"></i>
                            Bagikan
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="flex-1 px-4 py-2.5 bg-blue-600/20 border border-blue-600/40 text-blue-400 rounded-lg text-center text-sm font-medium hover:bg-blue-600/30 transition">
                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($potensi->name) }}"
                                target="_blank"
                                class="flex-1 px-4 py-2.5 bg-sky-500/20 border border-sky-500/40 text-sky-400 rounded-lg text-center text-sm font-medium hover:bg-sky-500/30 transition">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($potensi->name . ' - ' . url()->current()) }}"
                                target="_blank"
                                class="w-full px-4 py-2.5 bg-green-600/20 border border-green-600/40 text-green-400 rounded-lg text-center text-sm font-medium hover:bg-green-600/30 transition">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <a href="{{ route('potensi.index') }}"
                        class="block glass-card rounded-xl p-4 text-center hover:bg-white/10 transition group"
                        data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-arrow-left mr-2 text-gold group-hover:-translate-x-2 transition-transform"></i>
                        <span class="text-white font-semibold">Kembali ke Potensi</span>
                    </a>

                </div>
            </div>

            <!-- Related Potensi -->
            @if($related->count() > 0)
                <div class="mt-16" data-aos="fade-up">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="section-line"></div>
                        <h2 class="text-2xl md:text-3xl font-display font-bold text-white">Potensi Terkait</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($related as $item)
                            <a href="{{ route('potensi.show', $item->slug) }}" class="glass-card rounded-xl overflow-hidden group">
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-green-500/90 text-white text-xs font-bold px-3 py-1 rounded-full">
                                            {{ $categoryLabels[$item->category] ?? ucfirst($item->category) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-white/90 mb-2 group-hover:text-gold transition line-clamp-2">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-sm text-white/40 line-clamp-2 mb-3">{{ Str::limit($item->description, 100) }}</p>
                                    @if($item->location)
                                        <p class="text-xs text-white/30 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2"></i>{{ $item->location }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Gallery Modal (Simple) -->
    <div id="galleryModal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4">
        <button onclick="closeGallery()" class="absolute top-4 right-4 text-white text-4xl hover:text-gold transition">
            <i class="fas fa-times"></i>
        </button>
        <button onclick="prevImage()" class="absolute left-4 text-white text-4xl hover:text-gold transition">
            <i class="fas fa-chevron-left"></i>
        </button>
        <img id="galleryImage" src="" alt="Gallery" class="max-w-full max-h-full object-contain">
        <button onclick="nextImage()" class="absolute right-4 text-white text-4xl hover:text-gold transition">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    @if($potensi->gallery && count(json_decode($potensi->gallery, true)) > 0)
        <script>
            const galleryImages = @json(json_decode($potensi->gallery, true));
            let currentIndex = 0;

            function openGallery(index) {
                currentIndex = index;
                updateGalleryImage();
                document.getElementById('galleryModal').classList.remove('hidden');
                document.getElementById('galleryModal').classList.add('flex');
            }

            function closeGallery() {
                document.getElementById('galleryModal').classList.add('hidden');
                document.getElementById('galleryModal').classList.remove('flex');
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % galleryImages.length;
                updateGalleryImage();
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
                updateGalleryImage();
            }

            function updateGalleryImage() {
                document.getElementById('galleryImage').src = '/storage/' + galleryImages[currentIndex];
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (!document.getElementById('galleryModal').classList.contains('hidden')) {
                    if (e.key === 'ArrowRight') nextImage();
                    if (e.key === 'ArrowLeft') prevImage();
                    if (e.key === 'Escape') closeGallery();
                }
            });
        </script>
    @endif

@endsection