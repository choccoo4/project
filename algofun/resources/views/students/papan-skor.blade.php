@extends('layouts.student')

@section('title', 'Papan Skor')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6">

  <!-- Header -->
  <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 flex items-center justify-between">

    <!-- Left: Logo + Judul -->
    <div class="flex items-center gap-3">
      <img src="https://img.icons8.com/color/96/trophy.png" class="w-7 h-7 sm:w-8 sm:h-8" alt="Trophy">
      <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
        Papan Skor
      </h1>
    </div>

    <!-- Right: User info -->
    <!-- Desktop -->
    <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
      </span>
      <div class="relative">
        <img src="{{ asset('icons/avatar-hero.png') }}" alt="Avatar" class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>
    <!-- Mobile -->
    <div class="sm:hidden relative">
      <img src="{{ asset('icons/avatar-hero.png') }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
      <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
        Lv. 1
      </span>
    </div>
  </header>

  <!-- Card Papan Skor -->
  <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-2xl mx-auto">

    <!-- Trophy Icon -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('icons/big-trophy.png') }}" class="w-40 h-32 sm:w-50 sm:h-41" alt="Trophy Besar">
    </div>

    <!-- Garis -->
    <div class="w-full border-t border-gray-300 mb-4"></div>

    <!-- Daftar Papan Skor -->
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
        <!-- Rank -->
        <div class="w-10 text-center font-bold text-gray-600">
          @if ($item['medal'])
          <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-6 h-6 mx-auto">
          @else
          {{ $item['rank'] }}
          @endif
        </div>

        <!-- Nama + Avatar -->
        <div class="flex items-center gap-3 flex-1 min-w-0">
          <img src="{{ asset('icons/avatar-hero.png') }}"
            class="w-10 h-10 rounded-full border border-gray-200 flex-shrink-0" alt="Avatar">
          <span class="font-semibold text-gray-800 truncate">{{ $item['nama'] }}</span>
        </div>

        <!-- XP -->
        <div class="text-[#FF7A00] font-bold ml-4 flex-shrink-0">{{ $item['xp'] }} XP</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection