@extends('layouts.student')

@section('title', 'Latihan')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6">

    <!-- Header -->
    <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 flex items-center justify-between">

        <!-- Left: Logo + Judul -->
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/controller.png" class="w-7 h-7 sm:w-8 sm:h-8" alt="Latihan">
            <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Latihan
            </h1>
        </div>

        <!-- Right: User info -->
        <!-- Desktop -->
        <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
            <span class="text-gray-700 text-lg">
                Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="/icons/avatar-hero.png" alt="Avatar" class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
                <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
        <!-- Mobile -->
        <div class="sm:hidden relative">
            <img src="/icons/avatar-hero.png" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
            <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                Lv. 1
            </span>
        </div>
    </header>

    <!-- Konten Utama -->
    <div class="flex flex-col gap-6">

        <!-- Section: Intro -->
        <div class="bg-white rounded-2xl shadow p-5">
            <h2 class="text-xl font-fredoka font-bold text-[#EB580C] mb-2">
                Latihan Tambahan untuk Kamu!
            </h2>
            <p class="text-gray-700 font-nunito text-sm sm:text-base">
                Kita lihat yuk, bagian mana yang perlu kamu latih lagi supaya makin jago!
            </p>
        </div>

        <!-- Section: Materi yang Perlu Dilatih -->
        <div class="bg-white rounded-2xl shadow p-5 border-l-[10px] border-[#EB580C]">
            <h3 class="text-lg font-fredoka font-bold text-[#EB580C] mb-6 flex items-center gap-2">
                <img src="https://img.icons8.com/scribby/50/book.png" class="w-6 h-6">
                Materi yang Perlu Kamu Latih:
            </h3>

            <div class="flex flex-col gap-6">

                <!-- CARD TEMPLATE -->
                @foreach([
                ['bg'=>'bg-blue-200','level'=>'Level 1. Bilangan Dasar','desc'=>'Membandingkan & Mengurutkan Bilangan','xp'=>30],
                ['bg'=>'bg-green-200','level'=>'Level 1. Bilangan Dasar','desc'=>'Nilai tempat (puluhan dan ratusan)','xp'=>30],
                ['bg'=>'bg-purple-200','level'=>'Level 2. Operasi Hitung Dasar','desc'=>'Penjumlahan & Pengurangan 2 Angka','xp'=>30]
                ] as $card)
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center {{ $card['bg'] }} rounded-2xl shadow-md p-5 gap-4 sm:gap-0">
                    <div class="flex-1">
                        <p class="font-fredoka text-[#333] text-base mb-1"><b>{{ $card['level'] }}</b></p>
                        <p class="text-gray-700 text-sm mb-2">{{ $card['desc'] }}</p>
                        <p class="text-sm text-gray-600 flex items-center gap-1">
                            ⚡ XP Potensial: <b>+{{ $card['xp'] }} XP</b>
                        </p>
                    </div>
                    <button class="mt-3 sm:mt-0 bg-[#FFB84C] hover:bg-[#FFA500] text-white font-bold px-5 py-3 rounded-full shadow hover:scale-105 transition font-fredoka w-full sm:w-auto text-center">
                        Latihan Lagi
                    </button>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection