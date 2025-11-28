@extends('layouts.student')

@section('title', 'Misi')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6" x-data>

    <!-- HEADER SAMA SEPERTI HALAMAN RULE -->
    <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

        <!-- Left: Logo + Judul -->
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/goal--v1.png"
                class="w-7 h-7 sm:w-8 sm:h-8" alt="Misi">

            <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Misi
            </h1>
        </div>

        <!-- Right: User (Desktop) -->
        <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
            <span class="text-gray-700 text-lg">
                Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>

            <div class="relative">
                <img src="/icons/blank.jpeg" alt="Avatar"
                    class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
                <span
                    class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>

        <!-- Right: Mobile Avatar -->
        <div class="sm:hidden relative">
            <img src="/icons/blank.jpeg" alt="Avatar"
                class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
            <span
                class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                Lv. 1
            </span>
        </div>
    </header>

    <!-- KONTEN UTAMA -->
    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 max-w-3xl mx-auto">
        <h2 class="text-center text-lg sm:text-xl font-fredoka font-bold text-[#EB580C] mb-6">
            Misi Harian
        </h2>

        <div class="flex flex-col gap-6">

            <!-- MISI 1 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4"
                x-data="{ current: 50, total: 50 }">

                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold text-base sm:text-lg">
                        Dapatkan 50 XP Hari Ini
                    </h3>

                    <span class="text-sm text-gray-500 whitespace-nowrap"
                        x-text="`${current}/${total}`"></span>
                </div>

                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-300 ease-out"
                        :style="`width: ${(current / total) * 100}%;`"></div>
                </div>

                <p class="mt-2 text-xs sm:text-sm text-gray-600 flex items-center gap-2">
                    <img src="https://img.icons8.com/color/48/gift--v1.png" class="w-5 h-5" alt="Reward">
                    +10 XP + Badge “Rajin Hari Ini”
                </p>
            </div>

            <!-- MISI 2 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4"
                x-data="{ current: 2, total: 5 }">

                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold text-base sm:text-lg">
                        Jawab 5 Soal Benar Berturut-turut
                    </h3>
                    <span class="whitespace-nowrap text-sm text-gray-500"
                        x-text="`${current} / ${total}`"></span>
                </div>

                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-300 ease-out"
                        :style="`width: ${(current / total) * 100}%;`"></div>
                </div>

                <p class="mt-2 text-xs sm:text-sm text-gray-600 flex items-center gap-2">
                    <img src="https://img.icons8.com/color/48/gift--v1.png" class="w-5 h-5">
                    +5 XP
                </p>
            </div>

            <!-- MISI 3 -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-4"
                x-data="{ current: 1, total: 2 }">

                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-[#EB580C] font-fredoka font-bold text-base sm:text-lg">
                        Selesaikan 2 Level Hari Ini
                    </h3>
                    <span class="whitespace-nowrap text-sm text-gray-500"
                        x-text="`${current} / ${total}`"></span>
                </div>

                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FBBF24] rounded-full transition-all duration-300 ease-out"
                        :style="`width: ${(current / total) * 100}%;`"></div>
                </div>

                <p class="mt-2 text-xs sm:text-sm text-gray-600 flex items-center gap-2">
                    <img src="https://img.icons8.com/color/48/prize.png" class="w-5 h-5">
                    Badge “Penyuka Tantangan”
                </p>
            </div>

        </div>
    </div>

</div>
@endsection