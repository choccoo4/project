@extends('layouts.teacher')

@section('title', 'Papan Skor')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6 relative">

    <!-- Header -->
    <header class="mb-6 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

        <!-- Left: Icon + Judul -->
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/trophy.png"
                class="w-7 h-7 sm:w-8 sm:h-8" alt="Daftar Kelas">

            <h1 class="text-lg sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Papan Skor
            </h1>
        </div>

        <!-- Right: User greeting (HIDE di mobile) -->
        <div class="hidden sm:flex items-center space-x-4 font-nunito">
            <img src="https://img.icons8.com/color/96/appointment-reminders.png"
                class="w-8 h-8" alt="Notifikasi">
            <span class="text-gray-700 text-lg">
                Halo, <b class="text-[#EB580C]">Septia</b>
            </span>
        </div>

    </header>

    {{-- CARD PAPAN SKOR --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full max-w-2xl mx-auto">

        {{-- ICON TROPHY BESAR --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('icons/big-trophy.png') }}"
                class="w-32 h-32 sm:w-48 sm:h-48 object-contain" alt="Trophy Besar">
        </div>

        <!-- Dropdown Kelas -->
        <div class="flex justify-end mb-4">
            <div x-data="{ open: false, selected: 'Kelas' }" class="relative">
                <button @click="open = !open"
                    class="flex items-center justify-between w-28 sm:w-32 bg-white border border-gray-400 rounded-lg px-3 py-1.5 text-gray-700 font-semibold text-sm shadow-sm">
                    <span x-text="selected"></span>
                    <img src="https://img.icons8.com/ios-glyphs/14/000000/expand-arrow--v2.png">
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 mt-2 w-28 sm:w-32 bg-white border border-gray-300 rounded-lg shadow-md">
                    <ul class="text-gray-700 text-sm font-medium">
                        <li @click="selected='3A'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3A</li>
                        <li @click="selected='3B'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3B</li>
                        <li @click="selected='3C'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3C</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Garis -->
        <div class="w-full border-t border-gray-300 mb-4"></div>

        {{-- DAFTAR PAPAN SKOR --}}
        <div class="divide-y divide-gray-200">
            @php
            $papanSkor = [
            ['rank' => 1, 'nama' => 'Chocco', 'xp' => 320, 'medal' => 'gold.png'],
            ['rank' => 2, 'nama' => 'Latte', 'xp' => 290, 'medal' => 'silver.png'],
            ['rank' => 3, 'nama' => 'Mocca', 'xp' => 275, 'medal' => 'bronze.png'],
            ['rank' => 4, 'nama' => 'Cowi', 'xp' => 265, 'medal' => null],
            ['rank' => 5, 'nama' => 'Molly', 'xp' => 265, 'medal' => null],
            ['rank' => 6, 'nama' => 'Oreo', 'xp' => 250, 'medal' => null],
            ];
            @endphp

            @foreach ($papanSkor as $item)
            <div class="flex items-center justify-between py-3 gap-3">

                {{-- Rank --}}
                <div class="w-8 sm:w-10 text-center font-bold text-gray-600">
                    @if ($item['medal'])
                    <img src="{{ asset('icons/'.$item['medal']) }}" class="w-5 h-5 sm:w-6 sm:h-6 mx-auto">
                    @else
                    {{ $item['rank'] }}
                    @endif
                </div>

                {{-- Nama + Avatar --}}
                <div class="flex items-center gap-3 flex-1">
                    <img src="{{ asset('icons/avatar-hero.png') }}"
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-200">
                    <span class="font-semibold text-gray-800 text-sm sm:text-base">
                        {{ $item['nama'] }}
                    </span>
                </div>

                {{-- XP --}}
                <div class="text-[#FF7A00] font-bold text-sm sm:text-base whitespace-nowrap">
                    {{ $item['xp'] }} XP
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection