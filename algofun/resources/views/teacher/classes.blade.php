@extends('layouts.teacher')

@section('title', 'Daftar Kelas')

@section('content')
<div x-data="{ openModal: false, kodeKelas: '' }" class="min-h-screen bg-[#FFF8F2] p-6 relative">

    <!-- Header -->
    <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

        <!-- Left: Icon + Judul -->
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/class.png"
                class="w-7 h-7 sm:w-8 sm:h-8" alt="Dashboard">

            <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Daftar Kelas
            </h1>
        </div>

        <!-- Right: User greeting (Desktop only) -->
        <div class="hidden sm:flex items-center space-x-4 font-nunito">
            <img src="https://img.icons8.com/color/96/appointment-reminders.png" class="w-8 h-8" alt="Notifikasi">
            <span class="text-gray-700 text-lg">
                Halo, <b class="text-[#EB580C]">Septia</b>
            </span>
        </div>

    </header>

    <!-- Grid Kelas -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-orange-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $kelasList = [
            ['nama' => 'Matematika 3D', 'warna' => 'bg-orange-400'],
            ['nama' => 'Kelas B', 'warna' => 'bg-lime-400'],
            ['nama' => 'Kelas C', 'warna' => 'bg-sky-300'],
            ];
            @endphp

            @foreach ($kelasList as $kelas)
            <a href="{{ route('guru.kelas.show', ['id' => 1]) }}">
                <div
                    class="{{ $kelas['warna'] }} rounded-2xl shadow-md p-6 flex flex-col items-center justify-center 
        transform hover:-translate-y-1 hover:rotate-1 transition-all duration-300 cursor-pointer">
                    <img src="https://img.icons8.com/color/96/conference-call--v1.png"
                        alt="Kelas" class="w-24 h-24 mb-3 drop-shadow-md">
                    <h2 class="text-xl font-nunito font-bold text-black">{{ $kelas['nama'] }}</h2>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Floating Button -->
    <button
        @click="openModal = true"
        class="fixed bottom-20 md:bottom-6 right-6 flex items-center gap-2 rounded-full border-2 border-[#8EE000] bg-white text-[#555555] font-semibold shadow-md hover:shadow-[#8EE000]/40 px-5 py-3 transition-all duration-300 hover:scale-105 z-40">
        <img src="https://img.icons8.com/?size=100&id=63650&format=png&color=000000" alt="Tambah" class="w-5 h-5">
        <span class="hidden sm:inline font-fredoka">Kelas</span>
    </button>


    <!-- Modal Tambah Kelas -->
    <div x-show="openModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div @click.outside="openModal = false"
            class="bg-white w-[90%] max-w-md rounded-2xl p-6 shadow-lg border border-orange-100"
            x-transition.scale>

            <h2 class="font-fredoka text-2xl font-extrabold text-[#EB580C] mb-4 text-center">Buat Kelas</h2>

            <form @submit.prevent class="space-y-5">

                <!-- Nama Kelas -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Kelas</label>
                    <input type="text" placeholder="Masukkan nama kelas"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>

                <!-- Kode Kelas -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kode Kelas</label>
                    <div class="flex gap-2">
                        <input type="text" x-model="kodeKelas" placeholder="Klik buat kode"
                            class="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                            readonly>
                        <button type="button"
                            @click="kodeKelas = Math.random().toString(36).substr(2, 6).toUpperCase()"
                            class="font-fredoka bg-[#8EE000] text-white font-semibold px-4 py-2 rounded-lg hover:bg-lime-500 transition-all duration-200">
                            Buat
                        </button>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                        @click="openModal = false"
                        class="font-fredoka px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="font-fredoka px-5 py-2 bg-[#EB580C] text-white rounded-lg font-semibold hover:bg-orange-500 transition-all duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Animasi tambahan -->
<style>
    .animate-bounce-slow {
        animation: bounce-slow 2.5s infinite;
    }
</style>
@endsection