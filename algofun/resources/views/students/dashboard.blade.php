{{-- FILE: resources/views/siswa/dashboard.blade.php --}}

@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')

<div x-data="{ 
    loading: true, 
    openModal: false, 
    modalLoading: false,
    kode: '' 
}" 
x-init="setTimeout(() => loading = false, 1000)">

    {{-- ========== SKELETON ========== --}}
    <div x-show="loading" 
         x-transition:leave="transition ease-in duration-300">
        <x-dashboard-skeleton type="student" />
    </div>

    {{-- ========== KONTEN ASLI ========== --}}
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">

        <div class="min-h-screen bg-[#FFF8F2] p-6">

            <!-- Header -->
            <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
            flex items-center justify-between">

                <!-- Left: Logo + Judul -->
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/doodle/48/control-panel.png"
                        class="w-7 h-7 sm:w-8 sm:h-8" alt="Dashboard">

                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                        Dashboard Siswa
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
                        <span
                            class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                            Lv. 1
                        </span>
                    </div>
                </div>

                <!-- Right: Avatar (Mobile Only) -->
                <div class="sm:hidden relative">
                    <img src="/icons/blank.jpeg" alt="Avatar"
                        class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
                    <span
                        class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                        Lv. 1
                    </span>
                </div>
            </header>

            <!-- Grid utama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Progress Belajar -->
                <div class="col-span-2 bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 font-fredoka text-[#555555]">
                        <img src="https://img.icons8.com/scribby/50/positive-dynamic.png" class="w-6 h-6" alt="Progress">
                        Perkembangan Belajar
                    </h2>

                    <!-- Level Aktif -->
                    <div class="bg-[#EB580C] text-white p-4 rounded-xl shadow-lg mb-6 hover:shadow-xl transition">
                        <p class="font-bold text-lg heading-font">Level Aktif: Desa Pemula</p>
                        <p class="text-sm opacity-90">Selesaikan semua tantangan untuk membuka Level 2</p>
                        <div class="mt-3 w-full bg-white rounded-full h-4 overflow-hidden">
                            <div class="bg-[#FFC338] h-4 rounded-full animate-[grow_2s_ease-out_forwards]" style="width: 70%;"></div>
                        </div>
                        <p class="text-sm mt-1">XP: 70 / 100</p>
                    </div>

                    <!-- Level Berikutnya -->
                    <div class="bg-gray-200 text-gray-600 p-4 rounded-xl shadow-inner">
                        <p class="font-bold text-lg flex items-center gap-2">
                            <img src="https://img.icons8.com/color/48/lock--v1.png" class="w-5 h-5"> Level Berikutnya: Hutan Simbolik
                        </p>
                        <p class="text-sm opacity-80">Terkunci. Selesaikan Level 1 untuk membuka.</p>
                    </div>
                </div>

                <!-- Lencana -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2 font-fredoka text-[#555555]">
                        <img src="https://img.icons8.com/external-febrian-hidayat-outline-color-febrian-hidayat/50/external-02-awards-febrian-hidayat-outline-color-febrian-hidayat.png"
                            class="w-6 h-6" alt="Badge">
                        Lencana
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 gap-4">
                        <div class="flex flex-col items-center justify-center bg-blue-200 text-gray-800 p-4 rounded-xl shadow hover:scale-105 transition">
                            <img src="https://img.icons8.com/keek/100/filled-star.png" class="w-10 h-10 mb-2">
                            <span class="font-semibold text-xs sm:text-sm text-center">Pemula Hebat</span>
                        </div>

                        <div class="flex flex-col items-center justify-center bg-green-200 text-gray-800 p-4 rounded-xl shadow hover:scale-105 transition">
                            <img src="https://img.icons8.com/keek/100/trophy.png" class="w-10 h-10 mb-2">
                            <span class="font-semibold text-xs sm:text-sm text-center">Juara Level 1</span>
                        </div>

                        <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-400 p-4 rounded-xl shadow-inner">
                            <img src="https://img.icons8.com/color/48/lock--v1.png" class="w-8 h-8 mb-2 opacity-60">
                            <span class="font-semibold text-xs sm:text-sm text-center">Terkunci</span>
                        </div>

                        <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-400 p-4 rounded-xl shadow-inner">
                            <img src="https://img.icons8.com/color/48/lock--v1.png" class="w-8 h-8 mb-2 opacity-60">
                            <span class="font-semibold text-xs sm:text-sm text-center">Terkunci</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tantangan Harian -->
            <div class="mt-8 bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold mb-6 flex items-center gap-2 font-fredoka text-[#555555]">
                    <img src="https://img.icons8.com/scribby/50/goal.png" class="w-6 h-6" alt="Mission">
                    Tantangan Harian
                </h2>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 bg-orange-100 p-3 rounded-xl border-l-4 border-orange-400 hover:shadow-md transition text-gray-800">
                        <img src="https://img.icons8.com/scribby/50/todo-list.png" class="w-6 h-6">
                        <span>Selesaikan 3 soal latihan hari ini</span>
                    </li>
                    <li class="flex items-center gap-3 bg-green-100 p-3 rounded-xl border-l-4 border-green-400 hover:shadow-md transition text-gray-800">
                        <img src="https://img.icons8.com/scribby/50/flash-on.png" class="w-6 h-6">
                        <span>Kumpulkan 50 XP dari misi</span>
                    </li>
                    <li class="flex items-center gap-3 bg-blue-100 p-3 rounded-xl border-l-4 border-blue-400 hover:shadow-md transition text-gray-800">
                        <img src="https://img.icons8.com/color/48/unlock.png" class="w-6 h-6">
                        <span>Buka 1 level baru</span>
                    </li>
                </ul>
            </div>

            <!-- Evaluasi Diri (AI Insight) -->
            <div class="mt-8 bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-l-8 border-orange-400">

                <!-- Icon + Text -->
                <div class="flex items-start gap-3">
                    <div class="bg-yellow-100 p-3 rounded-full shadow-inner hidden sm:flex">
                        <img src="https://img.icons8.com/color/48/idea.png" alt="Insight" class="w-6 h-6">
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[#EB580C] mb-1 font-fredoka">Evaluasi Diri (AI Insight)</h2>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Kamu masih lemah di <b>"Soal Cerita Bilangan Cacah sampai 10.000"</b><br>
                            Latih lagi bagian ini biar naik level lebih cepat!
                        </p>
                    </div>
                </div>

                <!-- Button -->
                <div class="mt-4 md:mt-0 w-full md:w-auto">
                    <x-button
                        variant="warning"
                        href="{{ url('/latihan') }}"
                        class="w-full sm:w-auto">
                        Latihan Lagi
                    </x-button>
                </div>
            </div>

            <!-- Reward Harian -->
            <div class="mt-8 bg-yellow-100 rounded-2xl shadow p-6 flex items-center justify-between hover:scale-[1.02] transition">
                <div>
                    <h2 class="text-lg font-bold text-yellow-700 font-fredoka">Reward Harian</h2>
                    <p class="text-sm text-yellow-700">Login 3 hari berturut-turut untuk dapat bonus XP!</p>
                </div>
                <img src="https://img.icons8.com/scribby/50/gift.png" class="w-12 h-12 hover:rotate-12 transition">
            </div>

            <!-- Fun Fact / Tips -->
            <div class="mt-6 bg-blue-50 rounded-2xl shadow p-6 hover:scale-[1.02] transition">
                <h2 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2 heading-font">
                    <img src="https://img.icons8.com/scribby/50/info.png" class="w-5 h-5"> Tahukah Kamu?
                </h2>
                <p class="text-gray-700 text-sm">Algoritma itu seperti resep masakan. Kalau ikuti langkahnya, hasilnya pasti jadi!</p>
            </div>

            <!-- Floating Button: + Kelas -->
            <x-button
                variant="floating"
                icon="https://img.icons8.com/?size=100&id=63650&format=png&color=000000"
                iconSize="md"
                @click="openModal = true; modalLoading = true; setTimeout(() => modalLoading = false, 600)"
                class="fixed bottom-20 md:bottom-6 right-6 z-40">
                <span class="hidden sm:inline">Kelas</span>
            </x-button>

        </div>
    </div>

    {{-- ========== MODAL SKELETON ========== --}}
    <div x-show="openModal && modalLoading" 
         x-transition.opacity>
        <x-modal-skeleton type="student" />
    </div>

    {{-- ========== MODAL ASLI ========== --}}
    <div x-show="openModal && !modalLoading" 
         x-transition.opacity
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

        <div @click.outside="openModal = false"
            class="bg-white w-[90%] max-w-md rounded-2xl p-6 shadow-lg border border-orange-100"
            x-transition.scale>

            <h2 class="font-fredoka text-2xl font-extrabold text-[#EB580C] mb-4 text-center">
                Gabung Kelas
            </h2>

            <form @submit.prevent class="space-y-5">

                <!-- Input Kode Kelas -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kode Kelas</label>
                    <input type="text"
                        x-model="kode"
                        placeholder="Masukkan kode kelas"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none uppercase tracking-widest"
                        maxlength="8">
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-3 mt-6">
                    <x-button variant="soft" type="button" @click="openModal = false">
                        Batal
                    </x-button>

                    <x-button variant="success" type="submit">
                        Gabung
                    </x-button>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- animasi keyframe progress bar -->
<style>
    @keyframes grow {
        from {
            width: 0%;
        }

        to {
            width: 70%;
        }
    }
</style>
@endsection