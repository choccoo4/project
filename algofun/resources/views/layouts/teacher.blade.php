@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('sidebar')
<aside
    x-show="open"
    x-transition.duration.300ms
    class="hidden md:flex md:w-72 sidebar w-72 bg-white border-r-4 border-orange-500 flex flex-col items-center py-8 h-screen
    fixed top-0 left-0 z-20 transform md:translate-x-0 transition-transform duration-300 ease-in-out
    overflow-y-auto"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }">

    <!-- Logo -->
    <div class="mb-10">
        <a href="{{ route('guru.dashboard') }}">
            <img src="/images/logo.svg" alt="AlgoFun Logo" class="w-48">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col w-full px-6 gap-4 text-lg font-semibold">

        <!-- Dashboard -->
        <a href="{{ route('guru.dashboard') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->routeIs('guru.dashboard') ? 'bg-[#FFF3E0] border-[#F5D49F] text-[#EB580C]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/combo-chart--v1.png" alt="Dashboard" class="w-7 h-7 hover:scale-110">
            <span>Dashboard</span>
        </a>

        <!-- Kelas -->
        <a href="{{ route('guru.kelas') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
        hover:bg-[#FFF3E0] hover:border-[#F5D49F]
        {{ request()->routeIs('guru.kelas*') ? 'bg-[#FFF3E0] border-[#F5D49F] text-[#EB580C]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/classroom.png" alt="Kelas" class="w-7 h-7 hover:scale-110">
            <span>Kelas</span>
        </a>


        <a href="{{ route('guru.papanskor') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->routeIs('guru.papanskor') ? 'bg-[#FFF3E0] border-[#F5D49F] text-[#EB580C]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/96/trophy.png" alt="Papan Skor" class="w-7 h-7 hover:scale-110">
            <span>Papan Skor</span>
        </a>

        <!-- Data Diri -->
        <a href="{{ route('guru.profile') }}"
            class="font-fredoka flex items-center gap-3 px-5 py-4 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F]
                {{ request()->routeIs('guru.profile') ? 'bg-[#FFF3E0] border-[#F5D49F] text-[#EB580C]' : 'border-transparent' }}">
            <img src="https://img.icons8.com/color/48/000000/user-folder.png" alt="Data Diri" class="w-7 h-7 hover:scale-110">
            <span>Data Diri</span>
        </a>

        <!-- Keluar -->
        <a href="#"
            class="font-fredoka flex items-center gap-3 px-5 py-4 mt-3 rounded-2xl border transition-all duration-200
                hover:bg-[#FFF3E0] hover:border-[#F5D49F] border-transparent text-red-500">
            <img src="https://img.icons8.com/color/96/logout-rounded-up.png" alt="Keluar" class="w-7 h-7 hover:scale-110">
            <span>Keluar</span>
        </a>
    </nav>
</aside>
@endsection


@section('bottom-nav')
<!-- Bottom Navigation (Mobile) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-orange-300 flex justify-around py-2 z-30 shadow-lg">
    <a href="{{ route('guru.dashboard') }}" class="flex flex-col items-center text-xs font-fredoka {{ request()->routeIs('guru.dashboard') ? 'text-orange-500' : 'text-gray-400' }}">
        <img src="https://img.icons8.com/color/96/combo-chart--v1.png" class="w-6 h-6">
        <span>Dashboard</span>
    </a>

    <a href="{{ route('guru.kelas') }}" class="flex flex-col items-center text-xs font-fredoka {{ request()->routeIs('guru.kelas') ? 'text-orange-500' : 'text-gray-400' }}">
        <img src="https://img.icons8.com/color/96/classroom.png" class="w-6 h-6">
        <span>Kelas</span>
    </a>

    <a href="{{ route('guru.papanskor') }}" class="flex flex-col items-center text-xs font-fredoka {{ request()->routeIs('guru.papanskor') ? 'text-orange-500' : 'text-gray-400' }}">
        <img src="https://img.icons8.com/color/96/trophy.png" class="w-6 h-6">
        <span>Skor</span>
    </a>

    <a href="{{ route('guru.profile') }}" class="flex flex-col items-center text-xs font-fredoka {{ request()->routeIs('guru.profile') ? 'text-orange-500' : 'text-gray-400' }}">
        <img src="https://img.icons8.com/color/48/000000/user-folder.png" class="w-6 h-6">
        <span>Data Diri</span>
    </a>

    <a href="#" class="flex flex-col items-center text-xs font-fredoka text-gray-400 hover:text-red-500">
        <img src="https://img.icons8.com/color/96/logout-rounded-up.png" class="w-6 h-6">
        <span>Keluar</span>
    </a>
</nav>
@endsection