<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        $levels = $this->getLevelsData();
        $activeStepIndex = 2; // Step ke-3 sebagai aktif (0-based index)
        $stepProgress = [3, 2, 1, 0, 0]; // Progress tiap step (0-3)

        return view('students.learn-path', compact('levels', 'activeStepIndex', 'stepProgress'));
    }

    private function getLevelsData()
    {
        $stepTitles = [
            'Bilangan dan Lambang Bilangan Cacah sampai 1.000',
            'Nilai Tempat Bilangan Cacah sampai 1.000',
            'Membandingkan dan Mengurutkan Bilangan Cacah sampai 1.000',
            'Penjumlahan dan Pengurangan Bilangan Cacah sampai 100',
            'Perkalian dan Pembagian Bilangan Cacah sampai 100',
        ];

        $levelColors = [
            1 => [
                'primary' => '#8EE000',    // Hijau dari palette tombol
                'secondary' => '#7BC800',  // Hijau lebih gelap 
                'light' => '#E0FFE7'       // Hijau muda dari aksen
            ],
            2 => [
                'primary' => '#1CB0F6',    // Biru dari palette tombol  
                'secondary' => '#0FA3DB',  // Biru lebih gelap
                'light' => '#DAF8FF'       // Biru muda dari aksen
            ],
            3 => [
                'primary' => '#FFC107',    // Kuning dari palette tombol
                'secondary' => '#FFB800',  // Kuning dari secondary
                'light' => '#FFF6CF'       // Kuning muda dari aksen
            ],
            4 => [
                'primary' => '#CE82FF',    // Ungu (tetap, cocok dengan palette)
                'secondary' => '#DDABFF',  // Ungu muda
                'light' => '#F4DDFF'       // Ungu muda dari aksen
            ],
            5 => [
                'primary' => '#E03F00',    // Merah dari palette tombol
                'secondary' => '#FF6F61',  // Merah dari secondary  
                'light' => '#FFEAD1'       // Oranye muda dari aksen
            ],
        ];

        return [
            (object)[
                'number' => 1,
                'title' => 'Bilangan Cacah sampai 1.000',
                'color' => $levelColors[1],
                'steps' => $this->generateSteps(1, $stepTitles),
            ],
            (object)[
                'number' => 2,
                'title' => 'Kalimat Matematika',
                'color' => $levelColors[2],
                'steps' => $this->generateSteps(2, $stepTitles),
            ],
        ];
    }

    private function generateSteps($levelNumber, $titles)
    {
        $stepIcons = [
            'https://img.icons8.com/?size=100&id=TyCKx8nVDY0n&format=png&color=000000', // 1
            'https://img.icons8.com/?size=100&id=v0qkjNOz5TXt&format=png&color=000000', // 2  
            'https://img.icons8.com/?size=100&id=eYYTdLLHOr9O&format=png&color=000000', // 4
            'https://img.icons8.com/?size=100&id=m9l0TYn8mjwN&format=png&color=000000',
            'https://img.icons8.com/?size=100&id=iXyB8gYxLEaa&format=png&color=000000', // 5
        ];

        $steps = [];
        for ($i = 1; $i <= 5; $i++) {
            $steps[] = (object)[
                'number' => $i,
                'title' => $titles[$i - 1] ?? "Step {$i}",
                'left_icon' => $stepIcons[$i - 1], // Pakai icon sesuai urutan
                'right_icon' => $stepIcons[$i - 1],
            ];
        }
        return $steps;
    }
}
