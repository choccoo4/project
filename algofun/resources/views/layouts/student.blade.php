@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('sidebar')
<aside
    x-show="open"
    x-transition.duration.300ms
    class="sidebar w-72 bg-white border-r-4 border-orange-500 flex flex-col items-center py-8 h-screen
    fixed top-0 left-0 z-20 transform md:translate-x-0 transition-transform duration-300 ease-in-out
    overflow-y-auto"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }">

    <!-- Logo -->
    <div class="mb-10">
        <a href="{{ url('/dashboard') }}">
            <img src="/images/logo.svg" alt="AlgoFun Logo" class="w-50">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col w-full px-6 gap-4 text-lg font-semibold">
        <a href="{{ url('/belajar') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('belajar') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/abc.png" alt="Belajar" class="w-7 h-7 hover:scale-110">
            <span>Belajar</span>
        </a>

        <a href="{{ url('/latihan') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('latihan') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/controller.png" alt="Latihan" class="w-7 h-7 hover:scale-110">
            <span>Latihan</span>
        </a>

        <a href="{{ url('/misi') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('misi') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/goal--v1.png" alt="Misi" class="w-7 h-7 hover:scale-110">
            <span>Misi</span>
        </a>

        <a href="{{ url('/papan-skor') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('papan-skor') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/trophy.png" alt="Papan Skor" class="w-7 h-7 hover:scale-110">
            <span>Papan Skor</span>
        </a>

        <a href="{{ url('/lencana') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('lencana') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/medal.png" alt="Lencana" class="w-7 h-7 hover:scale-110">
            <span>Lencana</span>
        </a>

        <a href="{{ url('/laporan-belajar') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('laporan-belajar') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/report-card.png" alt="Laporan Belajar" class="w-7 h-7 hover:scale-110">
            <span>Laporan Belajar</span>
        </a>

        <a href="{{ url('/data-diri') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->is('data-diri') ? 'bg-[#FFF3E0] border-[#F5D49F]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/user.png" alt="Data Diri" class="w-7 h-7 hover:scale-110">
            <span>Data Diri</span>
        </a>

        <a href="{{ url('/logout') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 mt-3 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F] border-transparent">
            <img src="https://img.icons8.com/color/96/exit.png" alt="Keluar" class="w-7 h-7 hover:scale-110">
            <span>Keluar</span>
        </a>
    </nav>
</aside>
@endsection