@extends('layouts.teacher')

@section('title', 'Pengaturan Kelas')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] flex">
    <div class="flex-1 px-8 py-8">
        {{-- Header --}}
        <header class="flex justify-between items-center mb-10 bg-white rounded-2xl shadow-md px-6 py-4 border border-orange-100">
            <div class="flex items-center gap-3">
                <img src="https://img.icons8.com/color/96/school-building.png" alt="Daftar Kelas" class="w-9 h-9">
                <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C]">Matematika 3D</h1>
            </div>
            <p class="text-gray-800 text-lg font-nunito">
                Halo, <b class="text-[#EB580C]">Septia</b>
            </p>
        </header>

        {{-- Tabs --}}
        <div class="bg-white rounded-2xl shadow-md px-8 py-6">
            <div class="flex border-b border-gray-300 mb-6">
                <a href="{{ route('guru.kelas.show', ['id' => 1]) }}"
                    class="px-6 pb-3 text-2xl font-fredoka font-semibold text-neutral-600 border-b-4 border-transparent hover:border-orange-400 hover:text-[#EB580C] transition">
                    Siswa
                </a>
                <a href="{{ route('guru.kelas.settings', ['id' => 1]) }}"
                    class="px-6 pb-3 text-2xl font-fredoka font-semibold text-neutral-600 border-b-4 border-orange-400 text-[#EB580C]">
                    Pengaturan
                </a>
            </div>

            {{-- Info Kelas --}}
            <div class="mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="font-fredoka text-3xl text-[#EB580C] font-bold">Info Kelas</h2>
                </div>

                <form x-data="{ namaKelas: 'Matematika 3D' }" class="space-y-6">

                    {{-- Kode Kelas (readonly) --}}
                    <div>
                        <label class="block text-xl font-bold text-gray-800 font-nunito mb-2">Kode Kelas</label>
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 shadow-sm text-gray-500 font-nunito text-lg font-semibold cursor-not-allowed">
                            xudmzc
                        </div>
                    </div>

                    {{-- Nama Kelas (editable) --}}
                    <div>
                        <label class="block text-xl font-bold text-gray-800 font-nunito mb-2">Nama Kelas</label>
                        <input type="text" x-model="namaKelas"
                            class="w-full bg-white border-2 border-gray-200 rounded-lg px-4 py-3 shadow-sm text-gray-700 text-lg font-nunito focus:outline-none focus:ring-2 focus:ring-[#EB580C]"
                            placeholder="Masukkan nama kelas baru">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button"
                            class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-lg font-fredoka font-semibold rounded-full px-6 py-3 shadow-md transition">
                            Hapus Kelas
                        </button>

                        <button type="submit"
                            class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white text-lg font-fredoka font-semibold rounded-full px-6 py-3 shadow-md transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection