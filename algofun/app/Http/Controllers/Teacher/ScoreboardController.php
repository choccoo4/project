<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    public function index()
    {
        // Data untuk tab Mingguan (global - dengan sekolah)
        $papanSkorMingguan = [
            ['rank' => 1, 'nama' => 'Budi Santoso', 'sekolah' => 'SD Negeri 01 Jakarta', 'xp' => 450, 'avatar' => 'avatar-1.png', 'medal' => 'gold.png'],
            ['rank' => 2, 'nama' => 'Sari Dewi', 'sekolah' => 'SD Al-Azhar BSD', 'xp' => 420, 'avatar' => 'avatar-2.png', 'medal' => 'silver.png'],
            ['rank' => 3, 'nama' => 'Ahmad Rizki', 'sekolah' => 'SD Al-Azhar BSD', 'xp' => 398, 'avatar' => 'avatar-3.png', 'medal' => 'bronze.png'],
            ['rank' => 4, 'nama' => 'Maya Sari', 'sekolah' => 'SD Santa Ursula', 'xp' => 385, 'avatar' => 'avatar-4.png', 'medal' => null],
            ['rank' => 5, 'nama' => 'Rizky Pratama', 'sekolah' => 'SD Negeri 08 Bandung', 'xp' => 372, 'avatar' => 'avatar-5.png', 'medal' => null],
            ['rank' => 6, 'nama' => 'Dewi Lestari', 'sekolah' => 'SD Global Mandiri', 'xp' => 365, 'avatar' => 'avatar-6.png', 'medal' => null],
            ['rank' => 7, 'nama' => 'Fajar Nugroho', 'sekolah' => 'SD Labschool Kebayoran', 'xp' => 350, 'avatar' => 'avatar-7.png', 'medal' => null],
            ['rank' => 8, 'nama' => 'Citra Ayu', 'sekolah' => 'SD Al-Azhar BSD', 'xp' => 342, 'avatar' => 'avatar-8.png', 'medal' => null],
            ['rank' => 9, 'nama' => 'Hendra Setiawan', 'sekolah' => 'SD Tarakanita', 'xp' => 335, 'avatar' => 'avatar-9.png', 'medal' => null],
            ['rank' => 10, 'nama' => 'Lina Marlina', 'sekolah' => 'SD Al-Azhar BSD', 'xp' => 328, 'avatar' => 'avatar-10.png', 'medal' => null],
        ];

        // Data untuk tab Kelas Saya (dalam kelas - tanpa sekolah)
        $papanSkorKelas = [
            ['rank' => 1, 'nama' => 'Sari Dewi', 'xp' => 420, 'avatar' => 'avatar-1.png', 'medal' => 'gold.png'],
            ['rank' => 2, 'nama' => 'Ahmad Rizki', 'xp' => 398, 'avatar' => 'avatar-2.png', 'medal' => 'silver.png'],
            ['rank' => 3, 'nama' => 'Citra Ayu', 'xp' => 342, 'avatar' => 'avatar-3.png', 'medal' => 'bronze.png'],
            ['rank' => 4, 'nama' => 'Lina Marline', 'xp' => 328, 'avatar' => 'avatar-4.png', 'medal' => null],
            ['rank' => 5, 'nama' => 'Rizky Pratama', 'xp' => 300, 'avatar' => 'avatar-5.png', 'medal' => null],
            ['rank' => 6, 'nama' => 'Dewi Lestari', 'xp' => 283, 'avatar' => 'avatar-6.png', 'medal' => null],
        ];

        return view('teacher.scoreboard', compact('papanSkorMingguan', 'papanSkorKelas'));
    }
}
