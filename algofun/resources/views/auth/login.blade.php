@extends('layouts.auth')

@section('content')

<div x-data="{ loading: true }" 
     x-init="setTimeout(() => loading = false, 800)">
    
    {{-- SKELETON (termasuk wave) --}}
    <div x-show="loading" 
         x-transition:leave="transition ease-in duration-300"
         class="fixed inset-0 z-50 bg-[#FFF8F2]">
        <x-auth-skeleton :fields="2" :hasGoogleButton="true" layout="auth" />
    </div>

    {{-- KONTEN ASLI --}}
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100">

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
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
            @endif

    {{-- FORM LOGIN --}}
    <form action="{{ route('login.post') }}" method="POST" class="space-y-3 font-nunito" novalidate>
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

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Kata Sandi <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="password" name="password" id="password"
                    class="form-input pr-10 @error('password') form-input-error @enderror"
                    placeholder="Masukkan Kata Sandi" required>

                {{-- Toggle Password Icon --}}
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700"
                    onclick="togglePassword()">
                    {{-- Icon mata tertutup (default) --}}
                    <svg id="eye-off-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m9.02 9.02l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                    {{-- Icon mata terbuka (hidden) --}}
                    <svg id="eye-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
            <p class="mt-1 text-sm text-[#E03F00]">{{ $message }}</p>
            @enderror
        </div>

                {{-- REMEMBER ME & LUPA PASSWORD --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#EB580C] focus:ring-[#EB580C]">
                        <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-sm text-[#EB580C] hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                {{-- TOMBOL LOGIN --}}
                <x-button
                    variant="primary"
                    type="submit"
                    block>
                    Masuk
                </x-button>

                {{-- DIVIDER --}}
                <div class="relative flex items-center justify-center my-4">
                    <div class="border-t border-gray-300 w-full"></div>
                    <span class="absolute bg-white px-3 text-gray-500 text-sm">atau</span>
                </div>

                {{-- GOOGLE LOGIN --}}
                <x-button
                    variant="secondary"
                    href="{{ route('google.redirect') }}"
                    block>
                    <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4 h-4">
                    Masuk dengan Google
                </x-button>

                {{-- REGISTER LINK --}}
                <p class="text-center text-sm text-gray-600 mt-4">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-[#EB580C] font-semibold hover:underline">Yuk Daftar!</a>
                </p>

            </form>
        </div>
    </div>
</div>

{{-- Auto-refresh CSRF token setiap 10 menit --}}
<script>
    setInterval(function() {
        fetch('{{ route('login') }}')
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newToken = doc.querySelector('input[name="_token"]').value;
                document.querySelector('input[name="_token"]').value = newToken;
                console.log('CSRF token refreshed');
            });
    }, 600000); // 10 menit

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOffIcon.classList.add('hidden'); // Sembunyikan mata tertutup
            eyeIcon.classList.remove('hidden'); // Tampilkan mata terbuka
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.add('hidden'); // Sembunyikan mata terbuka
            eyeOffIcon.classList.remove('hidden'); // Tampilkan mata tertutup
        }
    }
</script>
@endsection