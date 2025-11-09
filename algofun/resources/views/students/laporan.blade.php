@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6" x-data="laporanData()">

  {{-- HEADER --}}
  <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4 border border-orange-100">
    <h1 class="text-2xl font-extrabold text-[#EB580C] flex items-center gap-2 font-fredoka">
      <img src="https://img.icons8.com/color/96/report-card.png" class="w-8 h-8" alt="Laporan Belajar">
      Laporan Belajar
    </h1>
    <div class="flex items-center space-x-4 font-nunito-semibold">
      <span class="text-gray-700 text-lg">
        Halo, <b class="text-[#EB580C]">{{ Auth::user()->name ?? 'Chocco' }}</b>
      </span>
      <div class="relative">
        <img src="/icons/avatar-hero.png" alt="Avatar"
          class="w-14 h-14 rounded-full border-4 border-[#EB580C] shadow-md">
        <span class="absolute -top-2 -right-2 bg-[#EB580C] text-white text-xs font-bold px-2 py-1 rounded-full shadow">
          Lv. 1
        </span>
      </div>
    </div>
  </header>

  {{-- KONTEN UTAMA --}}
  <div class="bg-white rounded-2xl shadow-md p-8 border border-orange-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

      {{-- Grafik Ringkasan Nilai --}}
      <div class="border border-gray-300 rounded-2xl p-4">
        <div class="flex items-center gap-2 mb-4">
          <img src="https://img.icons8.com/color/48/combo-chart.png" class="w-8 h-8" alt="Chart Icon">
          <h3 class="text-[#EB580C] font-fredoka text-xl font-semibold">Ringkasan Nilai Per-Level</h3>
        </div>
        <canvas id="chartLevel" height="200"></canvas>
      </div>

      {{-- Detail Level --}}
      <div class="border border-gray-300 rounded-2xl p-4">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-2">
            <img src="https://img.icons8.com/color/48/details-popup.png" class="w-8 h-8" alt="Detail Icon">
            <h3 class="text-[#EB580C] font-fredoka text-xl font-semibold">Detail Level</h3>
          </div>
          <select x-model="selectedLevel"
            class="border border-gray-300 rounded-md px-2 py-1 text-gray-700 font-nunito">
            <template x-for="(level, index) in levels" :key="index">
              <option :value="index" x-text="level.nama"></option>
            </template>
          </select>
        </div>

        {{-- Table Nilai --}}
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-orange-100 text-gray-700 font-bold">
              <th class="py-2 px-3 border">Step</th>
              <th class="py-2 px-3 border">Nilai</th>
              <th class="py-2 px-3 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="(step, sIndex) in levels[selectedLevel].steps" :key="sIndex">
              <tr class="text-center border-t hover:bg-orange-50 transition">
                <td class="border py-2 font-semibold" x-text="step.step"></td>
                <td class="border py-2" x-text="step.nilai"></td>
                <td class="border py-2">
                  <button class="hover:scale-110 transition-transform">
                    <img src='https://img.icons8.com/color/48/restart--v1.png' alt='Ulang' class='w-6 h-6 mx-auto'>
                  </button>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>

    {{-- Evaluasi Belajar (AI Insight) --}}
    <div class="mt-10 border border-gray-300 rounded-2xl p-6 bg-orange-50 shadow-inner">
      <div class="flex items-center gap-3 mb-3">
        <img src="/icons/robot.png" class="w-10 h-10" alt="Robot Icon">
        <h3 class="text-[#EB580C] font-fredoka text-2xl font-semibold">Evaluasi Belajar (AI Insight)</h3>
      </div>
      <div class="bg-orange-200 p-5 rounded-2xl flex gap-4">
        <img src="https://img.icons8.com/color/48/idea.png" class="w-10 h-10" alt="Insight Icon">
        <div>
          <p class="text-gray-800 font-nunito text-lg font-bold">
            Kamu hebat di:
          </p>
          <p class="text-gray-800 font-nunito text-lg">
            <span class="font-semibold text-[#EB580C]">{{ $aiInsight['hebat'] }}</span>
          </p>
          <p class="text-gray-800 font-nunito text-lg mt-3 font-bold">
            Tapi masih perlu latihan di:
          </p>
          <p class="text-gray-800 font-nunito text-lg">
            {{ $aiInsight['lemah'] }}<br>
            <span class="font-semibold">Tipe soal:</span> {{ $aiInsight['tipe'] }}
          </p>
        </div>
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

    const dataLevel = {
      labels: ['Level 1', 'Level 2', 'Level 3'],
      nilai: [88.6, 84.4, 95.4]
    };

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
            suggestedMax: 100,
            ticks: {
              stepSize: 20,
              color: '#4B5563',
              font: {
                size: 12,
                family: 'Nunito'
              }
            }
          },
          x: {
            ticks: {
              color: '#4B5563',
              font: {
                size: 12,
                family: 'Fredoka'
              }
            }
          }
        }
      }
    });
  });
</script>
@endsection