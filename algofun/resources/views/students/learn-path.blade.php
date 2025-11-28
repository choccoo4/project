@extends('layouts.student')

@section('title', 'Belajar')

@section('content')
<main class="relative min-h-screen font-sans py-10 px-4 md:px-10" x-data="learningPath()">

    @foreach($levels as $levelIndex => $level)
    @php
    $color = $level->color;
    $n = count($level->steps);
    $yPad = 8;
    $yStep = $n > 1 ? (100 - 2 * $yPad) / ($n - 1) : 0;
    $xOffsets = [0, -4, -2, 2, 3];
    $baseX = 50;

    $points = [];
    for ($i = 0; $i < $n; $i++) {
        $xOffset=$xOffsets[$i] ?? 0;
        $x=$baseX + $xOffset;
        $y=$yPad + $i * $yStep;
        $points[]=['x'=> $x, 'y' => $y];
        }
        @endphp

        {{-- Header Level --}}
        <header class="relative text-center mb-16">
            <div class="mx-auto rounded-2xl px-8 py-6 shadow-lg w-full md:max-w-3xl border-b-4"
                style="background-color: {{ $color['primary'] }}; border-color: {{ $color['secondary'] }};">
                <h2 class="text-2xl font-fredoka font-semibold text-white tracking-tight">
                    Level {{ $level->number }} - {{ $level->title }}
                </h2>
            </div>
        </header>

        {{-- Bubbles / Steps --}}
        <div class="relative mb-20 max-w-4xl mx-auto">
            <div class="flex flex-col relative z-10">
                @foreach($level->steps as $index => $step)
                @php
                $isLocked = $index > $activeStepIndex;
                $point = $points[$index];
                $leftPercent = $point['x'] . '%';
                $topPercent = $point['y'] . '%';
                $isActive = $index === $activeStepIndex;
                $isCompleted = $index < $activeStepIndex;
                    $progress=$stepProgress[$index] ?? 0;
                    $progressPercent=($progress / 3) * 100;
                    @endphp

                    <div class="relative h-32 flex items-center justify-center" id="level-{{ $levelIndex }}-step-{{ $index }}">
                    <div class="absolute top-1/2 -translate-y-1/2 transform -translate-x-1/2"
                        style="left: {{ $leftPercent }};">
                        <div class="relative flex flex-col items-center">

                            {{-- Bubble --}}
                            <div class="relative">
                                @if($isActive)
                                <div class="absolute inset-0 rounded-full opacity-30 blur-md"
                                    style="background-color: {{ $color['primary'] }};"></div>
                                @endif

                                <div class="relative rounded-full w-24 h-24 
        {{ $isLocked ? 'grayscale cursor-not-allowed' : 'cursor-pointer hover:scale-105' }}"
                                    style="
            background: conic-gradient(
                {{ $isActive && $progress > 0 ? $color['primary'] : ($isCompleted ? $color['primary'] : ($isLocked ? '#D1D5DB' : $color['primary'])) }} 0deg, 
                {{ $isActive && $progress > 0 ? $color['primary'] : ($isCompleted ? $color['primary'] : ($isLocked ? '#D1D5DB' : $color['primary'])) }} {{ $isActive && $progress > 0 ? $progressPercent * 3.6 : 360 }}deg, 
                {{ $isActive && $progress > 0 ? $color['light'] : ($isCompleted ? $color['light'] : 'transparent') }} {{ $isActive && $progress > 0 ? $progressPercent * 3.6 : 360 }}deg, 
                {{ $isActive && $progress > 0 ? $color['light'] : ($isCompleted ? $color['light'] : 'transparent') }} 360deg
            );
            padding: 3px;
        "
                                    @if(!$isLocked)
                                    @click="openTooltip({{ $levelIndex }}, {{ $index }}, {{ $progress }}, {{ $isCompleted ? 'true' : 'false' }}, '{{ addslashes($step->title) }}', '{{ $color['primary'] }}', '{{ $color['secondary'] }}', '{{ $leftPercent }}', '{{ $topPercent }}', '{{ $step->left_icon }}')"
                                    @endif>

                                    {{-- Inner content --}}
                                    <div class="w-full h-full bg-white rounded-full flex items-center justify-center relative">
                                        {{-- Check Icon - WARNA LEVEL --}}
                                        @if($isCompleted)
                                        <div class="absolute -top-1 -right-1 rounded-full w-6 h-6 flex items-center justify-center"
                                            style="background-color: {{ $color['primary'] }};">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        @endif

                                        <div class="flex flex-col items-center">
                                            @if($isActive && $progress > 0)
                                            <span class="text-xs font-bold mb-1" style="color: {{ $color['primary'] }};">
                                                {{ $progress }}/3
                                            </span>
                                            @endif
                                            <img src="{{ $step->left_icon }}" alt="Step {{ $step->number }}"
                                                class="w-8 h-8 {{ $isLocked ? 'opacity-60' : '' }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Tooltip Right untuk step aktif --}}
                                @if($isActive && !$isCompleted)
                                <div class="absolute left-full top-1/2 -translate-y-1/2 z-30 ml-3">
                                    <div class="relative cursor-pointer transition-all duration-200 hover:brightness-110">
                                        <div class="rounded-lg shadow-lg px-4 py-2"
                                            style="background:{{ $color['primary'] }};"
                                            @click="openTooltip({{ $levelIndex }}, {{ $index }}, {{ $progress }}, false, '{{ addslashes($step->title) }}', '{{ $color['primary'] }}', '{{ $color['secondary'] }}', '{{ $leftPercent }}', '{{ $topPercent }}', '{{ $step->left_icon }}')">
                                            <span class="font-fredoka font-semibold text-sm whitespace-nowrap text-white">MULAI</span>
                                        </div>
                                        <div class="absolute -left-1 top-1/2 transform -translate-y-1/2">
                                            <div class="w-2 h-2 rotate-45" style="background-color: {{ $color['primary'] }};"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- TOOLTIP BOTTOM - DIPINDAH KE LUAR BUBBLE CONTAINER --}}
                    <div x-show="showTooltip && activeBubble === 'level-{{ $levelIndex }}-step-{{ $index }}'"
                        x-cloak
                        class="absolute left-1/2 transform -translate-x-1/2 z-50 w-64 sm:w-72 tooltip-container"
                        style="top: calc({{ $topPercent }} + 80px)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2">

                        {{-- Tooltip Content --}}
                        <div class="relative bg-white rounded-2xl shadow-xl p-4 border-2 border-gray-200">
                            {{-- Tooltip Arrow --}}
                            <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                                <div class="w-4 h-4 bg-white border-t-2 border-l-2 border-gray-200 rotate-45"></div>
                            </div>

                            <button @click="closeTooltip()"
                                class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors z-20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>

                            <div class="mb-3">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full flex items-center justify-center border-2 bg-white"
                                    :style="`border-color: ${tooltipData.primaryColor};`">
                                    <img :src="tooltipData.icon" alt="Step Icon" class="w-6 h-6">
                                </div>
                                <h4 class="text-base font-bold text-gray-800 mb-1 text-center" x-text="tooltipData.title"></h4>
                                <p class="text-xs text-gray-600 text-center" x-text="tooltipData.progressText"></p>
                            </div>

                            {{-- Button dengan warna yang jelas --}}
                            <button
                                x-bind:style="`background: ${tooltipData.primaryColor};`"
                                @click="startLearning()"
                                class="w-full text-white text-sm font-bold px-4 py-2.5 rounded-full transition-transform active:scale-95 font-fredoka hover:brightness-95"
                                x-text="tooltipData.buttonText">
                            </button>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        @endforeach
