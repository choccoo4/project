@extends('layouts.teacher')

@section('title', 'Papan Skor')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6 relative">
    <!-- Header Atas -->
    <header class="flex justify-between items-center mb-10 bg-white rounded-2xl shadow-md px-6 py-4 border border-orange-100">
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/color/96/trophy.png" alt="Daftar Kelas" class="w-9 h-9 animate-bounce-slow">
            <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C]">Papan Skor</h1>
        </div>
        <p class="text-gray-800 text-lg font-nunito">Halo, <b class="text-[#EB580C]">Septia</b></p>
    </header>

    <!-- Card Papan Skor -->
    <div class="bg-white rounded-2xl border border-gray-300 shadow-md w-full max-w-5xl mx-auto pb-8">
        <!-- Header Papan Skor -->
        <div class="bg-[#FFE9C6] border border-orange-400 rounded-t-2xl py-3 text-center">
            <h2 class="text-2xl font-bold text-gray-800 font-nunito">Papan Skor</h2>
        </div>

        <!-- Isi -->
        <div class="flex flex-col items-center mt-8 px-6">
            <!-- Icon Trophy -->
            <img src="https://img.icons8.com/?size=100&id=SG4IvAiNNVRd&format=png&color=000000" alt="trophy" class="w-40 h-40 mb-6">

            <!-- Dropdown Kelas -->
            <div x-data="{ open: false, selected: 'Kelas' }" class="relative self-end mb-4">
                <button @click="open = !open"
                    class="flex items-center justify-between w-32 bg-white border border-gray-400 rounded-lg px-3 py-1.5 text-gray-700 font-semibold text-sm shadow-sm">
                    <span x-text="selected"></span>
                    <img src="https://img.icons8.com/ios-glyphs/14/000000/expand-arrow--v2.png" alt="">
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 w-32 bg-white border border-gray-300 rounded-lg shadow-md">
                    <ul class="text-gray-700 text-sm font-medium">
                        <li @click="selected='3A'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3A</li>
                        <li @click="selected='3B'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3B</li>
                        <li @click="selected='3C'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3C</li>
                    </ul>
                </div>
            </div>

            <!-- Garis -->
            <div class="w-full border-t border-gray-400 mb-2"></div>

            <!-- Daftar Skor -->
            <div class="w-full space-y-4 mt-4 text-lg font-nunito text-gray-800">
                <!-- 1 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🥇</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Chocco</span>
                    </div>
                    <span class="font-bold text-xl">320 XP</span>
                </div>
                <!-- 2 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🥈</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Latte</span>
                    </div>
                    <span class="font-bold text-xl">290 XP</span>
                </div>
                <!-- 3 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🥉</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Mocca</span>
                    </div>
                    <span class="font-bold text-xl">275 XP</span>
                </div>
                <!-- 4 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-xl w-6 text-center">4</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Cowi</span>
                    </div>
                    <span class="font-bold text-xl">265 XP</span>
                </div>
                <!-- 5 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-xl w-6 text-center">5</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Molly</span>
                    </div>
                    <span class="font-bold text-xl">265 XP</span>
                </div>
                <!-- 6 -->
                <div class="flex items-center justify-between px-10">
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-xl w-6 text-center">6</span>
                        <img src="https://img.icons8.com/color/96/student-male--v1.png"
                            class="w-10 h-10 rounded-full border-2 border-orange-600"
                            alt="avatar">
                        <span class="font-semibold text-xl">Oreo</span>
                    </div>
                    <span class="font-bold text-xl">250 XP</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection