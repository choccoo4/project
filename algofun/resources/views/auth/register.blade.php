@extends('layouts.authregis')
@section('content')
<div class="w-full max-w-lg mx-auto bg-white shadow-[0_8px_30px_rgba(255,150,90,0.25)]
            border border-[#EAEAEA] rounded-3xl 
            p-4 lg:p-8 
            mt-0 lg:mt-20"
     x-data="{ role: '', openDropdown: false }">
    {{-- LOGO --}}
    <div class="relative w-full flex justify-center">
        <img src="/images/logo.svg"
             alt="AlgoFun Logo"
             class="absolute -top-23 w-100 drop-shadow-lg">
    </div>
    <h2 class="text-center text-3xl font-fredoka font-semibold text-[#4a5565] mb-2 mt-10">
        Selamat Datang di AlgoFun!
    </h2>
    <p class="text-center text-gray-600 text-lg font-nunito mb-4">
        Buat akunmu dan ayo belajar dengan seru hari ini.
    </p>

    {{-- FORM --}}
    <form action="{{ route('register.post') }}" method="POST" class="space-y-3 font-nunito">
        @csrf

        {{-- ROLE (Custom Dropdown) --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Daftar Sebagai?</label>
            
            {{-- Hidden Input untuk form submission --}}
            <input type="hidden" name="role" :value="role">
            
            {{-- Custom Dropdown --}}
            <div class="relative" @click.outside="openDropdown = false">
                <button type="button"
                    @click="openDropdown = !openDropdown"
                    class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2.5 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm text-left flex justify-between items-center hover:bg-gray-50 transition">
                    <span x-text="role ? (role === 'siswa' ? 'Siswa' : 'Guru') : 'Pilih Role'"></span>
                    <svg class="w-4 h-4 text-gray-600" :class="{'rotate-180': openDropdown}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="openDropdown"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute top-full left-0 right-0 mt-1 bg-white border border-[#E7E7E7] rounded-lg shadow-lg z-50 overflow-hidden">
                    
                    <button type="button"
                        @click="role = 'siswa'; openDropdown = false"
                        class="w-full px-3 py-2.5 text-left text-sm hover:bg-[#FFF5F0] transition"
                        :class="{'bg-[#EB580C] text-white': role === 'siswa', 'text-gray-700': role !== 'siswa'}">
                        Siswa
                    </button>
                    
                    <button type="button"
                        @click="role = 'guru'; openDropdown = false"
                        class="w-full px-3 py-2.5 text-left text-sm hover:bg-[#FFF5F0] transition border-t border-[#E7E7E7]"
                        :class="{'bg-[#EB580C] text-white': role === 'guru', 'text-gray-700': role !== 'guru'}">
                        Guru
                    </button>
                </div>
            </div>
        </div>

        {{-- USERNAME --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Nama Pengguna</label>
            <input type="text" name="username"
                class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2.5 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm transition"
                placeholder="Masukkan Nama Pengguna">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Email</label>
            <input type="email" name="email"
                class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2.5 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm transition"
                placeholder="contoh@gmail.com">
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Kata Sandi</label>
            <input type="password" name="password"
                class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2.5 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm transition"
                placeholder="Minimal 8 karakter, mengandung huruf dan angka">
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2.5 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm transition"
                placeholder="Konfirmasi Kata Sandi">
        </div>

        {{-- SUBMIT --}}
        <button type="submit"
            class="w-full bg-[#EB580C] hover:bg-[#ff6a1f] text-white text-sm font-fredoka font-semibold py-2.5 rounded-lg shadow-md transition active:scale-95">
            Daftar
        </button>

        {{-- GOOGLE --}}
        <button type="button"
            class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 py-2.5 rounded-lg text-sm shadow-sm hover:bg-gray-100 transition">
            <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4">
            <span class="font-nunito">Daftar dengan Google</span>
        </button>

        {{-- LOGIN LINK --}}
        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#EB580C] font-semibold hover:underline">Yuk Masuk!</a>
        </p>
    </form>
</div>
@endsection