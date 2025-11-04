@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar')
<aside
    x-data="{ open: true, menuDataset: false, menuAI: false, menuUser: false }"
    x-show="open"
    x-transition.duration.300ms
    class="sidebar w-72 bg-white border-r-4 border-orange-500 flex flex-col py-8 h-screen
           fixed top-0 left-0 z-20 transform md:translate-x-0 transition-transform duration-300 ease-in-out
           overflow-y-auto px-6"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }">

    <!-- Logo -->
    <div class="flex justify-center mb-10">
        <a href="{{ route('admin.dashboard') }}">
            <img src="/images/logo.svg" alt="AlgoFun Logo" class="w-44">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col w-full gap-4 font-fredoka text-lg font-semibold">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->routeIs('admin.dashboard') ? 'bg-[#FFF3E0] border-[#F5D49F] text-[#EB580C]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/combo-chart--v1.png" class="w-7 h-7 hover:scale-110" alt="Dashboard">
            <span>Dashboard</span>
        </a>

        <!-- Konten & Dataset -->
        <div>
            <button @click="menuDataset = !menuDataset"
                class="w-full flex items-center justify-between px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0]/60 transition">
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/color/96/open-book--v1.png" class="w-7 h-7 hover:scale-110" alt="Dataset">
                    <span>Konten & Dataset</span>
                </div>
                <svg :class="{ 'rotate-180': menuDataset }" class="w-4 h-4 transform transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="menuDataset" x-transition.duration.300ms class="ml-11 space-y-2 mt-2">
                <a href="#" class="flex items-center gap-2 text-base text-gray-600 hover:text-[#EB580C] transition">
                    <img src="https://img.icons8.com/color/96/upload--v1.png" class="w-5 h-5"> Upload Dataset
                </a>
                <a href="#" class="flex items-center gap-2 text-base text-gray-600 hover:text-[#EB580C] transition">
                    <img src="https://img.icons8.com/color/96/data-configuration.png" class="w-5 h-5"> Manajemen Dataset
                </a>
            </div>
        </div>

        <!-- Pusat AI -->
        <div>
            <button @click="menuAI = !menuAI"
                class="w-full flex items-center justify-between px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0]/60 transition">
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/color/96/artificial-intelligence.png" class="w-7 h-7 hover:scale-110" alt="AI">
                    <span>Pusat AI</span>
                </div>
                <svg :class="{ 'rotate-180': menuAI }" class="w-4 h-4 transform transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="menuAI" x-transition.duration.300ms class="ml-11 space-y-2 mt-2">
                <a href="#" class="flex items-center gap-2 text-base text-gray-600 hover:text-[#EB580C] transition">
                    <img src="https://img.icons8.com/color/96/quiz.png" class="w-5 h-5"> Rekomendasi Soal
                </a>
            </div>
        </div>

        <!-- Daftar Pengguna -->
        <div>
            <button @click="menuUser = !menuUser"
                class="w-full flex items-center justify-between px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0]/60 transition">
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/color/96/conference-call.png" class="w-7 h-7 hover:scale-110" alt="Users">
                    <span>Daftar Pengguna</span>
                </div>
                <svg :class="{ 'rotate-180': menuUser }" class="w-4 h-4 transform transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="menuUser" x-transition.duration.300ms class="ml-11 space-y-2 mt-2">
                <a href="#" class="flex items-center gap-2 text-base text-gray-600 hover:text-[#EB580C] transition">
                    <img src="https://img.icons8.com/color/96/student-center.png" class="w-5 h-5"> Siswa
                </a>
                <a href="#" class="flex items-center gap-2 text-base text-gray-600 hover:text-[#EB580C] transition">
                    <img src="https://img.icons8.com/color/96/training.png" class="w-5 h-5"> Guru
                </a>
            </div>
        </div>

        <!-- Analisis & Insight -->
        <a href="#"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0] hover:border-[#F5D49F] transition">
            <img src="https://img.icons8.com/color/96/analytics.png" class="w-7 h-7 hover:scale-110" alt="Analisis">
            <span>Analisis & Insight</span>
        </a>

        <!-- Laporan & Ekspor -->
        <a href="#"
            class="flex items-center gap-3 px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0] hover:border-[#F5D49F] transition">
            <img src="https://img.icons8.com/color/96/export.png" class="w-7 h-7 hover:scale-110" alt="Laporan">
            <span>Laporan & Ekspor</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="mt-6">
        <a href="#" class="flex items-center gap-3 px-5 py-4 rounded-2xl border border-transparent hover:bg-[#FFF3E0] hover:border-[#F5D49F] transition">
            <img src="https://img.icons8.com/color/96/logout-rounded-up.png" class="w-7 h-7 hover:scale-110" alt="Keluar">
            <span>Keluar</span>
        </a>
    </div>
</aside>
@endsection
