@extends('layouts.student')

@section('title', 'Peraturan')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6">

    <!-- Header -->
    <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

        <!-- Left: Logo + Judul -->
        <div class="flex items-center gap-3">
            <!-- Logo kecil -->
            <img src="https://img.icons8.com/color/96/info.png"
                class="w-7 h-7 sm:w-8 sm:h-8" alt="Aturan">

            <!-- Judul -->
            <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Aturan Main
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

    <!-- Konten Utama -->
    <div class="bg-white rounded-2xl shadow-lg p-6 max-w-3xl mx-auto">
        <h2 class="text-center text-xl font-fredoka font-bold text-[#EB580C] mb-6">
            Panduan Belajar di AlgoFun
        </h2>

        <div class="flex flex-col gap-6">

            <!-- Rule 1: Strukur Level -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/?size=100&id=O713QAUVtMnH&format=png&color=000000" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Struktur Level & Step</h3>
                </div>
                <ul class="text-gray-700 text-sm leading-relaxed space-y-2">
                    <li>• Belajar harus urut dari level 1 → terakhir.</li>
                    <li>• Tiap <b>level punya 5 step</b>.</li>
                    <li>• Step 1–4 = sub-bab (tanpa waktu, ada pengulangan soal salah).</li>
                    <li>• Step 5 = evaluasi level (20–25 soal, ada waktu).</li>
                </ul>
            </div>

            <!-- Rule 2: Penilaian XP -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/color/96/rating.png" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Penilaian & XP</h3>
                </div>
                <ul class="text-gray-700 text-sm leading-relaxed space-y-2">
                    <li>• Jawaban <b>benar & cepat</b> akan memberi XP yang lebih tinggi.</li>
                    <li>• Semakin lambat menjawab, XP yang diperoleh akan berkurang sedikit demi sedikit.</li>
                    <li>• Jawaban salah di Step 1–4 akan diulang di akhir, dan XP-nya lebih kecil dibanding jawaban langsung benar.</li>
                    <li>• Step 5 memberikan skor akhir dan XP kelulusan level.</li>
                </ul>
            </div>

            <!-- Rule 3: Streak -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/color/96/fire-element.png" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Streak</h3>
                </div>
                <p class="text-gray-700 text-sm">
                    Menyelesaikan minimal 1 pelajaran per hari menjaga streak tetap hidup.
                </p>
            </div>

            <!-- Rule 4: Waktu -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/color/96/clock--v1.png" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Batas Waktu</h3>
                </div>
                <p class="text-gray-700 text-sm">
                    Jika waktu habis saat Step 5, soal otomatis dianggap salah.
                </p>
            </div>

            <!-- Rule 5: Remedial -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/?size=100&id=12961&format=png&color=000000" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Remedial</h3>
                </div>
                <p class="text-gray-700 text-sm">
                    Jika nilai Step 5 <b>kurang dari 85</b>, kamu harus mengulang.
                </p>
            </div>

            <!-- Rule 6: Pengulangan Soal Salah -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/color/96/repeat.png" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Pengulangan Soal Salah</h3>
                </div>
                <p class="text-gray-700 text-sm text-sm">
                    Pada Step 1–4, soal yang salah akan muncul kembali di akhir pelajaran.
                </p>
            </div>

            <!-- Rule 7: Keluar Halaman -->
            <div class="bg-[#FFF8F2] rounded-xl border border-gray-200 shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://img.icons8.com/color/96/error--v1.png" class="w-7 h-7">
                    <h3 class="font-fredoka text-lg text-[#EB580C] font-bold">Keluar dari Halaman</h3>
                </div>
                <p class="text-gray-700 text-sm">
                    Jika kamu keluar saat kuis berlangsung, progres tidak akan tersimpan.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection