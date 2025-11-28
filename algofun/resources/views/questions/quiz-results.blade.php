@extends('layouts.quiz')

@section('title', 'Ringkasan Hasil Kuis')

@section('content')

<!-- ===== HEADER ===== -->
<header class="flex justify-between items-center bg-[#FFF8F2] px-3 sm:px-5 md:px-6 py-3 sm:py-4 rounded-2xl mb-6 sm:mb-8 gap-3 sm:gap-4">

    <!-- kiri: judul dan siswa -->
    <div class="flex items-center justify-between w-full lg:w-auto bg-white rounded-2xl px-3 sm:px-5 py-3 shadow-md gap-3 sm:gap-6 flex-1 mr-0 lg:mr-4">
        <div class="flex items-center gap-2 sm:gap-3 font-fredoka">
            <img src="https://img.icons8.com/color/48/test-passed.png" class="w-6 sm:w-8 h-6 sm:h-8" alt="Quiz Icon">
            <h1 class="text-[clamp(14px,2vw,20px)] font-extrabold text-[#EB580C]">Ringkasan Hasil Kuis</h1>
        </div>

        <div class="flex items-center gap-2 sm:gap-3 font-nunito">
            <span class="text-[clamp(12px,2vw,16px)] text-gray-700 hidden xs:inline">
                Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="/icons/blank.jpeg" alt="Avatar"
                    class="w-10 sm:w-12 md:w-14 h-10 sm:h-12 md:h-14 rounded-full border-4 border-[#EB580C] shadow">
                <span class="absolute -top-1 -right-2 bg-[#EB580C] text-white text-[10px] sm:text-xs font-bold px-1.5 py-0.5 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
    </div>

    <!-- kanan: tombol beranda -->
    <a href="{{ url('/dashboard') }}"
        class="bg-white rounded-2xl shadow-md flex items-center justify-center hover:bg-orange-50 transition font-fredoka
               w-10 h-10 sm:w-auto sm:h-auto sm:px-5 sm:py-3 gap-0 sm:gap-2">
        <!-- icon -->
        <img src="https://img.icons8.com/fluency/32/home.png" alt="Beranda" class="w-6 h-6 sm:w-7 sm:h-7">
        <!-- teks hanya muncul di tablet/desktop -->
        <span class="hidden sm:inline text-[clamp(12px,2vw,16px)] text-gray-700">Beranda</span>
    </a>
</header>

