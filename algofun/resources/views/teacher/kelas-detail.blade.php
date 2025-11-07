@extends('layouts.teacher')

@section('title', 'Detail Kelas')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] flex">
    <div class="flex-1 px-8 py-8">
        {{-- Header --}}
        <header class="flex justify-between items-center mb-10 bg-white rounded-2xl shadow-md px-6 py-4 border border-orange-100">
            <div class="flex items-center gap-3">
                <img src="https://img.icons8.com/color/96/school-building.png" alt="Daftar Kelas" class="w-9 h-9">
                <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C]">Matematika 3D</h1>
            </div>
            <p class="text-gray-800 text-lg font-nunito">
                Halo, <b class="text-[#EB580C]">Septia</b>
            </p>
        </header>

        {{-- Tabs --}}
        <div class="bg-white rounded-2xl shadow-md px-8 py-6">
            <div class="flex border-b border-gray-300 mb-6">
                <a href="{{ route('guru.kelas.show', ['id' => 1]) }}"
                    class="px-6 pb-3 text-2xl font-fredoka font-semibold text-neutral-600 border-b-4 border-orange-400 text-[#EB580C]">
                    Siswa
                </a>
                <a href="{{ route('guru.kelas.settings', ['id' => 1]) }}"
                    class="px-6 pb-3 text-2xl font-fredoka font-semibold text-neutral-600 border-b-4 border-transparent hover:border-orange-400 hover:text-[#EB580C] transition">
                    Pengaturan
                </a>
            </div>

            {{-- Header Row --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-bold font-nunito">30 Siswa</h2>

                <button class="flex items-center gap-2 border-2 border-orange-600 text-neutral-600 font-fredoka font-semibold px-4 py-2 rounded-2xl hover:bg-orange-50 transition">
                    <img src="https://img.icons8.com/color/48/export-csv.png" alt="Export" class="w-5 h-5">
                    Ekspor Laporan
                </button>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-xl overflow-hidden">
                    <thead class="bg-orange-100 text-left">
                        <tr class="text-xl font-bold font-nunito text-black">
                            <th class="px-6 py-3 border-b border-gray-300">Nama</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Level</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Perolehan XP</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Waktu Belajar</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Progress Belajar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index => $item)
                        <tr
                            class="border-b border-gray-200 hover:bg-orange-50 transition cursor-pointer"
                            onclick="window.location.href='{{ route('guru.kelas.report', ['id' => 1, 'student_id' => $index + 1]) }}'">
                            <td class="flex items-center gap-3 px-6 py-3 font-bold font-nunito">
                                <img src="https://img.icons8.com/color/96/student-male--v1.png"
                                    class="w-7 h-7 rounded-full border-2 border-orange-600"
                                    alt="avatar">
                                {{ $item->nama }}
                            </td>
                            <td class="text-center px-6 py-3 font-nunito font-bold">{{ $item->level }}</td>
                            <td class="text-center px-6 py-3 font-nunito font-bold">{{ $item->xp }} XP</td>
                            <td class="text-center px-6 py-3 font-nunito font-bold">{{ $item->waktu }} Menit</td>
                            <td class="text-center px-6 py-3">
                                <div class="flex items-center justify-center gap-3">
                                    <div class="w-48 bg-gray-300 rounded-full h-2.5">
                                        <div class="bg-amber-400 h-2.5 rounded-full"
                                            style="width: {{ ($item->progress / $item->total_step) * 100 }}%">
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold font-nunito">
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