@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6" x-data>
    <!-- Header -->
    <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4">
        <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-2 font-fredoka">
            <img src="https://img.icons8.com/color/96/goal--v1.png" class="w-8 h-8" alt="Misi">
            Misi
        </h1>
        <div class="flex items-center space-x-4 font-nunito-semibold">
            <span class="text-gray-700 text-lg">Halo,
                <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="/icons/avatar-hero.png" alt="Avatar" class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
                <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <div class="bg-white rounded-2xl shadow-lg p-6 max-w-3xl mx-auto">
        <h2 class="text-center text-xl font-fredoka font-bold text-[#EB580C] mb-6">
            Misi Harian
        </h2>

        <!-- CARD MISI -->
        <div class="flex flex-col gap-6">

            <!-- Misi 1 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4" 
                 x-data="{ progress: 0, target: 60 }"
                 x-init="let interval = setInterval(() => { 
                    if (progress < target) progress += 1; else clearInterval(interval);
                 }, 15)">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold">Dapatkan 50 XP Hari Ini</h3>
                    <span class="text-sm text-gray-500" x-text="`${progress}/50`"></span>
                </div>
                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-100 ease-out" 
                         :style="`width: ${progress}%;`"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600 flex items-center gap-1">
                    🎁 +10 XP + Badge “Rajin Hari Ini”
                </p>
            </div>

            <!-- Misi 2 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4"
                 x-data="{ progress: 0, target: 60 }"
                 x-init="let interval = setInterval(() => { 
                    if (progress < target) progress += 1; else clearInterval(interval);
                 }, 15)">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold">Jawab 5 Soal Benar Berturut-turut</h3>
                    <span class="text-sm text-gray-500" x-text="`${Math.round(progress / 20)} / 5`"></span>
                </div>
                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-100 ease-out"
                         :style="`width: ${progress}%;`"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600 flex items-center gap-1">
                    🎁 +5 XP
                </p>
            </div>

            <!-- Misi 3 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4"
                 x-data="{ progress: 0, target: 50 }"
                 x-init="let interval = setInterval(() => { 
                    if (progress < target) progress += 1; else clearInterval(interval);
                 }, 15)">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold">Selesaikan 2 Level Hari Ini</h3>
                    <span class="text-sm text-gray-500" x-text="`${Math.round(progress / 50 * 2)} / 2`"></span>
                </div>
                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-100 ease-out"
                         :style="`width: ${progress}%;`"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600 flex items-center gap-1">
                    🎁 Badge “Penyuka Tantangan”
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