<!-- ===== MAIN CONTENT ===== -->
<div class="bg-white border border-zinc-300 rounded-2xl shadow p-4 sm:p-6 md:p-8">
    <div class="grid grid-cols-12 gap-6 sm:gap-8">
        <!-- LEFT -->
        <div class="col-span-12 lg:col-span-8">
            <div class="flex items-start gap-4 sm:gap-6">
                <div class="w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 bg-white border border-zinc-300 rounded-2xl flex items-center justify-center shadow">
                    <img src="https://img.icons8.com/?size=100&id=gJNnE7dfS2hb&format=png&color=000000" alt="ikon prestasi" class="w-10 sm:w-12 md:w-16 h-10 sm:h-12 md:h-16">
                </div>
                <div>
                    <h2 class="text-[#EB580C] font-fredoka font-extrabold text-[clamp(20px,3vw,28px)] leading-snug">Kamu Hebat!</h2>
                    <p class="mt-1 sm:mt-2 text-[clamp(12px,2.2vw,18px)] text-gray-700">
                        Kamu sudah menyelesaikan <strong>Kuis Level 1 Step 1</strong>
                    </p>
                </div>
            </div>

            <!-- STAT -->
            <div class="mt-8 flex justify-between gap-3 sm:gap-4">
                <div class="flex-1 bg-white border border-zinc-200 rounded-2xl shadow-sm py-4 text-center">
                    <div class="text-green-700 text-[clamp(14px,2.2vw,22px)] font-extrabold">Benar</div>
                    <div class="text-[clamp(20px,3vw,32px)] font-extrabold mt-1">{{ $correct ?? 12 }}</div>
                </div>
                <div class="flex-1 bg-white border border-zinc-200 rounded-2xl shadow-sm py-4 text-center">
                    <div class="text-red-600 text-[clamp(14px,2.2vw,22px)] font-extrabold">Salah</div>
                    <div class="text-[clamp(20px,3vw,32px)] font-extrabold mt-1">{{ $wrong ?? 3 }}</div>
                </div>
                <div class="flex-1 bg-white border border-zinc-200 rounded-2xl shadow-sm py-4 text-center">
                    <div class="text-yellow-500 text-[clamp(14px,2.2vw,22px)] font-extrabold">XP</div>
                    <div class="text-[clamp(20px,3vw,32px)] font-extrabold mt-1">{{ $xp ?? 35 }}</div>
                </div>
            </div>

            <!-- AI INSIGHT -->
            <div class="mt-10 border border-gray-300 rounded-2xl p-5 sm:p-6 bg-white shadow-inner">
                <div class="flex items-center gap-3 mb-3">
                    <img src="/icons/robot.png" class="w-8 sm:w-10 h-8 sm:h-10" alt="Robot Icon">
                    <h3 class="text-[#EB580C] font-fredoka text-[clamp(16px,2.5vw,24px)] font-semibold">Evaluasi Belajar (AI Insight)</h3>
                </div>
                <div class="bg-orange-200 p-4 rounded-2xl flex gap-3 items-start">
                    <img src="https://img.icons8.com/color/48/idea.png" class="w-8 sm:w-10 h-8 sm:h-10" alt="Insight Icon">
                    <p class="text-gray-700 text-[clamp(12px,2vw,16px)] leading-relaxed">
                        Kamu masih lemah di <b>“Soal Cerita Bilangan Cacah sampai 10.000”</b><br>
                        Latih lagi bagian ini biar naik level lebih cepat!
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-6 mt-6 lg:mt-0">
            <div class="bg-white border border-zinc-300 rounded-2xl shadow p-5 sm:p-6 text-center">
                <div
                    x-data="{
                        percent: {{ $percent ?? 80 }},
                        radius: 72,
                        get circumference(){ return 2 * Math.PI * this.radius },
                        get dashOffset(){ return this.circumference * (1 - this.percent/100) }
                    }"
                    class="flex flex-col items-center">
                    <svg class="w-32 sm:w-40 h-32 sm:h-40" viewBox="0 0 200 200">
                        <g transform="translate(100,100)">
                            <circle r="72" fill="transparent" stroke="#E5E7EB" stroke-width="14"></circle>
                            <circle r="72" fill="transparent" stroke="#EB580C" stroke-width="14" stroke-linecap="round"
                                :stroke-dasharray="(2 * Math.PI * 72).toFixed(2)"
                                :stroke-dashoffset="dashOffset.toFixed(2)"
                                transform="rotate(-90)"></circle>
                            <text x="0" y="7" text-anchor="middle" style="font-size:22px; fill:#374151;"
                                class="font-nunito font-bold" x-text="percent + '%'"></text>
                        </g>
                    </svg>

                    <div class="mt-4 w-full">
                        <x-button
                            variant="primary"
                            color="#EB580C"
                            block
                            href="{{ route('quiz.restart') }}">
                            Ulangi
                        </x-button>

                        <x-button
                            variant="primary"
                            color="#8EE000"
                            class="mt-3"
                            block
                            href="{{ route('lesson.review') }}">
                            Ulas Pelajaran
                        </x-button>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-300 rounded-2xl shadow p-5 sm:p-6 text-center">
                <div class="flex justify-center mb-2">
                    <img src="assets/badges/sicepat.png" alt="pencapaian" class="w-14 sm:w-20 h-14 sm:h-20">
                </div>
                <h4 class="text-[#EB580C] text-[clamp(14px,2vw,20px)] font-fredoka">Pencapaian Baru!</h4>
                <p class="text-gray-700 font-semibold mt-1 text-[clamp(12px,1.8vw,16px)]">Si Cepat Hitung</p>
            </div>
        </div>
    </div>
</div>
@endsection