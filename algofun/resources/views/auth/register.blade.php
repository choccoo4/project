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

    {{-- ERROR MESSAGES --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('register.post') }}" method="POST" class="space-y-3 font-nunito" novalidate x-data="{ role: '', openDropdown: false }">
        @csrf

        {{-- ROLE (Custom Dropdown) --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Daftar Sebagai? <span class="text-red-500">*</span></label>

            {{-- Hidden Input untuk form submission --}}
            <input type="hidden" name="role" :value="role">

            {{-- Custom Dropdown --}}
            <div class="relative" @click.outside="openDropdown = false">
                <button type="button"
                    @click="openDropdown = !openDropdown"
                    class="form-select text-left flex justify-between items-center hover:bg-gray-50 transition pr-10"
                    :class="{ 'form-select-error': !role && '{{ $errors->has('role') ? 'true' : 'false' }}' === 'true' }">
                    <span x-text="role ? (role === 'siswa' ? 'Siswa' : 'Guru') : 'Pilih Role'"></span>
                    <svg class="w-4 h-4 text-gray-600 absolute right-3 top-1/2 transform -translate-y-1/2" :class="{'rotate-180': openDropdown}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            @error('role')
            <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
            @enderror
        </div>

        {{-- USERNAME --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Nama Pengguna <span class="text-red-500">*</span></label>
            <input type="text" name="username" value="{{ old('username') }}"
                class="form-input @error('username') form-input-error @enderror"
                placeholder="Masukkan Nama Pengguna">
            @error('username')
            <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-input @error('email') form-input-error @enderror"
                placeholder="contoh@gmail.com">
            @error('email')
            <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Kata Sandi <span class="text-red-500">*</span></label>
            <input type="password" name="password"
                class="form-input @error('password') form-input-error @enderror"
                placeholder="Minimal 8 karakter, mengandung huruf dan angka">
            @error('password')
            <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
            @enderror
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm block mb-1">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation"
                class="form-input"
                placeholder="Konfirmasi Kata Sandi">
        </div>

        {{-- SUBMIT --}}
        <x-button
            variant="primary"
            type="submit"
            block>
            Daftar
        </x-button>

        {{-- DIVIDER --}}
        <div class="relative flex items-center justify-center my-4">
            <div class="border-t border-gray-300 w-full"></div>
            <span class="absolute bg-white px-3 text-gray-500 text-sm">atau</span>
        </div>

        {{-- GOOGLE BUTTON --}}
        <x-button
            variant="secondary"
            href="#"
            x-bind:href="role ? '{{ route('google.redirect') }}?role=' + role : '#'"
            @click="if(!role) { alert('Silakan pilih role terlebih dahulu!'); $event.preventDefault(); }"
            block>
            <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4 h-4">
            Daftar dengan Google
        </x-button>

        {{-- LOGIN LINK --}}
        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#EB580C] font-semibold hover:underline">Yuk Masuk!</a>
        </p>
    </form>
</div>
@endsection