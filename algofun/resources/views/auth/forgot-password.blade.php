@extends('layouts.auth')

@section('content')

<div x-data="{ loading: true }" 
     x-init="setTimeout(() => loading = false, 800)">
    
    {{-- SKELETON (termasuk wave) --}}
    <div x-show="loading" 
         x-transition:leave="transition ease-in duration-300"
         class="fixed inset-0 z-50 bg-[#FFF8F2]">
        <x-auth-skeleton :fields="1" :hasGoogleButton="false" layout="auth" />
    </div>

    {{-- KONTEN ASLI --}}
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100">

        <div class="w-full max-w-lg mx-auto bg-white shadow-[0_8px_30px_rgba(255,150,90,0.25)] border border-[#EAEAEA] rounded-3xl p-8 mt-20 font-nunito">

    {{-- FORM --}}
    <form action="{{ route('password.email') }}" method="POST" class="space-y-3 font-nunito" novalidate>
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email</label>
            <input type="email" name="email"
                class="form-input @error('email') form-input-error @enderror"
                placeholder="contoh@gmail.com" required>
            @error('email')
            <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
            @enderror
            {{-- LOGO --}}
            <div class="relative w-full flex justify-center">
                <img src="/images/logo.svg"
                    alt="AlgoFun Logo"
                    class="absolute -top-18 w-90 drop-shadow-lg">
            </div>

            <h2 class="text-center text-3xl font-fredoka font-semibold text-[#4a5565] mb-2 mt-16">
                Lupa Kata Sandi?
            </h2>

            <p class="text-center text-gray-600 text-base font-nunito mb-4">
                Silakan masukkan email kamu untuk menerima link ubah kata sandi.
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
                <x-button
                    variant="primary"
                    type="submit"
                    block>
                    Kirim
                </x-button>

                {{-- BACK TO LOGIN --}}
                <p class="text-center text-sm text-gray-600 mt-1">
                    Sudah ingat sandi? <a href="{{ route('login') }}" class="text-[#EB580C] font-inner font-regular">Yuk Masuk!</a>
                </p>

            </form>
        </div>
    </div>
</div>
@endsection