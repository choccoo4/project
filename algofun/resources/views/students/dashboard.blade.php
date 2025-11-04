@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6">

    <!-- Header -->
    <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4">
        <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-2 font-fredoka">
            <img src="https://img.icons8.com/doodle/48/control-panel.png" class="w-8 h-8" alt="Dashboard">
            Dashboard Siswa
        </h1>
        <div class="flex items-center space-x-4 font-nunito-semibold">
            <span class="text-gray-700 text-lg">Halo,
                <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="/icons/avatar-hero.png" alt="Avatar" class="w-15 h-15 rounded-full border-4 border-[#EB580C] shadow-md">
                <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
    </header>

    <!-- Grid utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Progress Belajar -->
        <div class="col-span-2 bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 font-fredoka text-[#555555]">
                <img src="https://img.icons8.com/scribby/50/positive-dynamic.png" class="w-6 h-6" alt="Progress">
                Progress Belajar
            </h2>

            <!-- Level Aktif -->
            <div class="bg-orange-400 text-white p-4 rounded-xl shadow-lg mb-6 hover:shadow-xl transition">
                <p class="font-bold text-lg heading-font">Level Aktif: Desa Pemula</p>
                <p class="text-sm opacity-90">Selesaikan semua tantangan untuk membuka Level 2</p>
                <div class="mt-3 w-full bg-white rounded-full h-4 overflow-hidden">
                    <div class="bg-pink-500 h-4 rounded-full animate-[grow_2s_ease-out_forwards]" style="width: 70%;"></div>
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

            <div class="grid grid-cols-2 gap-4">
                <!-- Pemula Hebat (bintang kuning → card biru lembut biar kontras) -->
                <div class="flex flex-col items-center justify-center bg-blue-200 text-gray-800 p-4 rounded-xl shadow hover:scale-110 hover:rotate-2 transition">
                    <img src="https://img.icons8.com/keek/100/filled-star.png" class="w-10 h-10 mb-2">
                    <span class="font-semibold text-sm">Pemula Hebat</span>
                </div>

                <!-- Juara Level 1 (ikon piala emas → card hijau lembut biar kontras) -->
                <div class="flex flex-col items-center justify-center bg-green-200 text-gray-800 p-4 rounded-xl shadow hover:scale-110 hover:rotate-2 transition">
                    <img src="https://img.icons8.com/keek/100/trophy.png" class="w-10 h-10 mb-2">
                    <span class="font-semibold text-sm">Juara Level 1</span>
                </div>

                <!-- Lencana terkunci -->
                <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-400 p-4 rounded-xl shadow-inner">
                    <img src="https://img.icons8.com/color/48/lock--v1.png" class="w-8 h-8 mb-2 opacity-60">
                    <span class="font-semibold text-sm">Terkunci</span>
                </div>
                <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-400 p-4 rounded-xl shadow-inner">
                    <img src="https://img.icons8.com/color/48/lock--v1.png" class="w-8 h-8 mb-2 opacity-60">
                    <span class="font-semibold text-sm">Terkunci</span>
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
    <div class="mt-8 bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row justify-between items-center border-l-8 border-orange-400">
        <div class="flex items-start gap-3">
            <div class="bg-yellow-100 p-3 rounded-full shadow-inner">
                <img src="https://img.icons8.com/color/48/idea.png" alt="Insight" class="w-6 h-6">
            </div>
            <div>
                <h2 class="text-lg font-bold text-[#EB580C] mb-1 font-fredoka">Evaluasi Diri (AI Insight)</h2>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Kamu masih lemah di <b>“Soal Cerita Bilangan Cacah sampai 10.000”</b><br>
                    Latih lagi bagian ini biar naik level lebih cepat!
                </p>
            </div>
        </div>

        <div class="mt-4 md:mt-0">
            <a href="{{ url('/latihan') }}"
                class="bg-[#FFB84C] hover:bg-[#FFA500] text-white font-semibold px-5 py-2 rounded-full shadow-md transition font-fredoka">
                Latihan Lagi
            </a>
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
    <div class="mt-6 bg-blue-50 rounded-2xl shadow p-6 hover:shadow-md transition">
        <h2 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2 heading-font">
            <img src="https://img.icons8.com/scribby/50/info.png" class="w-5 h-5"> Tahukah Kamu?
        </h2>
        <p class="text-gray-700 text-sm">Algoritma itu seperti resep masakan. Kalau ikuti langkahnya, hasilnya pasti jadi!</p>
    </div>

    <!-- Floating Button: + Kelas -->
    <button
        @click="window.location.href='{{ url('/kelas/tambah') }}'"
        class="fixed bottom-6 right-6 flex items-center gap-2 rounded-full border-2 border-[#8EE000] bg-white text-[#555555] font-semibold shadow-md hover:shadow-[#8EE000]/40 px-5 py-3 transition-all duration-300 hover:scale-105">
        <img src="https://img.icons8.com/?size=100&id=63650&format=png&color=000000" alt="Tambah" class="w-5 h-5">
        <span class="hidden sm:inline font-fredoka">Kelas</span>
    </button>


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