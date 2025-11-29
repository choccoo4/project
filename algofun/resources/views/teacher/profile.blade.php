@extends('layouts.teacher')

@section('title', 'Data Diri Guru')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6" x-data="{ otherSchool: false }">

    <!-- Header -->
    <header class="mb-6 sm:mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

        <!-- Left: Icon + Judul -->
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/48/000000/user-folder.png"
                class="w-7 h-7 sm:w-8 sm:h-8" alt="Data Diri">

            <h1 class="text-lg sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Data Diri
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

    <!-- Card utama -->
    <div class="bg-white rounded-2xl shadow-md border border-[#E7E7E7] max-w-4xl mx-auto px-5 sm:px-10 py-8 sm:py-10">

        <!-- Foto profil -->
        <div class="flex flex-col items-center mb-10">
            <div class="relative">
                <img src="https://img.icons8.com/color/96/000000/teacher.png"
                    alt="Foto Profil"
                    class="w-32 h-32 sm:w-40 sm:h-40 rounded-xl border border-gray-300 bg-[#FFF8F2] object-cover">

                <!-- Tombol edit foto -->
                <button class="absolute bottom-2 right-2 bg-white border border-gray-300 rounded-full p-2 shadow-sm hover:bg-gray-100">
                    <img src="https://img.icons8.com/ios-glyphs/20/EB580C/edit.png" alt="Edit" class="w-4 h-4">
                </button>
            </div>
        </div>

        <!-- Form data diri -->
        <form class="space-y-8 font-nunito text-gray-700">

            <!-- Nama Lengkap -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center">
                <label class="font-semibold sm:text-right">Nama Lengkap</label>
                <input type="text"
                    value="{{ $dataDiri['nama_lengkap'] ?? 'Septia Riski Masturiy' }}"
                    class="form-input sm:col-span-2 @error('nama_lengkap') form-input-error @enderror">
                @error('nama_lengkap')
                <p class="sm:col-span-2 text-red-500 text-sm mt-1 text-sm tect-[#E03F00]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Pengguna -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center">
                <label class="font-semibold sm:text-right">Nama Pengguna</label>
                <input type="text"
                    value="{{ $dataDiri['nama_pengguna'] ?? 'septia_rm' }}"
                    class="form-input sm:col-span-2 @error('nama_pengguna') form-input-error @enderror">
                @error('nama_pengguna')
                <p class="sm:col-span-2 col-start-2 mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center">
                <label class="font-semibold sm:text-right">Email</label>
                <input type="email"
                    value="{{ $dataDiri['email'] ?? 'septia@gmail.com' }}"
                    class="form-input sm:col-span-2 @error('email') form-input-error @enderror">
                @error('email')
                <p class="sm:col-span-2 col-start-2 mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Asal Sekolah -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-start">
                <label class="font-semibold sm:text-right pt-1">Asal Sekolah</label>

                <div class="sm:col-span-2 space-y-3">
                    <select
                        @change="otherSchool = $event.target.value === 'lainnya'"
                        class="form-select @error('asal_sekolah') form-select-error @enderror">
                        <option value="">-- Pilih Sekolah --</option>
                        <option value="SD Negeri 001" {{ (isset($dataDiri['asal_sekolah']) && $dataDiri['asal_sekolah'] == 'SD Negeri 001') ? 'selected' : '' }}>SD Negeri 001</option>
                        <option value="SD Negeri 002" {{ (isset($dataDiri['asal_sekolah']) && $dataDiri['asal_sekolah'] == 'SD Negeri 002') ? 'selected' : '' }}>SD Negeri 002</option>
                        <option value="SD Negeri 003" {{ (isset($dataDiri['asal_sekolah']) && $dataDiri['asal_sekolah'] == 'SD Negeri 003') ? 'selected' : '' }}>SD Negeri 003</option>
                        <option value="lainnya">Lainnya...</option>
                    </select>
                    @error('asal_sekolah')
                    <p class="text-sm text-[#E03F00]">{{ $message }}</p>
                    @enderror

                    <!-- Input manual -->
                    <div x-show="otherSchool" x-transition>
                        <input type="text" placeholder="Tulis nama sekolah Anda"
                            class="form-input @error('sekolah_lainnya') form-input-error @enderror">
                        @error('sekolah_lainnya')
                        <p class="mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- NIP -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center">
                <label class="font-semibold sm:text-right">NIP</label>
                <input type="text"
                    value="{{ $dataDiri['nip'] ?? '' }}"
                    placeholder="Belum diisi"
                    class="form-input sm:col-span-2 @error('nip') form-input-error @enderror">
                @error('nip')
                <p class="sm:col-span-2 col-start-2 mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-6 mt-12">
                <x-button
                    variant="soft"
                    type="button"
                    class="w-full sm:w-28 h-11 shadow-[0px_8px_4px_rgba(0,0,0,0.25)]">
                    Batal
                </x-button>

                <x-button
                    variant="success"
                    type="submit"
                    class="w-full sm:w-28 h-11 shadow-[0px_8px_4px_rgba(0,0,0,0.25)]">
                    Simpan
                </x-button>
            </div>

        </form>
    </div>
</div>
@endsection