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
            <form action="{{ route('password.update') }}" method="POST" class="space-y-3 font-nunito">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="font-semibold text-gray-800 text-sm">Email</label>
                    <input type="email" name="email"
                        class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] 
                               focus:ring-2 focus:ring-[#EB580C] text-sm"
                        placeholder="contoh@gmail.com" required>
                </div>

                {{-- PASSWORD BARU --}}
                <div>
                    <label class="font-semibold text-gray-800 text-sm">Kata Sandi Baru</label>
                    <input type="password" name="password"
                        class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] 
                               focus:ring-2 focus:ring-[#EB580C] text-sm"
                        placeholder="Masukkan kata sandi baru" required>
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div>
                    <label class="font-semibold text-gray-800 text-sm">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] 
                               focus:ring-2 focus:ring-[#EB580C] text-sm"
                        placeholder="Konfirmasi kata sandi baru" required>
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