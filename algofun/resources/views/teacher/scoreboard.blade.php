@extends('layouts.teacher')

@section('title', 'Papan Skor')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-3 sm:p-6" x-data="{ tab: 'mingguan' }">

    <!-- Header -->
    <header class="mb-6 sm:mb-8 bg-white rounded-xl sm:rounded-2xl shadow px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">
        <!-- Left: Logo + Judul -->
        <div class="flex items-center gap-2 sm:gap-3">
            <img src="https://img.icons8.com/color/96/trophy.png" class="w-6 h-6 sm:w-8 sm:h-8" alt="Trophy">
            <h1 class="text-lg sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
                Papan Skor
            </h1>
        </div>

        <!-- Right: User info -->
        <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
            <span class="text-gray-700 text-lg">
                Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
            </span>
            <div class="relative">
                <img src="{{ asset('icons/blank.jpeg') }}" alt="Avatar" class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
                <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                    Lv. 1
                </span>
            </div>
        </div>
        <!-- Mobile -->
        <div class="sm:hidden relative">
            <img src="{{ asset('icons/blank.jpeg') }}" alt="Avatar" class="w-8 h-8 rounded-full border-2 border-[#EB580C] shadow-md">
            <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[8px] font-bold px-1 py-0.5 rounded-full shadow">
                Lv.1
            </span>
        </div>
    </header>

    <!-- Main Content Container -->
    <div class="w-full max-w-4xl mx-auto">

        <!-- Tab Menu -->
        <div class="flex w-full bg-white rounded-t-xl sm:rounded-t-2xl overflow-hidden shadow-md mb-1">
            <button
                @click="tab = 'mingguan'"
                :class="tab === 'mingguan' ? 'bg-[#FFF2CC] text-[#EB580C]' : 'bg-white text-gray-700 hover:bg-gray-50'"
                class="flex-1 py-2 sm:py-3 text-sm sm:text-base font-semibold text-center transition duration-200">
                Mingguan
            </button>
            <button
                @click="tab = 'kelas'"
                :class="tab === 'kelas' ? 'bg-[#FFF2CC] text-[#EB580C]' : 'bg-white text-gray-700 hover:bg-gray-50'"
                class="flex-1 py-2 sm:py-3 text-sm sm:text-base font-semibold text-center transition duration-200">
                Kelas Saya
            </button>
        </div>

        <!-- Tab Content -->
        <div class="bg-white shadow-lg rounded-b-xl sm:rounded-b-2xl rounded-tr-xl sm:rounded-tr-2xl p-4 sm:p-6">

            <!-- Tab Mingguan -->
            <div x-show="tab === 'mingguan'">
                <!-- Trophy Icon -->
                <div class="flex justify-center mb-4 sm:mb-6">
                    <img src="{{ asset('icons/big-trophy.png') }}" class="w-32 h-24 sm:w-40 sm:h-32" alt="Trophy Besar">
                </div>

                <!-- Garis -->
                <div class="w-full border-t border-gray-300 mb-3 sm:mb-4"></div>

                <!-- Daftar Papan Skor Mingguan -->
                <div class="divide-y divide-gray-200">
                    @foreach ($papanSkorMingguan as $item)
                    <!-- Mobile Layout - MINGGUAN -->
                    <div class="sm:hidden py-3 px-2 hover:bg-gray-50 rounded-lg transition duration-200">
                        <div class="flex items-start gap-3">
                            <!-- Rank & Medal & XP -->
                            <div class="flex-shrink-0 w-12 text-center">
                                <div class="font-bold text-gray-600 text-sm mb-1">
                                    @if ($item['medal'])
                                    <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-5 h-5 mx-auto">
                                    @else
                                    #{{ $item['rank'] }}
                                    @endif
                                </div>
                                <!-- XP Mobile -->
                                <span class="text-[#FF7A00] font-bold text-xs whitespace-nowrap">{{ $item['xp'] }} XP</span>
                            </div>

                            <!-- Foto Profil di Tengah -->
                            <div class="flex-shrink-0">
                                <img src="{{ asset('icons/blank.jpeg') }}"
                                    class="w-10 h-10 rounded-full border-2 border-gray-200"
                                    alt="Avatar {{ $item['nama'] }}">
                            </div>

                            <!-- Nama & Sekolah -->
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-gray-800 text-sm mb-1 truncate">{{ $item['nama'] }}</div>
                                <div class="text-gray-600 text-xs truncate">{{ $item['sekolah'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout - MINGGUAN -->
                    <div class="hidden sm:grid sm:grid-cols-12 gap-4 py-3 px-2 items-center hover:bg-gray-50 rounded-lg transition duration-200">
                        <!-- Rank & Medal -->
                        <div class="col-span-1 text-center font-bold text-gray-600">
                            @if ($item['medal'])
                            <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-6 h-6 mx-auto">
                            @else
                            {{ $item['rank'] }}
                            @endif
                        </div>

                        <!-- Profil Siswa -->
                        <div class="col-span-5 flex items-center gap-3 min-w-0">
                            <img src="{{ asset('icons/blank.jpeg') }}"
                                class="w-10 h-10 rounded-full border-2 border-gray-200 flex-shrink-0"
                                alt="Avatar {{ $item['nama'] }}">
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-800 truncate">{{ $item['nama'] }}</div>
                            </div>
                        </div>

                        <!-- Asal Sekolah -->
                        <div class="col-span-4 text-gray-600 text-sm truncate">
                            {{ $item['sekolah'] }}
                        </div>

                        <!-- XP -->
                        <div class="col-span-2 text-right">
                            <span class="text-[#FF7A00] font-bold">{{ $item['xp'] }} XP</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab Kelas Saya -->
            <div x-show="tab === 'kelas'">
                <!-- Trophy Icon -->
                <div class="flex justify-center mb-4 sm:mb-6">
                    <img src="{{ asset('icons/big-trophy.png') }}" class="w-32 h-24 sm:w-40 sm:h-32" alt="Trophy Besar">
                </div>

                <!-- Dropdown Kelas -->
                <div class="flex justify-end mb-4">
                    <div x-data="{ open: false, selected: 'Kelas' }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-28 sm:w-32 bg-white border border-gray-400 rounded-lg px-3 py-1.5 text-gray-700 font-semibold text-sm shadow-sm">
                            <span x-text="selected"></span>
                            <img src="https://img.icons8.com/ios-glyphs/14/000000/expand-arrow--v2.png">
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-28 sm:w-32 bg-white border border-gray-300 rounded-lg shadow-md">
                            <ul class="text-gray-700 text-sm font-medium">
                                <li @click="selected='3A'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3A</li>
                                <li @click="selected='3B'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3B</li>
                                <li @click="selected='3C'; open=false" class="px-3 py-2 hover:bg-orange-100 cursor-pointer">3C</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Daftar Papan Skor Kelas -->
                <div class="divide-y divide-gray-200">
                    @foreach ($papanSkorKelas as $item)
                    <!-- Mobile Layout - KELAS SAYA -->
                    <div class="sm:hidden py-3 px-2 hover:bg-gray-50 rounded-lg transition duration-200">
                        <div class="flex items-center justify-between">
                            <!-- Kiri: Rank + Profil -->
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <!-- Rank & Medal -->
                                <div class="flex-shrink-0 w-6 text-center">
                                    @if ($item['medal'])
                                    <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-5 h-5">
                                    @else
                                    <span class="font-bold text-gray-600 text-sm">#{{ $item['rank'] }}</span>
                                    @endif
                                </div>

                                <!-- Foto Profil -->
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('icons/blank.jpeg') }}"
                                        class="w-8 h-8 rounded-full border-2 border-gray-200"
                                        alt="Avatar {{ $item['nama'] }}">
                                </div>

                                <!-- Nama -->
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-gray-800 text-sm truncate">{{ $item['nama'] }}</div>
                                </div>
                            </div>

                            <!-- Kanan: XP -->
                            <div class="flex-shrink-0 ml-2">
                                <span class="text-[#FF7A00] font-bold text-sm whitespace-nowrap">{{ $item['xp'] }} XP</span>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout - KELAS SAYA -->
                    <div class="hidden sm:grid sm:grid-cols-12 gap-4 py-3 px-2 items-center hover:bg-gray-50 rounded-lg transition duration-200">
                        <!-- Rank & Medal -->
                        <div class="col-span-1 text-center font-bold text-gray-600">
                            @if ($item['medal'])
                            <img src="{{ asset('icons/'.$item['medal']) }}" alt="Medal" class="w-6 h-6 mx-auto">
                            @else
                            {{ $item['rank'] }}
                            @endif
                        </div>

                        <!-- Profil Siswa -->
                        <div class="col-span-8 flex items-center gap-3 min-w-0">
                            <img src="{{ asset('icons/blank.jpeg') }}"
                                class="w-10 h-10 rounded-full border-2 border-gray-200 flex-shrink-0"
                                alt="Avatar {{ $item['nama'] }}">
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-800 truncate">{{ $item['nama'] }}</div>
                            </div>
                        </div>

                        <!-- XP -->
                        <div class="col-span-3 text-right">
                            <span class="text-[#FF7A00] font-bold">{{ $item['xp'] }} XP</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection