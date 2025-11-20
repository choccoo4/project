@extends('layouts.student')

@section('title', 'Belajar')

@section('content')
<main class="relative min-h-screen font-sans py-10 px-4 md:px-10" x-data="learningPath()">

    @foreach($levels as $levelIndex => $level)
    @php
    $levelColors = [
    1 => ['primary' => '#58CC02', 'secondary' => '#89E219', 'light' => '#E8F8D8'],
    2 => ['primary' => '#1CB0F6', 'secondary' => '#4DC5F8', 'light' => '#D8F2FF'],
    3 => ['primary' => '#FF9600', 'secondary' => '#FFB143', 'light' => '#FFEDD5'],
    4 => ['primary' => '#CE82FF', 'secondary' => '#DDABFF', 'light' => '#F3E8FF'],
    5 => ['primary' => '#FF4B4B', 'secondary' => '#FF7B7B', 'light' => '#FFE2E2'],
    ];
    $color = $levelColors[$level->number] ?? $levelColors[1];

    // Data dummy untuk frontend
    $activeStepIndex = 2; // Step ke-3 sebagai aktif (dummy data)
    $stepProgress = [3, 2, 1, 0, 0]; // Progress tiap step (0-3)

    $stepTitles = [
    'Bilangan dan Lambang Bilangan Cacah sampai 1.000',
    'Nilai Tempat Bilangan Cacah sampai 1.000',
    'Membandingkan dan Mengurutkan Bilangan Cacah sampai 1.000',
    'Penjumlahan dan Pengurangan Bilangan Cacah sampai 100',
    'Perkalian dan Pembagian Bilangan Cacah sampai 100',
    ];

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

        {{-- Header tiap level --}}
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

                                <div class="relative bg-white rounded-full w-24 h-24 flex items-center justify-center 
                                        transition-all duration-300 shadow-lg border-2
                                        {{ $isLocked ? 'border-gray-300 grayscale cursor-not-allowed' : 'cursor-pointer hover:scale-105' }}
                                        {{ $isCompleted ? 'border-green-500' : '' }}"
                                    style="{{ !$isLocked && !$isCompleted ? 'border-color: '.$color['primary'].';' : '' }}"
                                    @if(!$isLocked)
                                    @click="openPanel({{ $levelIndex }}, {{ $index }}, {{ $progress }}, {{ $isCompleted ? 'true' : 'false' }}, '{{ $stepTitles[$index] }}', '{{ $color['primary'] }}', '{{ $color['secondary'] }}', '{{ $leftPercent }}', '{{ $topPercent }}', '{{ $step->left_icon }}')"
                                    @endif>

                                    {{-- Progress Ring untuk bubble aktif --}}
                                    @if($isActive && $progress > 0 && $progress < 3)
                                        <svg class="absolute inset-0 w-24 h-24 transform -rotate-90" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="40" stroke="{{ $color['light'] }}" stroke-width="8" fill="none" />
                                        <circle cx="50" cy="50" r="40" stroke="{{ $color['primary'] }}" stroke-width="8" fill="none"
                                            stroke-dasharray="251.2"
                                            stroke-dashoffset="{{ 251.2 - (251.2 * $progressPercent) / 100 }}"
                                            stroke-linecap="round" />
                                        </svg>
                                        @endif

                                        {{-- Ikon Check untuk step yang sudah selesai --}}
                                        @if($isCompleted)
                                        <div class="absolute -top-1 -right-1 bg-green-500 rounded-full w-6 h-6 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        @endif

                                        <div class="relative z-10 flex flex-col items-center">
                                            @if($isActive && $progress > 0)
                                            <span class="text-xs font-bold mb-1" style="color: {{ $color['primary'] }};">
                                                {{ $progress }}/3
                                            </span>
                                            @endif
                                            <img src="{{ $step->left_icon }}" alt="ikon step"
                                                class="w-8 h-8 {{ $isLocked ? 'opacity-60' : '' }}">
                                        </div>

                                        @if($isLocked)
                                        <div class="absolute inset-0 rounded-full bg-gray-100/90 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        @endif
                                </div>

                                {{-- Tooltip kecil HANYA untuk step aktif yang belum selesai --}}
                                @if($isActive && !$isCompleted)
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 z-30 w-48">
                                    <div class="text-center mt-2">
                                        <button
                                            @click="openPanel({{ $levelIndex }}, {{ $index }}, {{ $progress }}, false, '{{ $stepTitles[$index] }}', '{{ $color['primary'] }}', '{{ $color['secondary'] }}', '{{ $leftPercent }}', '{{ $topPercent }}', '{{ $step->left_icon }}')"
                                            class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold font-fredoka px-4 py-2 rounded-full transition-colors shadow">
                                            MULAI
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        </div>
        @endforeach

        {{-- Floating Panel dengan Callout Arrow --}}
        <div x-show="showPanel"
            x-cloak
            class="fixed inset-0 z-50"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closePanel()">

            {{-- Backdrop transparan --}}
            <div class="absolute inset-0 bg-transparent"></div>

            {{-- Panel dengan callout arrow --}}
            <div class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-auto p-6 text-center border-2 border-gray-200"
                x-show="showPanel"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                @click.stop
                :style="panelStyle">

                {{-- Callout Arrow seperti Duolingo --}}
                <div class="absolute w-4 h-4 bg-white transform rotate-45 border-t-2 border-l-2 border-gray-200"
                    :style="arrowStyle"></div>

                <button @click="closePanel()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors z-20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="mb-4">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full flex items-center justify-center border-2 bg-white"
                        :style="`border-color: ${panelData.primaryColor};`">
                        <img :src="panelData.icon" alt="ikon step" class="w-8 h-8">
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2" x-text="panelData.title"></h4>
                    <p class="text-sm text-gray-600 mb-4" x-text="panelData.progressText"></p>
                </div>

                <button class="text-white text-sm font-bold px-6 py-3 rounded-full border-b-4 transition-transform active:scale-95 w-full"
                    :style="`background-color: ${panelData.primaryColor}; border-color: ${panelData.secondaryColor};`"
                    @click="startLearning()">
                    <span x-text="panelData.buttonText"></span>
                </button>
            </div>
        </div>
