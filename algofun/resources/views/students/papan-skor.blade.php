@extends('layouts.student')

@section('content')
<div x-data="{ tab: 'mingguan' }" class="p-8 w-full bg-[#FFF8F2] min-h-screen font-nunito">

  {{-- HEADER --}}
  <header class="flex justify-between items-center bg-white rounded-2xl shadow-md px-8 py-4 mb-8">
    <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-3 font-fredoka">
      <img src="https://img.icons8.com/color/96/trophy.png" class="w-8 h-8" alt="Trophy">
      Papan Skor
    </h1>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Chocco' }}</b>
      </span>
      <div class="relative">
        <img src="{{ asset('icons/avatar-hero.png') }}" alt="Avatar"
          class="w-12 h-12 rounded-full border-4 border-[#EB580C] shadow">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>
  </header>

  {{-- TAB MENU --}}
  <div class="flex w-full max-w-2xl mx-auto bg-white rounded-t-2xl overflow-hidden shadow-md">
    <button @click="tab='mingguan'"
      :class="tab==='mingguan' ? 'bg-[#FFF2CC] text-[#EB580C]' : 'bg-white text-gray-700'"
      class="flex-1 py-3 font-semibold text-center transition">
      Mingguan
    </button>
    <button @click="tab='kelas'"
      :class="tab==='kelas' ? 'bg-[#FFF2CC] text-[#EB580C]' : 'bg-white text-gray-700'"
      class="flex-1 py-3 font-semibold text-center transition">
      Kelas Saya
    </button>
  </div>

  {{-- KONTEN --}}
  <div class="bg-white shadow-lg rounded-b-2xl p-8 w-full max-w-2xl mx-auto">
    <div x-show="tab==='mingguan'" x-cloak>
      {{-- ICON TROPHY BESAR --}}
      <div class="flex justify-center mb-6">
        <img src="{{ asset('icons/big-trophy.png') }}" class="w-50 h-41" alt="Trophy Besar">
      </div>

      {{-- TABEL PAPAN SKOR --}}
      <div class="divide-y divide-gray-200">
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
            <img src="{{ asset('icons/avatar-hero.png') }}" class="w-10 h-10 rounded-full border border-gray-200" alt="Avatar">
            <span class="font-semibold text-gray-800">{{ $item['nama'] }}</span>
          </div>

          {{-- XP --}}
          <div class="text-[#FF7A00] font-bold">{{ $item['xp'] }} XP</div>
        </div>
        @endforeach
      </div>
    </div>

    <div x-show="tab==='kelas'" x-cloak>
      <p class="text-center text-gray-500 py-10">Belum ada data untuk tab ini.</p>
    </div>
  </div>
</div>
@endsection