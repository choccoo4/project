@extends('layouts.quiz')

@section('title', 'Ulas Pelajaran')

@section('content')

<!-- ===== HEADER ===== -->
<header class="flex justify-between items-center bg-[#FFF8F2] px-3 sm:px-5 md:px-6 py-3 sm:py-4 rounded-2xl mb-4 sm:mb-6 gap-2 sm:gap-4">
    <!-- kiri: judul dan siswa -->
    <div class="flex items-center justify-between w-full lg:w-auto bg-white rounded-2xl px-3 sm:px-5 py-2 sm:py-3 shadow-md gap-2 sm:gap-4 flex-1 mr-0 lg:mr-4">
        <div class="flex items-center gap-2 sm:gap-3 font-fredoka">
            <img src="https://img.icons8.com/color/48/test-passed.png" class="w-5 h-5 sm:w-7 sm:h-7" alt="Quiz Icon">
            <h1 class="text-[clamp(14px,2vw,18px)] font-extrabold text-[#EB580C]">Ulas Pelajaran</h1>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 font-nunito">
            <span class="text-[clamp(11px,1.8vw,14px)] text-gray-700 hidden xs:inline">
                Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="/icons/blank.jpeg" alt="Avatar"
                    class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full border-2 sm:border-4 border-[#EB580C] shadow">
                <span class="absolute -top-1 -right-1 sm:-top-1 sm:-right-2 bg-[#EB580C] text-white text-[8px] sm:text-[10px] font-bold px-1 py-0.5 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
    </div>

    <!-- kanan: tombol beranda -->
    <x-button
        variant="secondary"
        size="md"
        href="{{ url('/dashboard') }}"
        icon="https://img.icons8.com/fluency/32/home.png"
        iconSize="lg">
        <span class="hidden md:inline">Beranda</span>
    </x-button>
</header>

<!-- ===== PROGRESS & STATS ===== -->
<div class="bg-white border border-zinc-300 rounded-2xl shadow p-3 sm:p-4 mb-4 sm:mb-6">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="text-center p-2 sm:p-3">
            <div class="text-green-600 text-[clamp(12px,1.8vw,16px)] font-fredoka font-bold">Benar</div>
            <div class="text-[clamp(18px,2.5vw,24px)] font-extrabold text-gray-800 mt-1">{{ $correctCount ?? 2 }}</div>
        </div>
        <div class="text-center p-2 sm:p-3">
            <div class="text-red-600 text-[clamp(12px,1.8vw,16px)] font-fredoka font-bold">Salah</div>
            <div class="text-[clamp(18px,2.5vw,24px)] font-extrabold text-gray-800 mt-1">{{ ($totalQuestions ?? 5) - ($correctCount ?? 2) }}</div>
        </div>
        <div class="text-center p-2 sm:p-3">
            <div class="text-[#EB580C] text-[clamp(12px,1.8vw,16px)] font-fredoka font-bold">Progress</div>
            <div class="text-[clamp(18px,2.5vw,24px)] font-extrabold text-gray-800 mt-1">{{ $progressPercent ?? 40 }}%</div>
        </div>
        <div class="text-center p-2 sm:p-3">
            <div class="text-yellow-500 text-[clamp(12px,1.8vw,16px)] font-fredoka font-bold">XP</div>
            <div class="text-[clamp(18px,2.5vw,24px)] font-extrabold text-gray-800 mt-1">{{ $xpEarned ?? 20 }}</div>
        </div>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
@foreach($reviewQuestions as $review)
<div class="bg-white border border-zinc-300 rounded-2xl shadow p-3 sm:p-4 md:p-6 mb-4 sm:mb-6">

    <!-- QUESTION HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 pb-3 sm:pb-4 border-b border-gray-200 gap-2 sm:gap-0">
        <div class="flex items-center gap-2 sm:gap-3">
            <span class="bg-[#EB580C] text-white px-3 py-1 sm:px-4 sm:py-2 rounded-full text-[clamp(12px,1.8vw,16px)] font-fredoka font-bold">
                Soal {{ $review['question_number'] }}
            </span>
            <span class="text-[clamp(12px,1.8vw,16px)] font-nunito font-semibold {{ $review['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                {{ $review['is_correct'] ? '✓ Benar' : '✗ Perlu Dipelajari' }}
            </span>
        </div>
        <div class="text-gray-500 font-nunito text-[clamp(11px,1.6vw,14px)] bg-gray-100 px-2 py-1 rounded-full">
            {{ ucfirst(str_replace('_', ' ', $review['question']['type'])) }}
        </div>
    </div>

    <!-- QUESTION CONTENT -->
    <div class="mb-4 sm:mb-6">
        <h3 class="text-gray-800 font-nunito font-bold text-[clamp(16px,2.2vw,20px)] mb-3 sm:mb-4 leading-tight">
            {{ $review['question']['text'] }}
        </h3>

        <!-- Display based on question type -->
        @switch($review['question']['type'])
        @case('multiple_choice')
        <div class="space-y-2 sm:space-y-3">
            @foreach($review['question']['options'] as $option)
            <div class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-xl sm:rounded-2xl border-2 
                            {{ $option == $review['correct_answer'] ? 'bg-green-50 border-green-500' : 
                               ($option == $review['user_answer'] && !$review['is_correct'] ? 'bg-red-50 border-red-500' : 
                               'bg-gray-50 border-gray-200') }}">
                <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 flex items-center justify-center flex-shrink-0
                                {{ $option == $review['correct_answer'] ? 'bg-green-500 border-green-500' : 
                                   ($option == $review['user_answer'] && !$review['is_correct'] ? 'bg-red-500 border-red-500' : 
                                   'bg-white border-gray-300') }}">
                    @if($option == $review['correct_answer'])
                    <span class="text-white text-[10px] sm:text-xs font-bold">✓</span>
                    @elseif($option == $review['user_answer'] && !$review['is_correct'])
                    <span class="text-white text-[10px] sm:text-xs font-bold">✗</span>
                    @endif
                </div>
                <span class="text-gray-700 font-nunito text-[clamp(13px,1.8vw,16px)] flex-1">{{ $option }}</span>

                @if($option == $review['correct_answer'])
                <span class="text-green-600 font-nunito font-bold text-[clamp(10px,1.4vw,14px)] bg-green-100 px-2 py-1 rounded-full whitespace-nowrap">Jawaban Benar</span>
                @endif
                @if($option == $review['user_answer'] && !$review['is_correct'])
                <span class="text-red-600 font-nunito font-bold text-[clamp(10px,1.4vw,14px)] bg-red-100 px-2 py-1 rounded-full whitespace-nowrap">Jawaban Kamu</span>
                @endif
            </div>
            @endforeach
        </div>
        @break

        @case('fill_blank')
        <div class="space-y-3 sm:space-y-4">
            <!-- User Answer -->
            <div class="bg-red-50 border-2 border-red-200 rounded-xl sm:rounded-2xl p-3 sm:p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">✗</span>
                    <span class="text-red-700 font-nunito font-semibold text-[clamp(13px,1.8vw,16px)]">Jawaban Kamu</span>
                </div>
                <p class="text-gray-700 font-nunito text-[clamp(14px,2vw,18px)] leading-relaxed">
                    {!! str_replace('____', '<span class="bg-red-200 text-red-700 px-2 py-1 rounded-lg font-bold mx-1 border border-red-300 text-[clamp(14px,2vw,16px)]">'.$review['user_answer'].'</span>', $review['question']['sentence']) !!}
                </p>
            </div>

            <!-- Correct Answer -->
            <div class="bg-green-50 border-2 border-green-200 rounded-xl sm:rounded-2xl p-3 sm:p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-green-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-green-700 font-nunito font-semibold text-[clamp(13px,1.8vw,16px)]">Jawaban Benar</span>
                </div>
                <p class="text-gray-700 font-nunito text-[clamp(14px,2vw,18px)] leading-relaxed">
                    {!! str_replace('____', '<span class="bg-green-500 text-white px-2 py-1 rounded-lg font-bold mx-1 border border-green-600 text-[clamp(14px,2vw,16px)]">'.$review['correct_answer'].'</span>', $review['question']['sentence']) !!}
                </p>
            </div>
        </div>
        @break

        @case('ordering')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">✗</span>
                    <h4 class="text-red-700 font-nunito font-semibold text-[clamp(14px,2vw,18px)]">Jawaban Kamu</h4>
                </div>
                <div class="space-y-2">
                    @foreach($review['user_answer'] as $index => $answer)
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl sm:rounded-2xl p-3 flex items-center gap-3">
                        <span class="bg-red-500 text-white rounded-full w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-gray-700 font-nunito text-[clamp(13px,1.8vw,16px)]">{{ $answer }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-green-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">✓</span>
                    <h4 class="text-green-700 font-nunito font-semibold text-[clamp(14px,2vw,18px)]">Jawaban Benar</h4>
                </div>
                <div class="space-y-2">
                    @foreach($review['correct_answer'] as $index => $answer)
                    <div class="bg-green-50 border-2 border-green-200 rounded-xl sm:rounded-2xl p-3 flex items-center gap-3">
                        <span class="bg-green-500 text-white rounded-full w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-gray-700 font-nunito text-[clamp(13px,1.8vw,16px)]">{{ $answer }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @break

        @default
        <div class="bg-blue-50 border-2 border-blue-200 rounded-xl sm:rounded-2xl p-4 text-center">
            <p class="text-blue-700 font-nunito font-semibold text-[clamp(13px,1.8vw,16px)]">
                Jenis soal: {{ ucfirst(str_replace('_', ' ', $review['question']['type'])) }}
            </p>
        </div>
        @endswitch
    </div>

    <!-- EXPLANATION SECTION - IMPROVED -->
    <div class="border border-gray-300 rounded-2xl p-3 sm:p-4 bg-[#FFF8F2] shadow-inner mt-4 sm:mt-6">
        <div class="flex items-start gap-2 sm:gap-3 mb-3">
            <div class="flex items-center justify-center flex-shrink-0 mt-0.5">
                <img src="https://img.icons8.com/color/48/light-on.png" class="w-5 h-5 sm:w-6 sm:h-6" alt="Explanation">
            </div>
            <div>
                <h4 class="text-[#EB580C] font-fredoka font-extrabold text-[clamp(14px,2vw,18px)] mb-1">Penjelasan Jawaban</h4>
                <p class="text-gray-600 font-nunito text-[clamp(11px,1.6vw,13px)]">Pahami konsep ini untuk meningkatkan pemahamanmu</p>
            </div>
        </div>

        <div class="bg-white border border-[#EB580C]/20 rounded-xl sm:rounded-2xl p-3 sm:p-4">
            <p class="text-gray-700 font-nunito text-[clamp(13px,1.8vw,16px)] leading-relaxed sm:leading-loose">
                {{ $review['explanation'] }}
            </p>
        </div>
    </div>
</div>
@endforeach

<!-- ===== NAVIGATION ===== -->
<div class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-4 mt-6">
    <x-button variant="secondary" size="md" disabled="true">Sebelumnya</x-button>


    <div class="flex gap-2 sm:gap-3 w-full sm:w-auto order-1 sm:order-2">
        <x-button variant="primary" size="md" href="{{ route('quiz.results') }}">Kembali ke Hasil</x-button>

        <x-button variant="success" size="md" href="{{ route('quiz.restart') }}">Ulangi Kuis</x-button>
    </div>
</div>

@endsection