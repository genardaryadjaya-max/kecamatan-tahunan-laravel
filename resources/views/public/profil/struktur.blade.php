@extends('layouts.app')

@section('content')

    <!-- Page Header -->
    <section class="parallax-section h-[40vh] flex items-center justify-center">
        <div class="parallax-bg" data-speed="0.2" style="background-image: url('{{ asset('images/Pedesaan.jpg') }}');"></div>
        <div class="parallax-overlay bg-gradient-to-b from-forest/80 via-black/50 to-[#0a0f0a]"></div>
        <div class="parallax-content text-center px-4">
            <div class="section-line mx-auto mb-4" data-aos="fade-down"></div>
            <h1 class="text-4xl md:text-5xl font-display font-extrabold text-white text-glow mb-2" data-aos="fade-up">
                Struktur Organisasi
            </h1>
            <p class="text-white/50 text-lg" data-aos="fade-up" data-aos-delay="100">Pemerintahan Kecamatan Tahunan</p>
        </div>
    </section>

    <!-- Org Chart Content -->
    <section class="py-16 overflow-x-auto bg-[#0a0f0a]">
        <div class="min-w-[1200px] max-w-[1400px] mx-auto px-6" data-aos="fade-up">

            @if(isset($allStruktur) && $allStruktur->count() > 0)

                @php
                    // MAPPING LOGIC BASED ON POSITION STRING
                    $camat = $allStruktur->first(fn($s) => stripos($s->position, 'camat') !== false && stripos($s->position, 'sekretaris') === false);
                    if (!$camat) {
                        // fallback to absolute top node if position string parsing fails
                        $camat = $allStruktur->firstWhere('parent_id', null);
                    }

                    $camatId = $camat ? $camat->id : -1;
                    $childrenOfCamat = $allStruktur->where('parent_id', $camatId);

                    // Level 2 Left: Jabatan Fungsional
                    $jabfung = $childrenOfCamat->first(fn($s) => stripos($s->position, 'fungsional') !== false);

                    // Level 2 Right: Sekcam
                    $sekcam = $childrenOfCamat->first(fn($s) => stripos($s->position, 'sekretaris') !== false || stripos($s->position, 'sekcam') !== false);

                    // The rest of Camat's children are Kasi (Pemerintahan, Trantib, PMD, Sosial, Pelayanan)
                    $kasiList = $childrenOfCamat->filter(function($s) use ($sekcam, $jabfung) {
                        return $s->id !== ($sekcam->id ?? null) && $s->id !== ($jabfung->id ?? null);
                    })->sortBy('order');

                    // Level 3 (Kasubag under Sekcam)
                    $kasubagList = $sekcam ? $allStruktur->where('parent_id', $sekcam->id)->sortBy('order') : collect();

                    // Map all Stafs (anyone who has no children but serves under Kasi or Kasubag)
                    $stafByParent = $allStruktur->filter(fn($s) => stripos($s->position, 'staf') !== false || ($s->parent_id && !$allStruktur->contains('parent_id', $s->id)))->groupBy('parent_id');
                @endphp

                <style>
                    /* Specialized Government Org Chart Styles */
                    .org-node {
                        background: rgba(30,40,30,0.8);
                        border: 2px solid #c9a84c;
                        border-radius: 8px;
                        padding: 12px;
                        width: 190px;
                        text-align: center;
                        position: relative;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
                        transition: transform 0.2s, box-shadow 0.2s;
                    }
                    .org-node:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 8px 25px rgba(201,168,76,0.3);
                        z-index: 10;
                    }
                    .org-node img {
                        width: 60px; height: 60px;
                        border-radius: 50%;
                        object-fit: cover;
                        border: 2px solid rgba(255,255,255,0.2);
                        margin: 0 auto 10px;
                        background: #1e281e;
                    }
                    .org-node h3 {
                        color: #fff; font-size: 13px; font-weight: 700; line-height: 1.2; text-transform: uppercase;
                    }
                    .org-node p.pos {
                        color: #c9a84c; font-size: 11px; margin-top: 4px; font-weight: 600;
                    }
                    .org-node p.nip {
                        color: rgba(255,255,255,0.4); font-size: 9px; font-family: monospace; margin-top: 2px;
                    }

                    /* Staf Boxes: Rectangular, simpler */
                    .staf-node {
                        background: rgba(40,50,40,0.8);
                        border: 1px solid #7c8f7c;
                        padding: 8px 10px;
                        width: 150px;
                        text-align: left;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        border-radius: 6px;
                    }
                    .staf-node img {
                        width: 32px; height: 32px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;
                    }
                    .staf-node .text { flex-grow: 1; min-width: 0; }
                    .staf-node h4 { color: #fff; font-size: 11px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2; }
                    .staf-node p { color: #aaa; font-size: 9px; line-height: 1.2; }

                    /* Lines */
                    .line-v { width: 2px; background: rgba(201,168,76,0.5); margin: 0 auto; z-index: 0; }
                    .line-h { height: 2px; background: rgba(201,168,76,0.5); z-index: 0; }
                </style>

                @if($camat)
                <div class="flex flex-col items-center relative w-full pt-4">

                    {{-- ── Level 1: CAMAT ── --}}
                    <div class="org-node z-10" style="border-width: 3px;">
                        <img src="{{ $camat->photo_url }}" alt="{{ $camat->name }}">
                        <h3>{{ $camat->name }}</h3>
                        <p class="pos">{{ $camat->position }}</p>
                        @if($camat->nip)<p class="nip">NIP. {{ $camat->nip }}</p>@endif
                    </div>

                    {{-- Trunk down to the main horizontal split (Level 2) --}}
                    <div class="line-v h-10"></div>

                    {{-- ── Level 2: JABATAN FUNGSIONAL & SEKCAM ── --}}
                    <div class="w-[800px] flex justify-between relative">
                        {{-- Horizontal line spanning JabFung to Sekcam --}}
                        <div class="absolute top-0 w-full line-h"></div>
                        
                        {{-- The Central Trunk continues down past this junction --}}
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 line-v h-[220px]"></div>

                        {{-- Left: Jabatan Fungsional --}}
                        <div class="relative pt-6">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 line-v h-6"></div>
                            @if($jabfung)
                                <div class="org-node z-10">
                                    <img src="{{ $jabfung->photo_url }}" alt="{{ $jabfung->name }}">
                                    <h3>{{ $jabfung->name }}</h3>
                                    <p class="pos">{{ $jabfung->position }}</p>
                                    @if($jabfung->nip)<p class="nip">NIP. {{ $jabfung->nip }}</p>@endif
                                </div>
                            @else
                                <div class="org-node border-dashed border-white/20 opacity-50 z-10">
                                    <p class="pos mt-0">JABATAN FUNGSIONAL</p>
                                    <p class="nip">(Kosong)</p>
                                </div>
                            @endif
                        </div>

                        {{-- Right: Sekcam --}}
                        <div class="relative pt-6 flex flex-col items-center">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 line-v h-6"></div>
                            @if($sekcam)
                                <div class="org-node z-10">
                                    <img src="{{ $sekcam->photo_url }}" alt="{{ $sekcam->name }}">
                                    <h3>{{ $sekcam->name }}</h3>
                                    <p class="pos">{{ $sekcam->position }}</p>
                                    @if($sekcam->nip)<p class="nip">NIP. {{ $sekcam->nip }}</p>@endif
                                </div>
                                
                                {{-- ── Level 3: Kasubag under Sekcam ── --}}
                                @if($kasubagList->count() > 0)
                                    <div class="line-v h-8"></div>
                                    <div class="flex gap-8 relative pt-6">
                                        <div class="absolute top-0 left-[20%] right-[20%] line-h"></div>
                                        @foreach($kasubagList as $kasubag)
                                            <div class="flex flex-col items-center relative z-10">
                                                <div class="absolute top-0 left-1/2 -translate-x-1/2 line-v h-6 -mt-6 z-0"></div>
                                                <div class="org-node w-[160px]">
                                                    <img src="{{ $kasubag->photo_url }}" alt="{{ $kasubag->name }}" style="width:40px;height:40px;">
                                                    <h3 style="font-size:11px;">{{ $kasubag->name }}</h3>
                                                    <p class="pos" style="font-size:9px;">{{ $kasubag->position }}</p>
                                                    @if($kasubag->nip)<p class="nip">{{ $kasubag->nip }}</p>@endif
                                                </div>

                                                {{-- Staf under Kasubag --}}
                                                @php $stafs = $stafByParent->get($kasubag->id, collect()); @endphp
                                                @if($stafs->count() > 0)
                                                    <div class="relative mt-0 pt-4 pb-4 pl-6 self-start">
                                                        <div class="absolute top-0 left-8 line-v h-full -z-10"></div>
                                                        <div class="flex flex-col gap-3 ml-2 relative z-10">
                                                            @foreach($stafs as $staf)
                                                                <div class="flex items-center relative">
                                                                    <div class="absolute left-[-24px] w-6 line-h"></div>
                                                                    <div class="staf-node">
                                                                        <img src="{{ $staf->photo_url }}" alt="staf">
                                                                        <div class="text">
                                                                            <h4>{{ $staf->name }}</h4>
                                                                            <p>Staf</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="org-node border-dashed border-white/20 opacity-50 z-10">
                                    <p class="pos mt-0">SEKRETARIAT CABANG</p>
                                    <p class="nip">(Kosong)</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── Level 4: KASI ROW (Positioned at bottom of the central trunk) ── --}}
                    @if($kasiList->count() > 0)
                        {{-- Notice the mt-10 gap to separate from Kasubag/JabFung rows, connecting back to the absolute 200px line from earlier --}}
                        <div class="flex flex-wrap justify-center gap-6 mt-16 relative z-10 w-full max-w-full">
                            {{-- Horizontal line connecting all Kasi, centered --}}
                            <div class="absolute top-0 left-[10%] right-[10%] line-h z-0"></div>

                            @foreach($kasiList as $kasi)
                                <div class="flex flex-col items-center relative pt-6 z-10">
                                    <div class="absolute top-0 left-1/2 -translate-x-1/2 line-v h-6 z-0"></div>
                                    <div class="org-node w-[170px]">
                                        <img src="{{ $kasi->photo_url }}" alt="{{ $kasi->name }}" style="width:48px;height:48px;">
                                        <h3 style="font-size:12px;">{{ $kasi->name }}</h3>
                                        <p class="pos" style="font-size:10px;">{{ $kasi->position }}</p>
                                        @if($kasi->nip)<p class="nip">{{ $kasi->nip }}</p>@endif
                                    </div>

                                    {{-- Staf under Kasi --}}
                                    @php $stafs = $stafByParent->get($kasi->id, collect()); @endphp
                                    @if($stafs->count() > 0)
                                        <div class="relative mt-0 pt-4 pb-4 pl-6 self-start w-full">
                                            <div class="absolute top-0 left-8 line-v h-[calc(100%-20px)] -z-10"></div>
                                            <div class="flex flex-col gap-3 ml-2 relative z-10">
                                                @foreach($stafs as $staf)
                                                    <div class="flex items-center relative">
                                                        <div class="absolute left-[-24px] w-6 line-h"></div>
                                                        <div class="staf-node w-full max-w-[140px]">
                                                            <div class="text">
                                                                <h4>{{ $staf->name }}</h4>
                                                                <p style="font-size:8px;">{{ $staf->nip ?? 'Staf' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
                @endif

            @else
                <div class="text-center py-16 max-w-md mx-auto">
                    <i class="fas fa-sitemap text-5xl text-white/10 mb-4 block"></i>
                    <p class="text-white/40 text-lg">Data struktur organisasi belum tersedia</p>
                </div>
            @endif

        </div>
    </section>

@endsection
