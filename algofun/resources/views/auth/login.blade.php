@extends('layouts.auth')

@section('content')

<div class="w-full max-w-lg mx-auto mt-20">

    {{-- LOGO --}}
    <div class="relative w-full flex justify-center">
        <img src="/images/logo.svg"
             alt="AlgoFun Logo"
             class="absolute -top-20 w-100 drop-shadow-lg">
    </div>

    <h2 class="text-center text-3xl font-fredoka font-semibold text-[#4a5565] mb-1 mt-16">
        Selamat Datang Kembali!
    </h2>

    <p class="text-center text-gray-600 text-lg font-nunito mb-6">
        Masuk ke akunmu dan lanjutkan belajar seru hari ini.
    </p>

    {{-- FORM LOGIN --}}
    <form action="{{ route('login.post') }}" method="POST" class="space-y-3 font-nunito">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email</label>
            <input type="email" name="email"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm"
                placeholder="contoh@gmail.com" required>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Kata Sandi</label>
            <input type="password" name="password"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm"
                placeholder="Masukkan Kata Sandi" required>
        </div>

        {{-- LUPA PASSWORD --}}
        <div class="text-right">
            <a href="{{ route('password.request') }}" class="text-sm text-[#EB580C] hover:underline">
                Lupa Kata Sandi?
            </a>
        </div>

        {{-- TOMBOL LOGIN --}}
        <button
            class="w-full bg-[#EB580C] hover:bg-[#ff6a1f] text-white text-sm font-fredoka font-semibold py-2 rounded-lg shadow-md">
            Masuk
        </button>

        {{-- GOOGLE LOGIN --}}
        <button type="button"
            class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 py-2 rounded-lg text-sm shadow-sm hover:bg-gray-100">
            <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4">
            <span class="font-nunito">Masuk dengan Google</span>
        </button>

        {{-- REGISTER LINK --}}
        <p class="text-center text-sm text-gray-600 mt-1">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#EB580C] font-semibold">Yuk Daftar!</a>
        </p>

    </form>
</div>

@endsection
