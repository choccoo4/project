@extends('layouts.auth')

@section('content')

<div class="w-full max-w-lg mx-auto lg:mx-0">

    {{-- LOGO --}}
    <div class="relative w-full flex justify-center lg:justify-start mb-16 lg:mb-4">
        <img src="/images/logo.svg"
             alt="AlgoFun Logo"
             class="w-100 drop-shadow-lg mx-auto lg:mx-0">
    </div>

    <h2 class="text-center lg:text-left text-3xl font-fredoka font-semibold text-[#4a5565] mb-6">
        Yuk Daftar!
    </h2>

    <p class="text-center lg:text-left text-gray-600 text-lg font-nunito mb-12 lg:mb-6">
        Bergabunglah dan mulai petualangan coding seru.
    </p>

    {{-- ERROR MESSAGES --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-10">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-10 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM REGISTRASI --}}
    <form action="{{ route('register.post') }}" method="POST" class="space-y-5 font-nunito">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-3 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm @error('name') border-red-500 @enderror"
                placeholder="Masukkan nama lengkap" required>
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-3 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm @error('email') border-red-500 @enderror"
                placeholder="contoh@gmail.com" required>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Kata Sandi <span class="text-red-500">*</span></label>
            <input type="password" name="password"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-3 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm @error('password') border-red-500 @enderror"
                placeholder="Masukkan kata sandi" required>
        </div>

        {{-- PASSWORD CONFIRMATION --}}
        <div>
            <label class="font-semibold text-gray-800 text-sm">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation"
                class="w-full mt-1 border border-[#E7E7E7] rounded-lg px-3 py-3 bg-[#FDFDFD] focus:ring-2 focus:ring-[#EB580C] text-sm"
                placeholder="Masukkan ulang kata sandi" required>
        </div>

        {{-- TERMS & CONDITIONS --}}
        <div class="flex items-start">
            <input type="checkbox" name="terms" id="terms" 
                class="mt-1 rounded border-gray-300 text-[#EB580C] focus:ring-[#EB580C]"
                required>
            <label for="terms" class="ml-2 text-sm text-gray-600">
                Saya setuju dengan <a href="#" class="text-[#EB580C] hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-[#EB580C] hover:underline">Kebijakan Privasi</a>
            </label>
        </div>

        {{-- TOMBOL DAFTAR --}}
        <button type="submit"
            class="w-full bg-[#EB580C] hover:bg-[#ff6a1f] text-white text-sm font-fredoka font-semibold py-3 rounded-lg shadow-md transition active:scale-95 mt-4">
            Daftar
        </button>

        {{-- DIVIDER --}}
        <div class="relative flex items-center justify-center my-8">
            <div class="border-t border-gray-300 w-full"></div>
            <span class="absolute bg-[#FFF8F2] px-3 text-gray-500 text-sm">atau</span>
        </div>

        {{-- GOOGLE REGISTER --}}
        <a href="{{ route('google.redirect') }}"
           class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 py-3 rounded-lg text-sm shadow-sm hover:bg-gray-100 transition">
            <img src="https://img.icons8.com/color/48/google-logo.png" class="w-4">
            <span class="font-nunito">Daftar dengan Google</span>
        </a>

        {{-- LOGIN LINK --}}
        <p class="text-center lg:text-left text-sm text-gray-600 mt-16 lg:mt-8 pt-8 border-t border-gray-200">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#EB580C] font-semibold hover:underline">Yuk Masuk!</a>
        </p>

    </form>
</div>

{{-- Auto-refresh CSRF token setiap 10 menit --}}
<script>
setInterval(function() {
    fetch('{{ route('register') }}')
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