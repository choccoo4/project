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
    <form action="{{ route('login.post') }}" method="POST" class="space-y-3 font-nunito">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm @error('email') border-red-500 @enderror"
                placeholder="contoh@gmail.com" required>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Kata Sandi <span class="text-red-500">*</span></label>
            <input type="password" name="password"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-2 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm @error('password') border-red-500 @enderror"
                placeholder="Masukkan Kata Sandi" required>
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
        <button type="submit"
            class="w-full bg-[#EB580C] hover:bg-[#ff6a1f] text-white text-sm font-fredoka font-semibold py-2.5 rounded-lg shadow-md transition active:scale-95">
            Masuk
        </button>

        {{-- DIVIDER --}}
        <div class="relative flex items-center justify-center my-4">
            <div class="border-t border-gray-300 w-full"></div>
            <span class="absolute bg-white px-3 text-gray-500 text-sm">atau</span>
        </div>

        {{-- GOOGLE LOGIN --}}
        <a href="{{ route('google.redirect') }}"
           class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 py-2.5 rounded-lg text-sm shadow-sm hover:bg-gray-100 transition">
            <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4">
            <span class="font-nunito">Masuk dengan Google</span>
        </a>

        {{-- REGISTER LINK --}}
        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#EB580C] font-semibold hover:underline">Yuk Daftar!</a>
        </p>

    </form>
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
</script>
@endsection