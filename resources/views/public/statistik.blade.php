@extends('layouts.app')

@section('content')

    {{-- Page Header --}}
    <section class="parallax-section h-[40vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');"></div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white text-glow mb-3" data-aos="fade-up">
                Statistik Kecamatan
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Data & Informasi Kecamatan Tahunan</p>
            <div class="mt-4" data-aos="fade-up" data-aos-delay="200">
                <span class="px-4 py-2 bg-gold/20 border border-gold/40 rounded-full text-gold-light font-semibold text-sm">
                    <i class="far fa-calendar mr-2"></i>Tahun {{ $currentYear }}
                </span>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($statistiks->count() > 0)

                @php
                    $categoryColors = [
                        'Penduduk'  => ['bar' => 'rgba(59,130,246,0.8)',  'border' => 'rgba(59,130,246,1)',  'accent' => 'text-blue-400'],
                        'Pendidikan'=> ['bar' => 'rgba(168,85,247,0.8)',  'border' => 'rgba(168,85,247,1)',  'accent' => 'text-purple-400'],
                        'Kesehatan' => ['bar' => 'rgba(34,197,94,0.8)',   'border' => 'rgba(34,197,94,1)',   'accent' => 'text-green-400'],
                        'Ekonomi'   => ['bar' => 'rgba(249,115,22,0.8)',  'border' => 'rgba(249,115,22,1)',  'accent' => 'text-orange-400'],
                    ];
                    $defaultColor = ['bar' => 'rgba(201,168,76,0.8)', 'border' => 'rgba(201,168,76,1)', 'accent' => 'text-gold'];
                    $chartIndex = 0;
                @endphp

                <div class="space-y-14">
                    @foreach($statistiks as $category => $items)
                        @php
                            $color = $categoryColors[$category] ?? $defaultColor;
                            $chartId = 'chart_' . $chartIndex++;
                        @endphp

                        <div data-aos="fade-up">
                            {{-- Category Header --}}
                            <div class="flex items-center mb-6">
                                <div class="section-line"></div>
                                <h2 class="text-2xl md:text-3xl font-display font-bold ml-4 capitalize {{ $color['accent'] }}">
                                    <i class="fas fa-chart-bar mr-2 opacity-60"></i>
                                    {{ str_replace('_', ' ', $category) }}
                                </h2>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                {{-- Stat Cards --}}
                                <div class="grid grid-cols-2 gap-3 content-start">
                                    @foreach($items as $stat)
                                        <div class="glass-card rounded-xl p-4 flex flex-col justify-between">
                                            <div class="flex items-center gap-2 mb-2">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: {{ str_replace('0.8', '0.15', $color['bar']) }}">
                                                    @if($stat->icon)
                                                        <i class="fas fa-{{ $stat->icon }} text-sm {{ $color['accent'] }}"></i>
                                                    @else
                                                        <i class="fas fa-chart-simple text-sm {{ $color['accent'] }}"></i>
                                                    @endif
                                                </div>
                                                <span class="text-xs text-white/50 leading-tight">{{ $stat->label }}</span>
                                            </div>
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-2xl font-extrabold text-white">{{ $stat->formatted_value }}</span>
                                                @if($stat->unit)
                                                    <span class="text-xs {{ $color['accent'] }} font-medium">{{ $stat->unit }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Charts Column --}}
                                <div class="flex flex-col gap-4">
                                    {{-- Bar Chart --}}
                                    <div class="glass-card rounded-xl p-5">
                                        <h3 class="text-xs font-semibold text-white/50 mb-3 uppercase tracking-wider flex items-center gap-1">
                                            <i class="fas fa-chart-bar {{ $color['accent'] }}"></i> Grafik Batang
                                        </h3>
                                        <div class="relative h-48">
                                            <canvas id="{{ $chartId }}_bar"></canvas>
                                        </div>
                                    </div>
                                    {{-- Doughnut Chart --}}
                                    <div class="glass-card rounded-xl p-5">
                                        <h3 class="text-xs font-semibold text-white/50 mb-3 uppercase tracking-wider flex items-center gap-1">
                                            <i class="fas fa-chart-pie {{ $color['accent'] }}"></i> Diagram Lingkaran
                                        </h3>
                                        <div class="flex items-center gap-4">
                                            <div class="relative h-44 w-44 flex-shrink-0">
                                                <canvas id="{{ $chartId }}_donut"></canvas>
                                            </div>
                                            {{-- Legend --}}
                                            <div class="flex flex-col gap-1.5 text-xs flex-1 min-w-0">
                                                @foreach($items as $si => $stat)
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" id="{{ $chartId }}_legend_{{ $si }}"></span>
                                                        <span class="text-white/60 truncate">{{ $stat->label }}</span>
                                                        <span class="ml-auto text-white/80 font-semibold flex-shrink-0">{{ $stat->formatted_value }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Chart Scripts --}}
                            @push('scripts')
                            <script>
                            (function() {
                                const labels  = {!! json_encode($items->pluck('label')->toArray()) !!};
                                const values  = {!! json_encode($items->pluck('value')->map(fn($v) => (float) str_replace(['.', ','], ['', '.'], $v))->toArray()) !!};
                                // Multi-color palette — each item gets a distinct color
                                const palette = [
                                    'rgba(59,130,246,0.85)',   // blue
                                    'rgba(249,115,22,0.85)',   // orange
                                    'rgba(168,85,247,0.85)',   // purple
                                    'rgba(34,197,94,0.85)',    // green
                                    'rgba(239,68,68,0.85)',    // red
                                    'rgba(234,179,8,0.85)',    // yellow
                                    'rgba(20,184,166,0.85)',   // teal
                                    'rgba(236,72,153,0.85)',   // pink
                                ];
                                const paletteBorder = palette.map(c => c.replace('0.85', '1'));
                                const colors = palette.slice(0, labels.length);
                                const borderColors = paletteBorder.slice(0, labels.length);

                                // Bar Chart — setiap batang warna berbeda
                                const barCtx = document.getElementById('{{ $chartId }}_bar');
                                if (barCtx) {
                                    new Chart(barCtx, {
                                        type: 'bar',
                                        data: {
                                            labels,
                                            datasets: [{
                                                data: values,
                                                backgroundColor: colors,
                                                borderColor: borderColors,
                                                borderWidth: 2,
                                                borderRadius: 6,
                                            }]
                                        },
                                        options: {
                                            responsive: true, maintainAspectRatio: false,
                                            plugins: { legend: { display: false },
                                                tooltip: { callbacks: { label: c => ' ' + c.parsed.y.toLocaleString('id-ID') } }
                                             },
                                            scales: {
                                                x: { ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 9 }, maxRotation: 30 }, grid: { color: 'rgba(255,255,255,0.04)' } },
                                                y: { ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 9 }, callback: v => v >= 1000 ? (v/1000).toFixed(0)+'K' : v }, grid: { color: 'rgba(255,255,255,0.04)' } }
                                            }
                                        }
                                    });
                                }

                                // Doughnut Chart — setiap slice warna berbeda
                                const donutCtx = document.getElementById('{{ $chartId }}_donut');
                                if (donutCtx) {
                                    new Chart(donutCtx, {
                                        type: 'doughnut',
                                        data: {
                                            labels,
                                            datasets: [{
                                                data: values,
                                                backgroundColor: colors,
                                                borderColor: 'rgba(0,0,0,0.25)',
                                                borderWidth: 2,
                                                hoverOffset: 8,
                                            }]
                                        },
                                        options: {
                                            responsive: true, maintainAspectRatio: false,
                                            cutout: '60%',
                                            plugins: {
                                                legend: { display: false },
                                                tooltip: { callbacks: { label: c => ' ' + c.label + ': ' + c.parsed.toLocaleString('id-ID') } }
                                            }
                                        }
                                    });
                                    // Color legend dots
                                    @foreach($items as $si => $stat)
                                    const dot{{ $si }} = document.getElementById('{{ $chartId }}_legend_{{ $si }}');
                                    if (dot{{ $si }}) dot{{ $si }}.style.background = colors[{{ $si }}] || colors[0];
                                    @endforeach
                                }
                            })();
                            </script>
                            @endpush
                        </div>
                    @endforeach
                </div>

                {{-- Year Selector --}}
                @if($availableYears->count() > 1)
                    <div class="mt-12 glass-card rounded-xl p-6" data-aos="fade-up">
                        <h3 class="text-white font-semibold mb-4 flex items-center">
                            <i class="far fa-calendar-alt mr-2 text-gold"></i>Pilih Tahun
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($availableYears as $year)
                                <a href="{{ route('statistik', ['year' => $year]) }}"
                                    class="px-4 py-2 rounded-lg font-medium transition-all {{ $year == $currentYear ? 'bg-gold text-forest' : 'bg-white/5 text-white/60 hover:bg-white/10' }}">
                                    {{ $year }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            @else
                <div class="text-center py-16">
                    <div class="glass-card rounded-2xl p-12 inline-block">
                        <i class="fas fa-chart-pie text-6xl text-white/10 mb-4 block"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Data Belum Tersedia</h3>
                        <p class="text-white/40">Data statistik untuk tahun {{ $currentYear }} belum tersedia.</p>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush