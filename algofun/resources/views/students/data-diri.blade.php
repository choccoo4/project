@extends('layouts.student')

@section('title', 'Data Diri')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6">

  <!-- Header -->
  <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

    <!-- Left: Logo + Judul -->
    <div class="flex items-center gap-3">
      <!-- Logo kecil -->
      <img src="https://img.icons8.com/color/96/user.png"
        class="w-7 h-7 sm:w-8 sm:h-8" alt="Data Diri">

      <!-- Judul -->
      <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
        Data Diri
      </h1>
    </div>

    <!-- Right: User (Desktop Only) -->
    <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
      </span>

      <div class="relative">
        <img src="/icons/avatar-hero.png" alt="Avatar"
          class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>

    <!-- Right: Avatar (Mobile Only) -->
    <div class="sm:hidden relative">
      <img src="/icons/avatar-hero.png" alt="Avatar"
        class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
      <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
        Lv. 1
      </span>
    </div>
  </header>

  {{-- FORM CARD --}}
  <div class="w-full max-w-4xl bg-white rounded-2xl shadow p-6 sm:p-10 border border-[#E7E7E7]">

    {{-- FOTO PROFIL --}}
    <div class="flex flex-col items-center mb-10 relative">
      <div class="relative">
        <img src="{{ asset('icons/avatar-hero.png') }}"
          class="w-32 sm:w-40 h-32 sm:h-40 rounded-xl border border-gray-300 bg-[#FFF8F2] object-cover"
          alt="Profile">
        <button class="absolute bottom-2 right-2 bg-white border border-gray-300 rounded-full p-2 shadow-sm hover:bg-gray-100">
          <img src="https://img.icons8.com/ios-glyphs/20/EB580C/edit.png" alt="Edit" class="w-4 h-4">
        </button>
      </div>
    </div>

    {{-- FORM DATA DIRI --}}
    <form class="space-y-6 sm:space-y-8 font-nunito text-gray-700">

      {{-- Kelasku --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4">
        <label class="font-semibold text-right sm:pr-6 pt-2">Kelasku</label>
        <div class="col-span-2 bg-[#FFF8E7] border border-[#EB580C]/40 rounded-xl p-4 flex justify-between items-center">
          {{-- Kiri: Nama Kelas + Guru --}}
          <div>
            <p class="font-bold text-[#EB580C] text-lg">{{ $dataDiri['kelas'] ?? 'Matematik3D' }}</p>
            <p class="text-gray-600 text-sm">{{ $dataDiri['guru'] ?? 'Septia Riski Masturiy' }}</p>
          </div>

          {{-- Kanan: Tombol keluar kelas --}}
          <button type="button"
            class="hover:bg-gray-200 rounded-full p-2 transition flex-shrink-0">
            <img src="https://img.icons8.com/ios-glyphs/24/fa314a/delete-sign.png" alt="Keluar Kelas" class="w-5 h-5">
          </button>
        </div>
      </div>

      {{-- Nama Lengkap --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4">
        <label class="font-semibold text-right sm:pr-6">Nama Lengkap</label>
        <input type="text" value="{{ $dataDiri['nama_lengkap'] }}"
          class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none focus:ring-2 focus:ring-[#EB580C]">
      </div>

      {{-- Nama Pengguna --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4">
        <label class="font-semibold text-right sm:pr-6">Nama Pengguna</label>
        <input type="text" value="{{ $dataDiri['nama_pengguna'] }}"
          class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none focus:ring-2 focus:ring-[#EB580C]">
      </div>

      {{-- Email --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4">
        <label class="font-semibold text-right sm:pr-6">Email</label>
        <input type="email" value="{{ $dataDiri['email'] }}"
          class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none focus:ring-2 focus:ring-[#EB580C]">
      </div>

      {{-- Asal Sekolah --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
        <label class="font-semibold text-right sm:pr-6 pt-2">Asal Sekolah</label>
        <div class="col-span-2 space-y-3">
          <select @change="otherSchool = $event.target.value === 'lainnya'"
            class="w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-white text-[#333] focus:outline-none">
            <option value="">-- Pilih Sekolah --</option>
            <option value="SD Negeri 001">SD Negeri 001</option>
            <option value="SD Negeri 002">SD Negeri 002</option>
            <option value="SD Negeri 003">SD Negeri 003</option>
            <option value="lainnya">Lainnya...</option>
          </select>
          <div x-show="otherSchool" x-transition>
            <input type="text" placeholder="Tulis nama sekolah Anda"
              class="w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none">
          </div>
        </div>
      </div>

      {{-- NISN --}}
      <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4">
        <label class="font-semibold text-right sm:pr-6">NISN</label>
        <input type="text" value="{{ $dataDiri['nisn'] }}"
          class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none focus:ring-2 focus:ring-[#EB580C]">
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8 sm:mt-12">
        <button type="button"
          class="w-full sm:w-28 h-11 bg-[#F4F4F4] rounded-xl shadow-[0px_8px_4px_rgba(0,0,0,0.25)]
                               text-[#4C4C4C] text-lg font-fredoka font-semibold hover:bg-white/50 transition-all duration-300">
          Batal
        </button>
        <button type="submit"
          class="w-full sm:w-28 h-11 bg-[#8EE000] rounded-xl shadow-[0px_8px_4px_rgba(0,0,0,0.25)]
                               text-white text-lg font-fredoka font-semibold hover:bg-[#ff6a1f] transition-all duration-300">
          Simpan
        </button>
      </div>

    </form>
  </div>
</div>
@endsection