@extends('layouts.auth')

@section('content')

<div x-data="{ loading: true }" 
     x-init="setTimeout(() => loading = false, 800)">
    
    {{-- SKELETON (termasuk wave) --}}
    <div x-show="loading" 
         x-transition:leave="transition ease-in duration-300"
         class="fixed inset-0 z-50 bg-[#FFF8F2]">
        <x-auth-skeleton :fields="3" :hasGoogleButton="false" layout="auth" />
    </div>

    {{-- KONTEN ASLI --}}
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100">

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
    <form action="{{ route('password.email') }}" method="POST" class="space-y-3 font-nunito" novalidate>
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-input @error('email') form-input-error @enderror"
                placeholder="contoh@gmail.com" required>
            @error('email')
            <p class="mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
            @enderror
        </div>

                {{-- BUTTON --}}
                <x-button
                    variant="primary"
                    type="submit"
                    class="w-full">
                    Ubah
                </x-button>

            </form>
        </div>
    </div>
</div>
@endsection