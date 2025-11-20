@extends('layouts.student')

@section('title', 'Laporan')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-4 sm:p-6" x-data="laporanData()">

  <!-- Header -->
  <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 
        flex items-center justify-between">

    <!-- Left: Logo + Judul -->
    <div class="flex items-center gap-3">
      <!-- Logo kecil -->
      <img src="https://img.icons8.com/color/96/info.png"
        class="w-7 h-7 sm:w-8 sm:h-8" alt="Aturan">

      <!-- Judul -->
      <h1 class="text-xl sm:text-2xl font-extrabold text-[#EB580C] font-fredoka">
        Aturan Main
      </h1>
    </div>

    <!-- Right: User (Desktop Only) -->
    <div class="hidden sm:flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Siswa' }}</b>
      </span>

      <div class="relative">
        <img src="/icons/avatar-hero.png" alt="Avatar"
          class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>

    <!-- Right: Avatar (Mobile Only) -->
    <div class="sm:hidden relative">
      <img src="/icons/avatar-hero.png" alt="Avatar"
        class="w-10 h-10 rounded-full border-2 border-[#EB580C] shadow-md">
      <span class="absolute -top-1 -right-1 bg-[#EB580C] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
        Lv. 1
      </span>
    </div>
  </header>


  {{-- KONTEN UTAMA --}}
  <div class="bg-white rounded-2xl shadow-md p-4 sm:p-8 border border-orange-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

      {{-- Grafik Ringkasan Nilai --}}
      <div class="border border-gray-300 rounded-2xl p-4 sm:p-6">
        <div class="flex items-center gap-3 mb-4">
          <img
            src="https://img.icons8.com/color/48/combo-chart.png"
            class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0">

          <h3 class="text-[#EB580C] font-fredoka text-lg sm:text-xl font-semibold leading-snug">
            Ringkasan Nilai Per-Level
          </h3>
        </div>
        <canvas id="chartLevel" height="200"></canvas>
      </div>

      {{-- Detail Level --}}
      <div class="border border-gray-300 rounded-2xl p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
          <div class="flex items-center gap-2">
            <img src="https://img.icons8.com/color/48/details-popup.png"
              class="w-8 h-8 sm:w-10 sm:h-10">

            <h3 class="text-[#EB580C] font-fredoka text-lg sm:text-xl font-semibold">
              Detail Level
            </h3>
          </div>

          <select x-model="selectedLevel"
            class="border border-gray-300 rounded-md px-2 py-1 text-gray-700 font-nunito w-full sm:w-auto">
            <template x-for="(level, index) in levels" :key="index">
              <option :value="index" x-text="level.nama"></option>
            </template>
          </select>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
          <table class="w-full border-collapse min-w-[360px]">
            <thead>
              <tr class="bg-orange-100 text-gray-700 font-bold text-sm sm:text-base">
                <th class="py-2 px-3 border">Step</th>
                <th class="py-2 px-3 border">Nilai</th>
                <th class="py-2 px-3 border">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <template x-for="(step, sIndex) in levels[selectedLevel].steps" :key="sIndex">
                <tr class="text-center border-t hover:bg-orange-50 transition text-sm sm:text-base">
                  <td class="border py-2 font-semibold" x-text="step.step"></td>
                  <td class="border py-2" x-text="step.nilai"></td>
                  <td class="border py-2">
                    <button class="hover:scale-110 transition-transform">
                      <img src="https://img.icons8.com/color/48/restart--v1.png"
                        class="w-5 h-5 sm:w-6 sm:h-6 mx-auto">
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>


  {{-- Evaluasi Belajar (AI Insight) --}}
  <div class="mt-10 border border-gray-300 rounded-2xl p-4 sm:p-6 bg-orange-50 shadow-inner">
    <div class="flex items-center gap-3 mb-3">
      <img
        src="/icons/robot.png"
        class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0">
      <h3 class="text-[#EB580C] font-fredoka text-xl sm:text-2xl font-semibold leading-snug">
        Evaluasi Belajar (AI Insight)
      </h3>
    </div>

    <div class="bg-orange-200 p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row gap-4 sm:gap-6">
      <img src="https://img.icons8.com/color/48/idea.png"
        class="w-10 h-10 sm:w-12 sm:h-12">

      <div class="flex-1">
        <p class="text-gray-800 font-nunito text-base sm:text-lg font-bold">
          Kamu hebat di:
        </p>

        <p class="text-gray-800 font-nunito text-base sm:text-lg">
          <span class="font-semibold text-[#EB580C]">{{ $aiInsight['hebat'] }}</span>
        </p>

        <p class="text-gray-800 font-nunito text-base sm:text-lg mt-3 font-bold">
          Tapi masih perlu latihan di:
        </p>

        <p class="text-gray-800 font-nunito text-base sm:text-lg">
          {{ $aiInsight['lemah'] }} <br>
          <span class="font-semibold">Tipe soal:</span> {{ $aiInsight['tipe'] }}
        </p>
      </div>
    </div>
  </div>

</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  function laporanData() {
    return {
      selectedLevel: 0,
      levels: @json($levels)
    };
  }

  document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('chartLevel').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($chartData['labels']),
        datasets: [{
          label: 'Nilai Rata-rata',
          data: @json($chartData['values']),
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
            suggestedMax: 100
          }
        }
      }
    });
  });
</script>
@endsection