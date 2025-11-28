<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgoFun - Belajar Algoritma Seru</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF8F2] text-gray-700 font-nunito">

    <!-- NAVBAR -->
    <nav class="w-full px-6 py-4 bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <img src="/images/logo.svg" alt="AlgoFun" class="w-36 sm:w-40">
            </a>

            <!-- DESKTOP MENU -->
            <div class="hidden md:flex gap-5 items-center">
                <a href="#tentang"
                    class="font-fredoka font-semibold px-4 py-2 text-orange-500 hover:text-orange-600">Tentang Kami</a>

                <a href="#fitur"
                    class="font-fredoka font-semibold px-4 py-2 text-orange-500 hover:text-orange-600">Fitur</a>

                {{-- Login Button --}}
                <x-button
                    variant="secondary"
                    href="{{ url('/login') }}">
                    Login
                </x-button>

                {{-- Daftar Button --}}
                <x-button
                    variant="primary"
                    href="{{ url('/register') }}">
                    Daftar
                </x-button>
            </div>

            <!-- MOBILE: HAMBURGER -->
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <img src="https://img.icons8.com/ios-filled/50/000000/menu--v1.png" class="w-7 h-7 opacity-70">
            </button>

        </div>

        <!-- MOBILE MENU DROPDOWN -->
        <div id="mobile-menu" class="hidden flex flex-col bg-white shadow-md rounded-xl mt-4 p-4 md:hidden space-y-2">

            <a href="#tentang"
                class="font-fredoka px-3 py-2 text-orange-500 font-semibold hover:bg-orange-50 rounded-lg">
                Tentang Kami
            </a>

            <a href="#fitur"
                class="font-fredoka px-3 py-2 text-orange-500 font-semibold hover:bg-orange-50 rounded-lg">
                Fitur
            </a>

            <!-- WRAPPER BUTTON LOGIN & DAFTAR -->
            <div class="flex flex-col space-y-2 mt-3">
                {{-- Login Mobile --}}
                <x-button
                    variant="secondary"
                    block
                    href="{{ url('/login') }}">
                    Login
                </x-button>

                {{-- Daftar Mobile --}}
                <x-button
                    variant="primary"
                    block
                    href="{{ url('/register') }}">
                    Daftar
                </x-button>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="px-6 pt-16 pb-24 flex flex-col-reverse md:flex-row items-center max-w-7xl mx-auto">

        <!-- TEXT -->
        <div class="flex-1 mt-10 md:mt-0">
            <h1 class="font-fredoka text-4xl md:text-6xl text-[#EB580C] font-bold leading-tight">
                Belajar Logika & Algoritma <br> Jadi Lebih Seru!
            </h1>

            <p class="mt-5 text-lg text-gray-600 max-w-md">
                AlgoFun membantu anak memahami algoritma dasar melalui permainan, level, XP, dan soal interaktif yang dibuat otomatis oleh AI.
            </p>

            <div class="mt-8 flex gap-4">
                {{-- Mulai Sekarang --}}
                <x-button
                    variant="primary"
                    size="lg"
                    href="{{ url('/register') }}">
                    Mulai Sekarang
                </x-button>

                {{-- Lihat Fitur --}}
                <x-button
                    variant="secondary"
                    size="lg"
                    href="#fitur">
                    Lihat Fitur
                </x-button>
            </div>
        </div>

        <!-- ILLUSTRATION -->
        <div class="flex-1 flex justify-center mb-10 md:mb-0">
            <img src="https://img.icons8.com/color/480/reading.png" class="w-72 md:w-96 drop-shadow-xl">
        </div>
    </section>


    <!-- FITUR -->
    <section id="fitur" class="bg-white py-20">
        <h3 class="text-center font-fredoka text-3xl md:text-4xl text-[#EB580C] font-bold mb-14">
            Kenapa Harus AlgoFun?
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">

            <!-- CARD 1 -->
            <div class="bg-[#FFF8F2] p-8 rounded-2xl shadow border border-orange-200 text-center">
                <img src="https://img.icons8.com/color/96/controller.png" class="w-20 mx-auto mb-4">
                <h4 class="font-fredoka text-2xl text-[#EB580C] font-bold">Gamifikasi Seru</h4>
                <p class="mt-3 text-gray-600">
                    Level, XP, misi harian, dan badge bikin belajar lebih menyenangkan.
                </p>
            </div>

            <!-- CARD 2 -->
            <div class="bg-[#FFF8F2] p-8 rounded-2xl shadow border border-orange-200 text-center">
                <img src="https://img.icons8.com/color/96/artificial-intelligence.png" class="w-20 mx-auto mb-4">
                <h4 class="font-fredoka text-2xl text-[#EB580C] font-bold">Soal dari AI</h4>
                <p class="mt-3 text-gray-600">
                    Soal otomatis dari materi PDF sesuai level anak, langsung relevan & variatif.
                </p>
            </div>

            <!-- CARD 3 -->
            <div class="bg-[#FFF8F2] p-8 rounded-2xl shadow border border-orange-200 text-center">
                <img src="https://img.icons8.com/color/96/combo-chart.png" class="w-20 mx-auto mb-4">
                <h4 class="font-fredoka text-2xl text-[#EB580C] font-bold">Analisis Belajar</h4>
                <p class="mt-3 text-gray-600">
                    AI menganalisis kelemahan siswa dan memberikan latihan remedial otomatis.
                </p>
            </div>

        </div>
    </section>


    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-20 bg-[#FFF8F2]">
        <!-- JUDUL -->
        <h3 class="text-center font-fredoka text-3xl md:text-4xl text-[#EB580C] font-bold mb-6">
            Tentang AlgoFun
        </h3>

        <!-- SUBTEKS -->
        <p class="text-center max-w-2xl mx-auto text-gray-600 mb-14">
            AlgoFun dibuat untuk membantu anak memahami logika & algoritma dasar lewat cara belajar yang
            menyenangkan, bertahap, dan penuh tantangan seru.
        </p>

        <!-- ILUSTRASI UTAMA -->
        <div class="flex justify-center mb-14">
            <img src="/images/learn.png"
                class="w-64 md:w-80 drop-shadow-lg">
        </div>

        <!-- GRID 2x2 -->
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-6">

            <!-- Tujuan -->
            <div class="bg-white p-6 rounded-2xl shadow border border-orange-200 flex gap-4">
                <img src="https://img.icons8.com/color/48/goal--v1.png" class="w-12 h-12">
                <div>
                    <h4 class="font-fredoka text-xl text-[#EB580C] font-bold">Tujuan AlgoFun</h4>
                    <p class="text-gray-600 mt-1">
                        Membantu anak memahami logika dan algoritma melalui pembelajaran interaktif yang bertahap.
                    </p>
                </div>
            </div>

            <!-- Untuk Siapa -->
            <div class="bg-white p-6 rounded-2xl shadow border border-orange-200 flex gap-4">
                <img src="https://img.icons8.com/?size=100&id=rd92g72bj5F0&format=png&color=000000" class="w-12 h-12">
                <div>
                    <h4 class="font-fredoka text-xl text-[#EB580C] font-bold">Untuk Siapa?</h4>
                    <p class="text-gray-600 mt-1">
                        Dirancang untuk siswa kelas 3–4 SD atau usia 8–10 tahun.
                    </p>
                </div>
            </div>

            <!-- Cara Belajar -->
            <div class="bg-white p-6 rounded-2xl shadow border border-orange-200 flex gap-4">
                <img src="https://img.icons8.com/color/48/books.png" class="w-12 h-12">
                <div>
                    <h4 class="font-fredoka text-xl text-[#EB580C] font-bold">Cara Belajar</h4>
                    <p class="text-gray-600 mt-1">
                        Belajar lewat Level → Step → XP → Misi Harian, membuat proses belajar tetap fun dan tidak monoton.
                    </p>
                </div>
            </div>

            <!-- Peran AI -->
            <div class="bg-white p-6 rounded-2xl shadow border border-orange-200 flex gap-4">
                <img src="https://img.icons8.com/color/48/artificial-intelligence.png" class="w-12 h-12">
                <div>
                    <h4 class="font-fredoka text-xl text-[#EB580C] font-bold">Peran AI</h4>
                    <p class="text-gray-600 mt-1">
                        AI membuat soal otomatis dari materi PDF dan menganalisis kelemahan siswa agar latihan lebih tepat sasaran.
                    </p>
                </div>
            </div>

        </div>
    </section>


    <!-- CTA AKHIR -->
    <section class="py-20 bg-white">
        <div class="text-center max-w-3xl mx-auto px-6">
            <h3 class="font-fredoka text-3xl md:text-4xl text-[#EB580C] font-bold">
                Siap Mulai Petualangan Belajar?
            </h3>
            <p class="mt-3 mb-4 text-gray-600">
                Buat akun gratis dan mulai belajar algoritma dengan cara yang lebih seru dan interaktif!
            </p>

            <x-button
                variant="primary"
                size="lg"
                href="{{ url('/register') }}">
                Daftar Sekarang
            </x-button>
        </div>
    </section>

</body>

<script>
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("mobile-menu");

    toggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>

</html>