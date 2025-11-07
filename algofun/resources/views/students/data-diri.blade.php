@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6 flex flex-col items-center" x-data="{ editing: false }">

  {{-- HEADER --}}
  <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4 w-full max-w-6xl">
    <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-2 font-fredoka">
      <img src="https://img.icons8.com/color/96/user.png" class="w-8 h-8" alt="Data Diri">
      Data Diri
    </h1>
    <div class="flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ $dataDiri['nama_lengkap'] }}</b>
      </span>
      <div class="relative">
        <img src="/icons/avatar-hero.png" alt="Avatar"
             class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md cursor-pointer">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>
  </header>

  {{-- KONTEN --}}
  <div class="w-full max-w-4xl bg-white rounded-2xl shadow p-10">

    {{-- FOTO PROFIL (DI TENGAH) --}}
    <div class="flex flex-col items-center relative">
      <div class="relative">
        <img src="/icons/avatar-hero.png" 
             class="w-60 h-60 rounded-xl border-4 border-[#EB580C] object-cover shadow-md" 
             alt="Profile">
        <button class="absolute bottom-2 right-2 bg-[#EB580C] text-white rounded-full p-2 hover:bg-[#d94f0c] transition" 
                x-on:click="editing = !editing">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 3.732z" />
          </svg>
        </button>
      </div>

      {{-- XP & RUNTUNAN --}}
      <div class="flex justify-between w-full max-w-md mt-6">
        <div class="flex items-center gap-2 bg-[#FFF2CC] px-5 py-3 rounded-xl font-semibold text-gray-700 shadow">
          <img src="{{ asset('icons/runtutan.png') }}" alt="Runtunan Icon" class="w-6 h-6"> <span>{{ $dataDiri['runtunan_hari'] }}</span> <span class="text-sm">Runtunan Hari</span>
        </div>
        <div class="flex items-center gap-2 bg-[#FFE3B0] px-5 py-3 rounded-xl font-semibold text-gray-700 shadow">
         <img src="{{ asset('icons/xp.png') }}" alt="Xp Icon" class="w-6 h-6"> <span>{{ $dataDiri['total_xp'] }}</span> <span class="text-sm">Total XP</span>
        </div>
      </div>
    </div>

    {{-- FORM DATA DIRI (LABEL KIRI, INPUT KANAN) --}}
    <form class="mt-10 space-y-8">
      {{-- Kelas & Guru --}}
      <div>
        <label class="block font-semibold text-gray-700 mb-1">Kelasku</label>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-[#FFF8E7] border border-[#EB580C]/40 rounded-xl p-4">
          <div>
            <p class="font-bold text-[#EB580C] text-lg">{{ $dataDiri['kelas'] }}</p>
            <p class="text-gray-600 text-sm">Guru: <b>{{ $dataDiri['guru'] }}</b></p>
          </div>
          <button type="button" 
                  class="mt-2 sm:mt-0 bg-[#EB580C] hover:bg-[#d94f0c] text-white text-sm px-4 py-2 rounded-lg font-semibold shadow">
            Ganti Kelas
          </button>
        </div>
      </div>
        
        {{-- Nama Lengkap --}}
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 w-1/3">Nama Lengkap</span>
          <input type="text" value="{{ $dataDiri['nama_lengkap'] }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 w-2/3 focus:ring-2 focus:ring-[#EB580C]">
        </div>

        {{-- Nama Pengguna --}}
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 w-1/3">Nama Pengguna</span>
          <input type="text" value="{{ $dataDiri['nama_pengguna'] }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 w-2/3 focus:ring-2 focus:ring-[#EB580C]">
        </div>

        {{-- Email --}}
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 w-1/3">Email</span>
          <input type="email" value="{{ $dataDiri['email'] }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 w-2/3 focus:ring-2 focus:ring-[#EB580C]">
        </div>

        {{-- Asal Sekolah --}}
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 w-1/3">Asal Sekolah</span>
          <input type="text" value="{{ $dataDiri['asal_sekolah'] }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 w-2/3 focus:ring-2 focus:ring-[#EB580C]">
        </div>

        {{-- NISN --}}
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 w-1/3">NISN</span>
          <input type="text" value="{{ $dataDiri['nisn'] }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 w-2/3 focus:ring-2 focus:ring-[#EB580C]">
        </div>

      {{-- Tombol Simpan --}}
      <div class="flex justify-end pt-4">
        <button type="submit"
                class="bg-[#A3E635] hover:bg-[#84CC16] text-white font-semibold px-8 py-3 rounded-full shadow-md transition">
          Simpan
        </button>
      </div>
    </form>
   </div>
  </div>
</div>
@endsection
