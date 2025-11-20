@extends('layouts.teacher')

@section('title', 'Pengaturan Kelas')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] flex">
    <div class="flex-1 px-4 sm:px-8 py-6 sm:py-8">

        {{-- Header --}}
        <header class="mb-6 sm:mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

            <!-- Left: Icon + Judul -->
            <div class="flex items-center gap-3 min-w-0">
                <img src="https://img.icons8.com/color/96/school-building.png"
                    class="w-7 h-7 sm:w-8 sm:h-8" alt="Daftar Kelas">

                <h1 class="text-lg sm:text-2xl font-extrabold text-[#EB580C] font-fredoka truncate">
                    Matematika 3D
                </h1>
            </div>

            <!-- Right: User greeting (Desktop only) -->
            <div class="hidden sm:flex items-center space-x-4 font-nunito">
                <img src="https://img.icons8.com/color/96/appointment-reminders.png" class="w-7 h-7" alt="Notifikasi">
                <span class="text-gray-700 text-lg">
                    Halo, <b class="text-[#EB580C]">Septia</b>
                </span>
            </div>

        </header>

        {{-- Tabs --}}
        <div class="bg-white rounded-2xl shadow-md px-4 sm:px-8 py-6">

            {{-- Tabs — scrollable on mobile --}}
            <div class="flex border-b border-gray-300 mb-6 overflow-x-auto no-scrollbar">
                <a href="{{ route('guru.kelas.show', ['id' => 1]) }}"
                    class="px-4 sm:px-6 pb-3 text-xl sm:text-2xl font-fredoka font-semibold 
                    text-neutral-600 border-b-4 border-transparent 
                    hover:border-orange-400 hover:text-[#EB580C] transition">
                    Siswa
                </a>

                <a href="{{ route('guru.kelas.settings', ['id' => 1]) }}"
                    class="px-4 sm:px-6 pb-3 text-xl sm:text-2xl font-fredoka font-semibold 
                    text-[#EB580C] border-b-4 border-orange-400">
                    Pengaturan
                </a>
            </div>

            {{-- Info Kelas --}}
            <div class="mt-6 sm:mt-8">
                <h2 class="font-fredoka text-2xl sm:text-3xl text-[#EB580C] font-bold mb-6">
                    Info Kelas
                </h2>

                <form x-data="{ namaKelas: 'Matematika 3D' }" class="space-y-6">

                    {{-- Kode Kelas --}}
                    <div>
                        <label class="block text-lg sm:text-xl font-bold text-gray-800 font-nunito mb-2">
                            Kode Kelas
                        </label>
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 shadow-sm 
                            text-gray-500 font-nunito text-lg font-semibold cursor-not-allowed">
                            xudmzc
                        </div>
                    </div>

                    {{-- Nama Kelas --}}
                    <div>
                        <label class="block text-lg sm:text-xl font-bold text-gray-800 font-nunito mb-2">
                            Nama Kelas
                        </label>
                        <input type="text" x-model="namaKelas"
                            class="w-full bg-white border-2 border-gray-200 rounded-lg px-4 py-3 shadow-sm 
                            text-gray-700 text-lg font-nunito focus:outline-none 
                            focus:ring-2 focus:ring-[#EB580C]"
                            placeholder="Masukkan nama kelas baru">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4">
                        <button type="button"
                            class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 
                            text-white text-lg font-fredoka font-semibold rounded-full 
                            px-6 py-3 shadow-md transition w-full sm:w-auto">
                            Hapus Kelas
                        </button>

                        <button type="submit"
                            class="flex items-center justify-center gap-2 bg-sky-500 hover:bg-sky-600 
                            text-white text-lg font-fredoka font-semibold rounded-full 
                            px-6 py-3 shadow-md transition w-full sm:w-auto">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection