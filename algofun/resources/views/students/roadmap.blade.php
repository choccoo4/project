@extends('layouts.students')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-gradient-to-b from-orange-100 via-yellow-50 to-white">

    <!-- Judul -->
    <header class="pt-16 mb-16 text-center relative z-10">
        <h1 class="text-4xl font-extrabold text-[#EB580C] drop-shadow-md flex items-center justify-center gap-3">
            <img src="https://img.icons8.com/doodle/48/map.png" class="w-10 h-10" alt="map icon">
            Roadmap Petualangan
        </h1>
        <p class="text-base text-gray-700 mt-2">Ikuti langkah demi langkah untuk membuka level berikutnya 🚀</p>
    </header>

    @php
    $levelsData = [
    ['name'=>'Desa Pemula','concept'=>'Urutan langkah (sequence)','icon'=>'https://img.icons8.com/fluency/48/landscape.png','gif'=>'village.gif'],
    ['name'=>'Hutan Simbolik','concept'=>'Simbol & perintah dasar','icon'=>'https://img.icons8.com/fluency/48/forest.png','gif'=>'forest.gif'],
    ['name'=>'Pulau Kondisi','concept'=>'If-Else sederhana','icon'=>'https://img.icons8.com/color/48/island-on-water.png','gif'=>'island.gif'],
    ['name'=>'Gunung Perbandingan','concept'=>'Operator perbandingan','icon'=>'https://img.icons8.com/fluency/48/mountain.png','gif'=>'river_15745316.gif'],
    ['name'=>'Danau Ulang','concept'=>'Looping dasar','icon'=>'https://img.icons8.com/fluency/48/water.png','gif'=>'waterway_15745341.gif'],
    ['name'=>'Kota Cabang','concept'=>'Percabangan kompleks','icon'=>'https://img.icons8.com/fluency/48/city.png','gif'=>'city-park_18998044.gif'],
    ['name'=>'Lembah Pola','concept'=>'Pattern & nested loops','icon'=>'https://img.icons8.com/color/48/valley.png','gif'=>'river_15745310.gif'],
    ['name'=>'Pabrik Fungsi','concept'=>'Fungsi & parameter dasar','icon'=>'https://img.icons8.com/fluency/48/factory.png','gif'=>'factory_16768536.gif'],
    ['name'=>'Dunia Bug','concept'=>'Debugging & tracing','icon'=>'https://img.icons8.com/fluency/48/bug.png','gif'=>'ladybug_12086952.gif'],
    ['name'=>'Benteng Evaluasi','concept'=>'Review semua materi','icon'=>'https://img.icons8.com/fluency/48/castle.png','gif'=>'castle_11202230.gif'],
    ];

    $stepsPerLevel = 5;
    $progress = $progress ?? [1 => 3,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0];
    $unlocked = [];
    foreach($levelsData as $i => $lvl){
    $idx = $i+1;
    $unlocked[$idx] = ($idx==1) || (($progress[$idx-1] ?? 0) >= $stepsPerLevel);
    }
    @endphp

    <div class="relative max-w-4xl mx-auto px-6 md:px-12 lg:px-24">
        <!-- Garis roadmap -->
        <div class="absolute left-1/2 transform -translate-x-1/2 h-full border-l-4 border-dashed border-orange-400"></div>

        @foreach($levelsData as $i => $level)
        @php
        $lid = $i+1;
        $completed = intval($progress[$lid] ?? 0);
        $levelUnlocked = $unlocked[$lid];
        $xpPercent = intval(($completed/$stepsPerLevel)*100);
        $side = $lid % 2 == 0 ? 'justify-start pr-20' : 'justify-end pl-20';

        $gifPosition = $lid % 2 == 0
        ? ['class'=>'absolute right-12 transform -translate-x-1/2 -translate-y-1','size'=>'w-28 h-28']
        : ['class'=>'absolute left-35 transform -translate-x-1/2 -translate-y-1','size'=>'w-28 h-28'];
        @endphp

        <!-- GIF level -->
        <img src="{{ asset('assets/'.$level['gif']) }}" class="{{ $gifPosition['class'] }} {{ $gifPosition['size'] }} float-gif-level" style="mix-blend-mode:multiply; opacity:0.9; z-index:0;">

        <!-- Card tiap level (x-data per card => isolasi popup) -->
        <div class="relative flex {{ $side }} mb-24 group z-10">
            <!-- Titik roadmap -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full 
                      {{ $levelUnlocked ? 'bg-yellow-400 sparkle' : 'bg-gray-300' }}
                      border-4 border-white shadow-lg flex items-center justify-center z-10">
                <span class="text-sm font-bold">{{ $lid }}</span>
            </div>

            <!-- card utama: tambahkan x-data di sini -->
            <div
                class="w-72 rounded-2xl p-5 shadow-lg bg-white hover:scale-105 transition transform relative z-10"
                x-data="{ openStep: null }"
                @keydown.escape.window="openStep = null">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-[#FFF8F2] flex items-center justify-center shadow">
                        <img src="{{ $level['icon'] }}" class="w-8 h-8" alt="level icon">
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Level {{ $lid }}</div>
                        <div class="text-lg font-bold text-gray-800">{{ $level['name'] }}</div>
                        <div class="text-xs text-gray-500">{{ $level['concept'] }}</div>
                    </div>
                </div>

                <!-- Progress bar -->
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-2 bg-[#EB580C] transition-all" style="width: {{ $xpPercent }}%"></div>
                </div>

                <!-- Step kecil (parent relative supaya popup absolute relatif ke tiap lingkaran) -->
                <div class="flex gap-2 mt-3 flex-wrap">
                    @for($s=1;$s<=$stepsPerLevel;$s++)
                        @php
                        $done=$s <=$completed;
                        $next=(!$done) && ($s===($completed+1)) && $levelUnlocked;
                        $locked=!$done && !$next;
                        $class=$done ? 'bg-green-500 text-white' : ($next ? 'bg-yellow-500 text-white animate-pulse' : 'bg-gray-200 text-gray-400' );
                        @endphp

                        <div class="relative"> <!-- anchor untuk popup -->
                        <!-- lingkaran step -->
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow {{ $class }} {{ $next ? 'cursor-pointer' : '' }}"
                            @if($next)
                            @click.stop="openStep = (openStep === {{ $s }} ? null : {{ $s }})"
                            tabindex="0"
                            @endif
                            role="button"
                            aria-pressed="false">
                            @if($done) ✓ @else {{ $s }} @endif
                        </div>

                        <!-- POPUP: hanya render (blade) untuk step yang boleh dibuka ($next) -->
                        @if($next)
                        <div
                            x-show="openStep === {{ $s }}"
                            x-cloak
                            x-transition.origin.top.duration.200
                            @click.outside="openStep = null"
                            class="absolute left-1/2 transform -translate-x-1/2 mt-3 bg-green-500 text-white rounded-xl shadow-lg w-56 p-4 z-50">
                            <!-- tombol close kecil -->
                            <button
                                @click.prevent.stop="openStep = null"
                                class="absolute top-2 right-2 text-white/90 hover:text-white text-lg"
                                aria-label="Tutup">✕</button>

                            <div class="font-bold text-sm mb-1">Judul Step {{ $s }}</div>
                            <div class="text-xs mb-3">Pelajaran {{ $s }} dari {{ $stepsPerLevel }}</div>

                            <form method="GET" action="/soal/1">
                                <button type="submit" class="w-full bg-white text-green-600 font-bold rounded-lg py-2 hover:bg-gray-100">
                                    MULAI +10 XP
                                </button>
                            </form>

                        </div>
                        @endif
                </div>
                @endfor
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

<style>
    /* sembunyikan elemen alpine sampai inisialisasi (hapus flicker / popup muncul sendiri) */
    [x-cloak] {
        display: none !important;
    }

    /* Float GIF per level */
    @keyframes floatGifLevel {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .float-gif-level {
        animation: floatGifLevel 4s ease-in-out infinite;
    }

    /* Titik roadmap sparkle */
    @keyframes sparkleAnim {

        0%,
        100% {
            opacity: 0.6;
            transform: scale(0.8) rotate(0deg);
        }

        50% {
            opacity: 1;
            transform: scale(1.3) rotate(15deg);
        }
    }

    .sparkle::after {
        content: "✨";
        position: absolute;
        top: -12px;
        right: -12px;
        font-size: 22px;
        animation: sparkleAnim 1.5s infinite ease-in-out;
    }
</style>

<!-- Pastikan Alpine.js tersedia (jika layoutmu sudah include Alpine, baris ini tidak perlu) -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection