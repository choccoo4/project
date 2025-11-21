@extends('layouts.auth')

@section('content')

<div class="w-full max-w-lg mx-auto bg-white shadow-[0_8px_30px_rgba(255,150,90,0.25)] border border-[#EAEAEA] rounded-3xl p-8 mt-20 font-nunito">

    {{-- LOGO --}}
    <div class="relative w-full flex justify-center">
        <img src="/images/logo.svg"
             alt="AlgoFun Logo"
             class="absolute -top-18 w-95 drop-shadow-lg">
    </div>

    <h2 class="text-center text-3xl font-fredoka font-medium text-[#4a5565] mb-2 mt-16">
        Ubah Kata Sandi?
    </h2>

    <p class="text-center text-xl text-gray-600 text-base font-nunito font-semibold mb-4">
        Masukkan kata sandi baru anda.
    </p>

    {{-- FORM --}}
    <form action="{{ route('password.email') }}" method="POST" class="space-y-3 font-nunito">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email</label>
            <input type="email" name="email"
                class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] 
                       focus:ring-2 focus:ring-[#EB580C] text-sm"
                placeholder="contoh@gmail.com" required>
        </div>

        {{-- BUTTON --}}
        <button
            class="w-full bg-[#EB580C] hover:bg-[#ff6a1f] text-white text-sm font-fredoka font-semibold py-2 rounded-lg shadow-md transition transform hover:scale-105">
            Ubah
        </button>

    </form>
</div>

@endsection