</main>

<script>
    function learningPath() {
        return {
            showTooltip: false,
            activeBubble: null,
            tooltipData: {
                title: '',
                progress: 0,
                isCompleted: false,
                primaryColor: '#58CC02',
                secondaryColor: '#89E219',
                buttonText: 'MULAI BELAJAR',
                progressText: '',
                icon: '',
                stepId: null
            },

            init() {
                // Auto close tooltip ketika scroll
                window.addEventListener('scroll', () => {
                    if (this.showTooltip) {
                        this.closeTooltip();
                    }
                }, {
                    passive: true
                });
            },

            openTooltip(levelIndex, stepIndex, progress, isCompleted, title, primaryColor, secondaryColor, leftPercent, topPercent, icon) {
                // Close existing tooltip first
                this.closeTooltip();

                // Small delay untuk avoid event bubbling
                setTimeout(() => {
                    this.tooltipData = {
                        title: title,
                        progress: progress,
                        isCompleted: isCompleted,
                        primaryColor: primaryColor,
                        secondaryColor: secondaryColor,
                        buttonText: isCompleted ? 'LATIHAN LAGI' : 'MULAI BELAJAR',
                        progressText: isCompleted ? 'Selesai 3 dari 3 pelajaran' : `Pelajaran ${progress + 1} dari 3`,
                        icon: icon,
                        stepId: `level-${levelIndex}-step-${stepIndex}`
                    };

                    this.activeBubble = `level-${levelIndex}-step-${stepIndex}`;
                    this.showTooltip = true;
                }, 10);
            },

            closeTooltip() {
                this.showTooltip = false;
                this.activeBubble = null;
            },

            startLearning() {
                const stepId = this.tooltipData.stepId;
                const url = this.tooltipData.isCompleted ?
                    "{{ url('/latihan') }}/" + stepId :
                    "{{ url('/belajar') }}/" + stepId;

                window.location.href = url;
                this.closeTooltip();
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endsection