@extends('layouts.teacher')

@section('title', 'Papan Skor')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6 relative">
    <!-- Header Atas -->
    <header class="flex justify-between items-center mb-10 bg-white rounded-2xl shadow-md px-6 py-4 border border-orange-100">
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/trophy.png" alt="Daftar Kelas" class="w-9 h-9 animate-bounce-slow">
            <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C]">Papan Skor</h1>
        </div>
        <p class="text-gray-800 text-lg font-nunito">Halo, <b class="text-[#EB580C]">Septia</b></p>
    </header>

    {{-- CARD PAPAN SKOR --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-2xl mx-auto">
        {{-- ICON TROPHY BESAR --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('icons/big-trophy.png') }}" class="w-50 h-41" alt="Trophy Besar">
        </div>

        <!-- Dropdown Kelas -->
        <div class="flex justify-end mb-4">
            <div x-data="{ open: false, selected: 'Kelas' }" class="relative">
                <button @click="open = !open"
                    class="flex items-center justify-between w-32 bg-white border border-gray-400 rounded-lg px-3 py-1.5 text-gray-700 font-semibold text-sm shadow-sm">
                    <span x-text="selected"></span>
                    <img src="https://img.icons8.com/ios-glyphs/14/000000/expand-arrow--v2.png" alt="">
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 mt-2 w-32 bg-white border border-gray-300 rounded-lg shadow-md">
                    <ul class="text-gray-700 text-sm font-medium">
                        <li @click="selected='3A'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3A</li>
                        <li @click="selected='3B'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3B</li>
                        <li @click="selected='3C'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3C</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Garis -->
        <div class="w-full border-t border-gray-400 mb-2"></div>


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
            <div class="flex justify-between items-center py-3">
                {{-- Rank --}}
                <div class="w-10 text-center font-bold text-gray-600">
                    @if ($item['medal'])
                    <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-6 h-6 mx-auto">
                    @else
                    {{ $item['rank'] }}
                    @endif
                </div>

                {{-- Nama + Avatar --}}
                <div class="flex items-center gap-3 flex-1">
                    <img src="{{ asset('icons/avatar-hero.png') }}"
                        class="w-10 h-10 rounded-full border border-gray-200" alt="Avatar">
                    <span class="font-semibold text-gray-800">{{ $item['nama'] }}</span>
                </div>

                {{-- XP --}}
                <div class="text-[#FF7A00] font-bold">{{ $item['xp'] }} XP</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection