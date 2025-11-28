@extends('layouts.teacher')

@section('title', 'Laporan Siswa')

@section('content')
<div x-data="{ selectedLevel: 1 }" class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6">

    <!-- HEADER -->
    <header class="flex items-center justify-between bg-white rounded-2xl shadow-md 
        px-4 sm:px-6 py-4 border border-orange-100 mb-6">

        <!-- LEFT -->
        <div class="flex items-center gap-3 min-w-0">

            <!-- Back -->
            <a href="{{ route('guru.kelas.show', ['id' => 1]) }}"
                class="flex items-center text-[#EB580C] hover:text-orange-700 transition">
                <img src="https://img.icons8.com/color/48/circled-left-2.png"
                    alt="Kembali" class="w-7 h-7 hover:scale-110 transition-transform">
            </a>

            <!-- Separator (desktop only) -->
            <div class="hidden sm:block w-px h-6 bg-gray-300"></div>

            <!-- Class Info -->
            <div class="flex items-center gap-3 min-w-0">
                <img src="https://img.icons8.com/color/96/class.png"
                    class="w-9 h-9 sm:w-10 sm:h-10" alt="Icon Kelas">

                <h1 class="font-fredoka text-xl sm:text-3xl text-[#EB580C] font-bold truncate max-w-xs sm:max-w-sm">
                    Matematika 3D
                </h1>
            </div>
        </div>

        <!-- Greeting (desktop only) -->
        <p class="hidden sm:block text-lg font-nunito text-gray-700">
            Halo, <b class="text-[#EB580C]">Septia</b>
        </p>
    </header>



    <!-- CONTENT CARD -->
    <div class="bg-white rounded-2xl shadow-md p-4 sm:p-8 border border-orange-100">

        <!-- STUDENT PROFILE -->
        <div class="flex items-center gap-4 mb-6 sm:mb-8">
            <img src="/icons/blank.jpeg"
                alt="Foto Siswa"
                class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-[#EB580C]">
            <h2 class="text-2xl sm:text-3xl font-bold font-nunito">ChoccoLatter</h2>
        </div>


        <!-- GRID: Chart + Detail Level -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

            <!-- Chart Box -->
            <div class="border border-gray-300 rounded-2xl p-4 sm:p-5">
                <div class="flex items-center gap-2 mb-4">
                    <img src="https://img.icons8.com/color/48/combo-chart.png" class="w-7 h-7 sm:w-8 sm:h-8">
                    <h3 class="text-[#EB580C] font-fredoka text-lg sm:text-xl font-semibold">
                        Ringkasan Nilai Per-Level
                    </h3>
                </div>
                <canvas id="nilaiChart" height="200"></canvas>
            </div>

            <!-- Detail Level -->
            <div class="border border-gray-300 rounded-2xl p-4 sm:p-5">

                <div class="flex flex-wrap items-center justify-between mb-4 gap-2">

                    <div class="flex items-center gap-2">
                        <img src="https://img.icons8.com/color/48/details-popup.png" class="w-7 h-7 sm:w-8 sm:h-8">
                        <h3 class="text-[#EB580C] font-fredoka text-lg sm:text-xl font-semibold">
                            Detail Level
                        </h3>
                    </div>

                    <select x-model="selectedLevel"
                        class="border border-gray-300 rounded-md px-2 py-1 text-gray-700 font-nunito w-32 sm:w-auto">
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                    </select>
                </div>

                <!-- TABLE NILAI -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm sm:text-base">
                        <thead>
                            <tr class="bg-orange-100 text-gray-700 font-bold">
                                <th class="py-2 px-3 border">Step</th>
                                <th class="py-2 px-3 border">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Level 1 -->
                            <template x-if="selectedLevel == 1">
                                <template x-for="(n, i) in [85, 80, 92, 98, 88]" :key="i">
                                    <tr class="text-center border-t">
                                        <td class="border py-2 font-semibold">Step <span x-text="i+1"></span></td>
                                        <td class="border py-2" x-text="n"></td>
                                    </tr>
                                </template>
                            </template>

                            <!-- Level 2 -->
                            <template x-if="selectedLevel == 2">
                                <template x-for="(n, i) in [78, 84, 90, 88, 82]" :key="i">
                                    <tr class="text-center border-t">
                                        <td class="border py-2 font-semibold">Step <span x-text="i+1"></span></td>
                                        <td class="border py-2" x-text="n"></td>
                                    </tr>
                                </template>
                            </template>

                            <!-- Level 3 -->
                            <template x-if="selectedLevel == 3">
                                <template x-for="(n, i) in [95, 92, 97, 99, 94]" :key="i">
                                    <tr class="text-center border-t">
                                        <td class="border py-2 font-semibold">Step <span x-text="i+1"></span></td>
                                        <td class="border py-2" x-text="n"></td>
                                    </tr>
                                </template>
                            </template>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- AI Insight -->
        <div class="mt-10 border border-gray-300 rounded-2xl p-4 sm:p-6 bg-white shadow-inner">
            <div class="flex items-center gap-3 mb-3">
                <img src="/icons/robot.png" class="w-8 h-8 sm:w-10 sm:h-10">
                <h3 class="text-[#EB580C] font-fredoka text-xl sm:text-2xl font-semibold">
                    Evaluasi Belajar (AI Insight)
                </h3>
            </div>

            <div class="bg-orange-200 p-4 sm:p-5 rounded-2xl shadow-md flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                <img src="https://img.icons8.com/color/48/idea.png" class="w-8 h-8 sm:w-10 sm:h-10 hidden sm:block">
                <div>
                    <p class="text-gray-800 font-nunito text-base sm:text-lg font-bold mb-1">
                        Siswa memiliki kelemahan pada materi:
                    </p>
                    <p class="text-gray-800 font-nunito text-base sm:text-lg leading-relaxed">
                        Soal cerita tentang “Waktu dan Durasi” <br>
                        <span class="font-semibold">Tipe soal:</span> Word Problem
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('nilaiChart').getContext('2d');

        const dataLevel = {
            labels: ['Level 1', 'Level 2', 'Level 3'],
            nilai: [88.6, 84.4, 95.4]
        };

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataLevel.labels,
                datasets: [{
                    label: 'Nilai Rata-rata',
                    data: dataLevel.nilai,
                    backgroundColor: ['#F59E0B', '#86EFAC', '#60A5FA'],
                    borderRadius: 6
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    },
                }
            }
        });
    });
</script>
@endsection