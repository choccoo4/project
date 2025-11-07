@extends('layouts.teacher')

@section('title', 'Data Diri Guru')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6" x-data="{ otherSchool: false }">

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow flex justify-between items-center px-8 py-4 mb-10 border border-[#F3E0D3]">
        <div class="flex items-center space-x-3">
            <img src="https://img.icons8.com/color/48/000000/user-folder.png" alt="Data Diri" class="w-9 h-9">
            <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C]">Data Diri</h1>
        </div>
        <p class="text-gray-800 font-nunito text-lg">
            Halo, <b class="text-[#EB580C]">Septia</b>
        </p>
    </div>

    <!-- Card utama -->
    <div class="bg-white rounded-2xl shadow-md border border-[#E7E7E7] max-w-4xl mx-auto px-10 py-10">

        <!-- Foto profil -->
        <div class="flex flex-col items-center mb-10 relative">
            <div class="relative">
                <img src="https://img.icons8.com/color/96/000000/teacher.png"
                    alt="Foto Profil"
                    class="w-40 h-40 rounded-xl border border-gray-300 bg-[#FFF8F2] object-cover">
                <!-- Tombol edit foto -->
                <button
                    class="absolute bottom-2 right-2 bg-white border border-gray-300 rounded-full p-2 shadow-sm hover:bg-gray-100">
                    <img src="https://img.icons8.com/ios-glyphs/20/EB580C/edit.png" alt="Edit" class="w-4 h-4">
                </button>
            </div>
        </div>

        <!-- Form data diri -->
        <div class="space-y-6 font-nunito text-gray-700">

            <!-- Nama Lengkap -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-right pr-6">Nama Lengkap</label>
                <input type="text" value="Septia"
                    readonly
                    class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#7C7C7C] focus:outline-none">
            </div>

            <!-- Nama Pengguna -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-right pr-6">Nama Pengguna</label>
                <input type="text" value="Septia R"
                    readonly
                    class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#7C7C7C] focus:outline-none">
            </div>

            <!-- Email -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-right pr-6">Email</label>
                <input type="text" value="septia@gmail.com"
                    readonly
                    class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#7C7C7C] focus:outline-none">
            </div>

            <!-- Asal Sekolah -->
            <div class="grid grid-cols-3 items-start">
                <label class="font-semibold text-right pr-6 pt-2">Asal Sekolah</label>
                <div class="col-span-2 space-y-3">
                    <select
                        @change="otherSchool = $event.target.value === 'lainnya'"
                        class="w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-white text-[#333] focus:outline-none">
                        <option value="">-- Pilih Sekolah --</option>
                        <option value="SD Negeri 001">SD Negeri 001</option>
                        <option value="SD Negeri 002">SD Negeri 002</option>
                        <option value="SD Negeri 003">SD Negeri 003</option>
                        <option value="lainnya">Lainnya...</option>
                    </select>

                    <!-- Input manual sekolah lain -->
                    <div x-show="otherSchool" x-transition>
                        <input type="text" placeholder="Tulis nama sekolah Anda"
                            class="w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-[#333] focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- NIP -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-right pr-6">NIP</label>
                <input type="text" placeholder="Belum diisi"
                    readonly
                    class="col-span-2 w-full border border-[#EAEAEA] rounded-lg px-4 py-2 bg-[#FDFDFD] text-gray-400 italic focus:outline-none">
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-6 mt-12">
            <!-- Batal -->
            <button
                class="w-26 h-11 bg-[#F4F4F4] rounded-xl shadow-[0px_8px_4px_rgba(0,0,0,0.25)] 
                text-[#4C4C4C] text-lg font-fredoka font-semibold hover:bg-white/50 transition-all duration-300">
                Batal
            </button>

            <!-- Simpan -->
            <button
                class="w-26 h-11 bg-[#8EE000] rounded-xl shadow-[0px_8px_4px_rgba(0,0,0,0.25)] 
                text-white text-lg font-fredoka font-semibold hover:bg-[#ff6a1f] transition-all duration-300">
                Simpan
            </button>
        </div>
    </div>
</div>
@endsection