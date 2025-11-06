@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6">

    <!-- Header -->
    <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4">
        <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-2 font-fredoka">
            <img src="https://img.icons8.com/color/96/controller.png" class="w-8 h-8" alt="Latihan">
            Latihan
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
   <div class="flex flex-col gap-6">

    <!-- Section: Intro -->
    <div class="bg-white rounded-2xl shadow p-5">
        <h2 class="text-xl font-fredoka font-bold text-[#EB580C] mb-2">
            Latihan Tambahan untuk Kamu!
        </h2>
        <p class="text-gray-700 font-nunito">
            Kita lihat yuk, bagian mana yang perlu kamu latih lagi supaya makin jago!
        </p>
    </div>

    <!-- Section: Materi yang Perlu Dilatih -->
    <div class="bg-white rounded-2xl shadow p-5 border-l-[10px] border-[#EB580C]">
    <h3 class="text-lg font-fredoka font-bold text-[#EB580C] mb-6 flex items-center gap-2">
        <img src="https://img.icons8.com/scribby/50/book.png" class="w-6 h-6">
        Materi yang Perlu Kamu Latih:
    </h3>

    <div class="flex flex-col gap-8"> 

        <!-- CARD 1 -->
        <div class="bg-[#C8EEFF] rounded-2xl shadow-md p-5 flex justify-between items-center">
            <div>
                <p class="font-fredoka text-[#333] text-base mb-1"><b>Level 1. Bilangan Dasar</b></p>
                <p class="text-gray-700 text-sm mb-2">Membandingkan & Mengurutkan Bilangan</p>
                <p class="text-sm text-gray-600 flex items-center gap-1">
                    ⚡ XP Potensial: <b>+30 XP</b>
                </p>
            </div>
            <button
                class="bg-[#FFB84C] hover:bg-[#FFA500] text-white font-bold px-5 py-2 rounded-full shadow hover:scale-105 transition font-fredoka">
                Latihan Lagi
            </button>
        </div>

        <!-- CARD 2 -->
        <div class="bg-[#C2FFD7] rounded-2xl shadow-md p-5 flex justify-between items-center">
            <div>
                <p class="font-fredoka text-[#333] text-base mb-1"><b>Level 1. Bilangan Dasar</b></p>
                <p class="text-gray-700 text-sm mb-2">Nilai tempat (puluhan dan ratusan)</p>
                <p class="text-sm text-gray-600 flex items-center gap-1">
                    ⚡ XP Potensial: <b>+30 XP</b>
                </p>
            </div>
            <button
                class="bg-[#FFB84C] hover:bg-[#FFA500] text-white font-bold px-5 py-2 rounded-full shadow hover:scale-105 transition font-fredoka">
                Latihan Lagi
            </button>
        </div>

        <!-- CARD 3 -->
        <div class="bg-[#E5BFFF] rounded-2xl shadow-md p-5 flex justify-between items-center">
            <div>
                <p class="font-fredoka text-[#333] text-base mb-1"><b>Level 2. Operasi Hitung Dasar</b></p>
                <p class="text-gray-700 text-sm mb-2">Penjumlahan & Pengurangan 2 Angka</p>
                <p class="text-sm text-gray-600 flex items-center gap-1">
                    ⚡ XP Potensial: <b>+30 XP</b>
                </p>
            </div>
            <button
                class="bg-[#FFB84C] hover:bg-[#FFA500] text-white font-bold px-5 py-2 rounded-full shadow hover:scale-105 transition font-fredoka">
                Latihan Lagi
            </button>
        </div>
    </div>
</div>


</div>
@endsection
