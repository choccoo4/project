@extends('layouts.students')

@section('title', 'Belajar - Semua Level')

@section('content')
<main class="relative min-h-screen font-sans py-10 px-4 md:px-10">

    @foreach($levels as $level)
    @php
        // Warna tiap level
        $levelColors = [
            1 => ['primary' => '#58CC02', 'secondary' => '#89E219', 'light' => '#E8F8D8'],
            2 => ['primary' => '#1CB0F6', 'secondary' => '#4DC5F8', 'light' => '#D8F2FF'],
            3 => ['primary' => '#FF9600', 'secondary' => '#FFB143', 'light' => '#FFEDD5'],
            4 => ['primary' => '#CE82FF', 'secondary' => '#DDABFF', 'light' => '#F3E8FF'],
            5 => ['primary' => '#FF4B4B', 'secondary' => '#FF7B7B', 'light' => '#FFE2E2'],
        ];
        $color = $levelColors[$level->number] ?? $levelColors[1];
    @endphp

    {{-- Header tiap level --}}
    <header class="relative text-center mb-16">
        <div class="mx-auto text-white rounded-2xl px-8 py-6 shadow-lg w-full md:max-w-3xl border-b-4"
             style="background: linear-gradient(to right, {{ $color['primary'] }}, {{ $color['secondary'] }}); border-color: {{ $color['primary'] }};">
            <div class="flex items-center justify-center space-x-3 mb-2">
                <div class="bg-white/20 rounded-full p-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold tracking-tight">Level {{ $level->number }}</h2>
            </div>
            <h3 class="text-xl font-semibold mb-1">{{ $level->title }}</h3>
            <p class="text-sm opacity-95 font-medium">{{ $level->subtitle }}</p>
        </div>
    </header>

    @php
        $stepIcons = [
            'https://img.icons8.com/color/48/learning.png',
            'https://img.icons8.com/color/48/book.png',
            'https://img.icons8.com/color/48/brain.png',
            'https://img.icons8.com/color/48/checklist.png',
            'https://img.icons8.com/color/48/test-passed.png',
        ];

        $n = count($level->steps);
        $yPad = 8;
        $yStep = $n > 1 ? (100 - 2 * $yPad) / ($n - 1) : 0;

        $xOffsets = [0, -4, -2, 2, 3];
        $baseX = 50;

        $points = [];
        for ($i = 0; $i < $n; $i++) {
            $xOffset = $xOffsets[$i] ?? 0;
            $x = $baseX + $xOffset;
            $y = $yPad + $i * $yStep;
            $points[] = ['x' => $x, 'y' => $y];
        }

        // Path
        $pathD = 'M ' . $points[0]['x'] . ',' . $points[0]['y'];
        for ($i = 1; $i < count($points); $i++) {
            $prev = $points[$i - 1];
            $curr = $points[$i];
            $dx = $curr['x'] - $prev['x'];
            $dy = $curr['y'] - $prev['y'];
            $cp1x = $prev['x'] + $dx * 0.4;
            $cp1y = $prev['y'] + $dy * 0.25;
            $cp2x = $prev['x'] + $dx * 0.6;
            $cp2y = $prev['y'] + $dy * 0.75;
            $pathD .= ' C ' . $cp1x . ',' . $cp1y . ' ' . $cp2x . ',' . $cp2y . ' ' . $curr['x'] . ',' . $curr['y'];
        }
    @endphp

    <div class="relative mb-20 max-w-4xl mx-auto">
        {{-- Bubble Step --}}
        <div class="flex flex-col relative z-10">
            @foreach($level->steps as $index => $step)
                @php
                    $isLocked = $index > 0;
                    $point = $points[$index];
                    $leftPercent = $point['x'] . '%';
                    $topPercent = $point['y'] . '%';
                    $isCompleted = $index === 0;
                @endphp

                <div class="relative h-32 flex items-center justify-center">
                    <div class="absolute top-1/2 -translate-y-1/2 transform -translate-x-1/2"
                         style="left: {{ $leftPercent }};">
                        <div class="relative flex flex-col items-center group">
                            {{-- Bubble --}}
                            <div class="relative">
                                @if(!$isLocked)
                                <div class="absolute inset-0 rounded-full opacity-20 blur-md transition-opacity duration-300"
                                     style="background-color: {{ $color['primary'] }};"></div>
                                @endif
                                
                                <div class="relative bg-white rounded-full w-24 h-24 flex items-center justify-center 
                                            transition-all duration-300 group-hover:scale-110 shadow-lg border-2
                                            {{ $isLocked ? 'border-gray-300 grayscale' : '' }}"
                                     style="{{ !$isLocked ? 'border-color: '.$color['primary'].';' : '' }}
                                            {{ $isCompleted ? 'box-shadow: 0 0 0 4px '.$color['light'].' inset;' : '' }}">
                                    
                                    {{-- Checkmark --}}
                                    @if($isCompleted)
                                    <div class="absolute -top-1 -right-1 rounded-full w-6 h-6 flex items-center justify-center"
                                         style="background-color: {{ $color['primary'] }};">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    @endif
                                    
                                    <img src="{{ $stepIcons[$index] ?? $stepIcons[0] }}" alt="ikon step"
                                         class="w-7 h-7 {{ $isLocked ? 'opacity-60' : '' }}">
                                    
                                    @if($isLocked)
                                    <div class="absolute inset-0 rounded-full bg-gray-100/90 backdrop-blur-[1px] flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            @unless($isLocked)
                            <button class="absolute -bottom-6 text-white px-3 py-1 rounded-full text-[10px] font-bold shadow-lg 
                                        transition duration-200 hover:scale-105 transform border-b-2 active:scale-95"
                                    style="background-color: {{ $color['primary'] }}; border-color: {{ $color['secondary'] }};">
                                MULAI
                            </button>
                            @endunless
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
</main>

<style>
    @keyframes bubblePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    .group:hover .relative:not(.grayscale) {
        animation: bubblePulse 1s ease-in-out infinite;
    }
</style>
@endsection
