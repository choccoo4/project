@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6" x-data="laporanData()">

  {{-- HEADER --}}
  <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4">
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

  {{-- GRID UTAMA --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- RINGKASAN NILAI --}}
    <div class="bg-white rounded-2xl shadow p-6 md:col-span-2">
      <h2 class="text-xl font-bold text-[#555555] mb-4 flex items-center gap-2 font-fredoka">
        <img src="https://img.icons8.com/scribby/50/positive-dynamic.png" class="w-6 h-6" alt="Chart">
        Ringkasan Nilai Per-Level
      </h2>
      <div class="flex items-center justify-center h-60">
        <canvas id="chartLevel"></canvas>
      </div>
    </div>

    {{-- DETAIL LEVEL --}}
    <div class="bg-white rounded-2xl shadow p-6" x-data>
      <h2 class="text-xl font-bold text-[#555555] mb-4 flex items-center gap-2 font-fredoka">
        <img src="https://img.icons8.com/office/40/details-popup.png" class="w-6 h-6" alt="Detail">
        Detail Level
      </h2>

      {{-- Dropdown pilih level --}}
      <div class="mb-4">
        <label class="block text-sm font-semibold text-gray-600 mb-1">Pilih Level</label>
        <select x-model="selectedLevel" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#EB580C]">
          <template x-for="(level, index) in levels" :key="index">
            <option :value="index" x-text="level.nama"></option>
          </template>
        </select>
      </div>

      {{-- Table detail step --}}
      <div class="bg-[#EB580C]/10 p-3 rounded-xl">
        <h3 class="font-bold text-[#EB580C]" x-text="levels[selectedLevel].nama"></h3>
        <table class="w-full text-sm text-gray-600 mt-2">
          <thead>
            <tr class="border-b font-semibold text-[#555]">
              <th class="text-left py-2">Step</th>
              <th class="text-left py-2">Nilai</th>
              <th class="text-left py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="(step, sIndex) in levels[selectedLevel].steps" :key="sIndex">
              <tr class="border-b hover:bg-gray-50">
                <td x-text="step.step"></td>
                <td x-text="step.nilai"></td>
                <td><button class="text-blue-500 text-xs ml-2">🔄</button></td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- EVALUASI BELAJAR (AI Insight) --}}
  <div class="mt-8 bg-white rounded-2xl shadow p-6 border-l-8 border-[#EB580C]">
    <h2 class="text-lg font-bold text-[#EB580C] mb-3 font-fredoka flex items-center gap-2">
      <img src="/icons/robot.png" alt="Insight" class="w-15 h-15">
      Evaluasi Belajar (AI Insight)
    </h2>
    <div class="bg-[#FFF2CC] rounded-xl p-4">
      <p class="text-gray-800 text-sm leading-relaxed">
        Kamu hebat di:
        <ul class="list-disc ml-6 font-semibold text-[#EB580C]">
          <li>{{ $aiInsight['hebat'] }}</li>
        </ul>
      </p>
      <p class="text-gray-800 text-sm leading-relaxed mt-2">
        Tapi masih perlu latihan di:
        <ul class="list-disc ml-6">
          <li>{{ $aiInsight['lemah'] }}</li>
          <li>Tipe soal: <b>{{ $aiInsight['tipe'] }}</b></li>
        </ul>
      </p>
      <div class="flex justify-end mt-4">
        <button class="bg-[#FFB84C] hover:bg-[#FFA500] text-white font-semibold px-5 py-2 rounded-full shadow-md transition font-fredoka">
          Rekomendasi
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function laporanData() {
  return {
    selectedLevel: 0,
    levels: @json($levels)
  };
}

const ctx = document.getElementById('chartLevel');
if (ctx) {
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($chartData['labels']),
      datasets: [{
        label: 'Nilai',
        data: @json($chartData['values']),
        backgroundColor: ['#FFB84C', '#EB580C', '#FFD580', '#FF924C', '#FFB84C', '#EB580C'],
        borderRadius: 6
      }]
    },
    options: {
      scales: { y: { beginAtZero: true } },
      plugins: { legend: { display: false } }
    }
  });
}
</script>
@endsection
