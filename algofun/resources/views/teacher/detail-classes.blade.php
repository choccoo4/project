@extends('layouts.teacher')

@section('title', 'Detail Kelas')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] flex">
    <div class="flex-1 px-4 sm:px-8 py-8">

        {{-- Header --}}
        <header class="mb-6 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
            flex items-center justify-between">

            <!-- Left: Icon + Judul -->
            <div class="flex items-center gap-3 min-w-0">
                <img src="https://img.icons8.com/color/96/school-building.png"
                    class="w-7 h-7 sm:w-8 sm:h-8" alt="Daftar Kelas">

                <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka truncate">
                    Matematika 3D
                </h1>
            </div>

            <!-- Right: User greeting (Desktop only) -->
            <div class="hidden sm:flex items-center space-x-4 font-nunito">
                <img src="https://img.icons8.com/color/96/appointment-reminders.png" class="w-8 h-8" alt="Notifikasi">
                <span class="text-gray-700 text-lg">
                    Halo, <b class="text-[#EB580C]">Septia</b>
                </span>
            </div>

        </header>


        {{-- Tabs --}}
        <div class="bg-white rounded-2xl shadow-md px-4 sm:px-8 py-6">

            <div class="flex flex-wrap border-b border-gray-300 mb-6">
                <a href="{{ route('guru.kelas.show', ['id' => 1]) }}"
                    class="px-4 sm:px-6 pb-3 text-xl sm:text-2xl font-fredoka font-semibold 
                    text-neutral-600 border-b-4 border-orange-400 text-[#EB580C]">
                    Siswa
                </a>

                <a href="{{ route('guru.kelas.settings', ['id' => 1]) }}"
                    class="px-4 sm:px-6 pb-3 text-xl sm:text-2xl font-fredoka font-semibold 
                    text-neutral-600 border-b-4 border-transparent hover:border-orange-400 
                    hover:text-[#EB580C] transition">
                    Pengaturan
                </a>
            </div>


            {{-- Header Row --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <h2 class="text-2xl sm:text-3xl font-bold font-nunito">
                    30 Siswa
                </h2>

                <button class="flex items-center gap-2 border-2 border-orange-600 
                    text-neutral-600 font-fredoka font-semibold px-4 py-2 rounded-2xl 
                    hover:bg-orange-50 transition w-full sm:w-auto justify-center">
                    <img src="https://img.icons8.com/color/48/export-csv.png"
                        alt="Export" class="w-5 h-5">
                    Ekspor Laporan
                </button>
            </div>


            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-gray-300">
                <table class="min-w-full">
                    <thead class="bg-orange-100 text-left">
                        <tr class="text-lg sm:text-xl font-bold font-nunito text-black">
                            <th class="px-4 sm:px-6 py-3 border-b border-gray-300">Nama</th>
                            <th class="px-4 sm:px-6 py-3 border-b border-gray-300 text-center">Level</th>
                            <th class="px-4 sm:px-6 py-3 border-b border-gray-300 text-center">XP</th>
                            <th class="px-4 sm:px-6 py-3 border-b border-gray-300 text-center">Waktu</th>
                            <th class="px-4 sm:px-6 py-3 border-b border-gray-300 text-center">Progress</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswa as $index => $item)
                        <tr class="border-b border-gray-200 hover:bg-orange-50 transition cursor-pointer"
                            onclick="window.location.href='{{ route('guru.kelas.report', ['id' => 1, 'student_id' => $index + 1]) }}'">

                            <td class="flex items-center gap-3 px-4 sm:px-6 py-3 font-bold font-nunito whitespace-nowrap">
                                <img src="/icons/avatar-hero.png"
                                    class="w-7 h-7 rounded-full border-2 border-orange-600">
                                {{ $item->nama }}
                            </td>

                            <td class="text-center px-4 sm:px-6 py-3 font-nunito font-bold">
                                {{ $item->level }}
                            </td>

                            <td class="text-center px-4 sm:px-6 py-3 font-nunito font-bold">
                                {{ $item->xp }} XP
                            </td>

                            <td class="text-center px-4 sm:px-6 py-3 font-nunito font-bold">
                                {{ $item->waktu }} Menit
                            </td>

                            <td class="text-center px-4 sm:px-6 py-3">
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3">

                                    <!-- Bar -->
                                    <div class="w-32 sm:w-48 bg-gray-300 rounded-full h-2.5">
                                        <div class="bg-amber-400 h-2.5 rounded-full"
                                            style="width: {{ ($item->progress / $item->total_step) * 100 }}%">
                                        </div>
                                    </div>

                                    <!-- Text -->
                                    <span class="text-xs font-bold font-nunito whitespace-nowrap">
                                        {{ $item->progress }}/{{ $item->total_step }} Step
                                    </span>

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection