{{-- FILE: resources/views/guru/kelas/index.blade.php --}}

@extends('layouts.teacher')

@section('title', 'Daftar Kelas')

@section('content')

<div x-data="{ 
    loading: true,
    openModal: false, 
    modalLoading: false,
    kodeKelas: '' 
}" 
x-init="setTimeout(() => loading = false, 1000)">

    {{-- ========== SKELETON ========== --}}
    <div x-show="loading" 
         x-transition:leave="transition ease-in duration-300">
        <x-dashboard-skeleton type="teacher" />
    </div>

    {{-- ========== KONTEN ASLI ========== --}}
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">

        <div class="min-h-screen bg-[#FFF8F2] p-6 relative">

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
            <x-button
                variant="floating"
                icon="https://img.icons8.com/?size=100&id=63650&format=png&color=000000"
                iconSize="sm"
                @click="openModal = true; modalLoading = true; setTimeout(() => modalLoading = false, 600)"
                class="fixed bottom-20 md:bottom-6 right-6 hover:scale-105 hover:shadow-[#8EE000]/40 z-40">
                <span class="hidden sm:inline">Kelas</span>
            </x-button>

        </div>
    </div>

    {{-- ========== MODAL SKELETON ========== --}}
    <div x-show="openModal && modalLoading" 
         x-transition.opacity>
        <x-modal-skeleton type="teacher" />
    </div>

    {{-- ========== MODAL ASLI ========== --}}
    <div x-show="openModal && !modalLoading" 
         x-transition.opacity
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div @click.outside="openModal = false"
            class="bg-white w-[90%] max-w-md rounded-2xl p-6 shadow-lg border border-orange-100"
            x-transition.scale>

            <h2 class="font-fredoka text-2xl font-extrabold text-[#EB580C] mb-4 text-center">Buat Kelas</h2>

            <form x-data="{ kodeKelas: '' }" @submit.prevent class="space-y-5">

                <!-- Nama Kelas -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Kelas</label>
                    <input type="text" placeholder="Masukkan nama kelas"
                        class="form-input @error('nama_kelas') form-input-error @enderror">
                    @error('nama_kelas')
                    <p class="mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kode Kelas -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kode Kelas</label>
                    <div class="flex gap-2">
                        <input type="text" x-model="kodeKelas" placeholder="Klik buat kode"
                            class="form-input flex-1 @error('kode_kelas') form-input-error @enderror"
                            readonly>
                        <x-button
                            type="button"
                            variant="info"
                            size="sm"
                            @click="kodeKelas = Math.random().toString(36).substr(2, 6).toUpperCase()">
                            Buat kode
                        </x-button>
                    </div>
                    @error('kode_kelas')
                    <p class="mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3 mt-6">
                    <x-button
                        type="button"
                        variant="success"
                        size="sm">
                        Buat
                    </x-button>
                    <x-button
                        type="submit"
                        variant="primary"
                        size="sm">
                        Simpan
                    </x-button>
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