</main>

<script>
    function learningPath() {
        return {
            showPanel: false,
            panelData: {
                title: '',
                progress: 0,
                isCompleted: false,
                primaryColor: '#58CC02',
                secondaryColor: '#89E219',
                buttonText: 'MULAI BELAJAR',
                progressText: '',
                icon: ''
            },
            panelStyle: '',
            arrowStyle: '',

            openPanel(levelIndex, stepIndex, progress, isCompleted, title, primaryColor, secondaryColor, leftPercent, topPercent, icon) {
                this.panelData = {
                    title: title,
                    progress: progress,
                    isCompleted: isCompleted,
                    primaryColor: primaryColor,
                    secondaryColor: secondaryColor,
                    buttonText: isCompleted ? 'LATIHAN' : 'MULAI BELAJAR',
                    progressText: isCompleted ? 'Selesai 3 dari 3 pelajaran' : `Pelajaran ${progress + 1} dari 3`,
                    icon: icon
                };

                // Hitung posisi panel dan callout arrow
                this.calculatePanelPosition(leftPercent, topPercent);
                this.showPanel = true;
            },

            calculatePanelPosition(leftPercent, topPercent) {
                const left = parseFloat(leftPercent);
                const top = parseFloat(topPercent);

                // Tentukan posisi panel berdasarkan posisi bubble
                const viewportWidth = window.innerWidth;
                const viewportHeight = window.innerHeight;

                let panelLeft, panelTop, arrowPosition;

                if (top < 50) {
                    // Bubble di atas, panel di bawah bubble
                    panelTop = (top / 100) * viewportHeight + 80; // 80px di bawah bubble
                    arrowPosition = 'top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2';
                } else {
                    // Bubble di bawah, panel di atas bubble
                    panelTop = (top / 100) * viewportHeight - 200; // 200px di atas bubble
                    arrowPosition = 'bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2';
                }

                // Atur posisi horizontal
                if (left < 25) {
                    panelLeft = (left / 100) * viewportWidth + 20;
                    arrowPosition = arrowPosition.replace('left-1/2', 'left-6');
                } else if (left > 75) {
                    panelLeft = (left / 100) * viewportWidth - 320; // 320px = width panel
                    arrowPosition = arrowPosition.replace('left-1/2', 'right-6');
                } else {
                    panelLeft = (left / 100) * viewportWidth - 160; // Center panel
                }

                // Pastikan panel tidak keluar dari viewport
                panelLeft = Math.max(20, Math.min(panelLeft, viewportWidth - 340));
                panelTop = Math.max(20, Math.min(panelTop, viewportHeight - 300));

                this.panelStyle = `position: fixed; left: ${panelLeft}px; top: ${panelTop}px;`;
                this.arrowStyle = `position: absolute; ${arrowPosition};`;
            },

            closePanel() {
                this.showPanel = false;
                this.panelData = {
                    title: '',
                    progress: 0,
                    isCompleted: false,
                    primaryColor: '#58CC02',
                    secondaryColor: '#89E219',
                    buttonText: 'MULAI BELAJAR',
                    progressText: '',
                    icon: ''
                };
            },

            startLearning() {
                if (this.panelData.isCompleted) {
                    // Redirect ke latihan
                    console.log('Redirect to practice');
                } else {
                    // Redirect ke pembelajaran
                    console.log('Redirect to learning');
                }
                this.closePanel();
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    /* Progress ring animation */
    @keyframes progress-ring {
        0% {
            stroke-dashoffset: 251.2;
        }
    }

    .progress-ring {
        animation: progress-ring 1s ease-out forwards;
    }

    /* Callout arrow styling */
    .callout-arrow {
        box-shadow: -2px -2px 2px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection