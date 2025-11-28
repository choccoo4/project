@extends('layouts.student')

@section('title', 'Lencana')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6" x-data>
  <!-- Header -->
  <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

    <!-- Left: Logo + Judul -->
    <div class="flex items-center gap-3">
      <!-- Logo kecil -->
      <img src="https://img.icons8.com/color/96/medal.png"
        class="w-7 h-7 sm:w-8 sm:h-8" alt="Aturan">

      <!-- Judul -->
      <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
        Lencana
      </h1>
    </div>

    <!-- Right: User (Desktop Only) -->
    <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
      </span>

      <div class="relative">
        <img src="/icons/blank.jpeg" alt="Avatar"
          class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>

    <!-- Right: Avatar (Mobile Only) -->
    <div class="sm:hidden relative">
      <img src="/icons/blank.jpeg" alt="Avatar"
        class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
      <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
        Lv. 1
      </span>
    </div>
  </header>

  {{-- KONTEN LENCANA --}}
  <div class="bg-white rounded-2xl shadow-lg p-8 mx-auto max-w-5xl animate-slide-in">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      {{-- LENCANA TEMPLATE --}}
      @foreach ($badges as $badge)
      @php
      $percent = ($badge['progress'] / $badge['target']) * 100;
      @endphp
      <div class="rounded-2xl shadow-md p-4 flex flex-col sm:flex-row items-center gap-4 transform transition-all duration-300 hover:scale-105 hover:-rotate-2 {{ $badge['warna'] }}">

        {{-- IKON DI KIRI (atau atas di HP) --}}
        <img src="{{ asset($badge['ikon']) }}"
          alt="{{ $badge['nama'] }}"
          class="w-20 h-20 transition-transform duration-300 hover:scale-110 flex-shrink-0">

        {{-- TEKS & PROGRESS DI KANAN --}}
        <div class="flex-1 text-center sm:text-left">
          <h3 class="font-fredoka font-bold text-gray-800 text-lg">{{ $badge['nama'] }}</h3>
          <p class="text-sm text-gray-500">{{ $badge['deskripsi'] }}</p>
          <div class="mt-2 bg-gray-200 rounded-full h-2.5 w-full overflow-hidden">
            <div class="bg-yellow-400 h-full rounded-full animate-bar" style="width: {{ $percent }}%"></div>
          </div>
          <p class="text-xs text-gray-400 mt-1">{{ $badge['progress'] }}/{{ $badge['target'] }}</p>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>

{{-- STYLE --}}
<style>
  @keyframes slideIn {
    from {
      transform: translateX(50px);
      opacity: 0;
    }

    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes growBar {
    from {
      width: 0;
    }
  }

  .animate-slide-in {
    animation: slideIn 0.8s ease-out;
  }

  .animate-bar {
    animation: growBar 1.2s ease-out forwards;
  }
</style>
@endsection