@extends('layouts.teacher')

@section('content')
<div class="min-h-screen bg-[#FFF8F2] p-6">

  <!-- Header -->
  <header class="flex justify-between items-center mb-8 bg-white rounded-2xl shadow px-6 py-4">
    <h1 class="font-fredoka text-2xl font-extrabold text-[#EB580C] flex items-center gap-2">
      <img src="https://img.icons8.com/color/96/combo-chart--v1.png" class="w-8 h-8" alt="Dashboard">
      Dashboard Guru
    </h1>
    <div class="flex items-center gap-4">
      <img src="https://img.icons8.com/color/96/appointment-reminders.png" class="w-8 h-8" alt="Notifikasi">
      <p class="text-gray-800 text-lg">Halo, <b class="text-[#EB580C]">Septia</b></p>
    </div>
  </header>

  <!-- Grid utama -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- Grafik Progres -->
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="font-fredoka text-xl font-bold mb-4 text-[#555555] flex items-center gap-2">
        <img src="https://img.icons8.com/color/96/graph--v1.png" class="w-6 h-6">
        Distribusi Level Siswa
      </h2>
      <canvas id="progressChart" class="w-full" style="max-height: 280px;"></canvas>
      <p class="mt-3 text-sm text-gray-500 text-center italic">
        Menunjukkan berapa banyak siswa berada di setiap level pembelajaran
      </p>
    </div>

    <!-- Grafik Topik Tersulit -->
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="font-fredoka text-xl font-bold mb-4 text-[#555555] flex items-center gap-2">
        <img src="https://img.icons8.com/color/96/pie-chart.png" class="w-6 h-6">
        Topik Tersulit
      </h2>
      <canvas id="difficultyChart" class="w-full" style="max-height: 280px;"></canvas>
    </div>

  </div>

  <!-- Insight AI -->
  <div class="bg-white rounded-2xl shadow p-6 mt-8 border-l-8 border-[#EB580C]">
    <div class="flex items-center gap-3 mb-3">
      <img src="https://img.icons8.com/color/48/artificial-intelligence.png" class="w-10 h-10">
      <h3 class="text-[#EB580C] font-fredoka text-2xl font-semibold">Evaluasi Belajar (AI Insight)</h3>
    </div>
    <div class="bg-orange-200 p-5 rounded-2xl shadow-md flex gap-4">
      <img src="https://img.icons8.com/color/48/idea.png" class="w-10 h-10">
      <div>
        <p class="text-gray-700 text-sm leading-relaxed">
          30% siswa gagal di <b>soal cerita pecahan</b>.<br>
          Level 3 – Step 4 paling sering diulang.<br>
          AI menghasilkan <b>230 soal baru</b> minggu ini.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Dummy Grafik pakai Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // === GRAFIK PROGRES (BAR CHART) ===
  const ctxProgress = document.getElementById('progressChart');
  new Chart(ctxProgress, {
    type: 'bar',
    data: {
      labels: ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5'],
      datasets: [{
        label: 'Jumlah Siswa',
        data: [35, 50, 40, 25, 10], // contoh dummy data
        backgroundColor: '#FFB84C',
        borderRadius: 8,
        barThickness: 40,
        hoverBackgroundColor: '#EB580C',
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 10
          },
          grid: {
            color: '#F3F3F3'
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          callbacks: {
            label: (context) => `${context.parsed.y} siswa`
          }
        }
      }
    }
  });


  // === GRAFIK TOPIK TERSULIT (PIE CHART INTERAKTIF) ===
  const ctxDifficulty = document.getElementById('difficultyChart');
  new Chart(ctxDifficulty, {
    type: 'pie',
    data: {
      labels: [
        'Cerita Pecahan',
        'Perkalian Dasar',
        'Pola Bilangan',
        'Pengurangan',
        'Pembagian',
        'Lainnya'
      ],
      datasets: [{
        data: [27, 26, 19, 12, 12, 4],
        backgroundColor: [
          '#FF9F40',
          '#FFCD56',
          '#4BC0C0',
          '#36A2EB',
          '#9966FF',
          '#C9CBCF'
        ],
        hoverOffset: 8,
        borderWidth: 2,
        borderColor: '#FFFFFF'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            usePointStyle: true,
            boxWidth: 12,
            font: {
              size: 12
            }
          }
        },
        tooltip: {
          backgroundColor: '#EB580C',
          titleFont: {
            size: 14,
            weight: 'bold'
          },
          bodyFont: {
            size: 13
          },
          callbacks: {
            label: (context) => {
              let label = context.label || '';
              let value = context.parsed || 0;
              return `${label}: ${value}% siswa mengalami kesulitan`;
            }
          }
        }
      }
    }
  });
</script>

@endsection