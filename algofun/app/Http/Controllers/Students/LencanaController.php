<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LencanaController extends Controller
{
    public function index()
    {
        // Dummy data — nanti bisa di ganti dari DB
        $badges = [
            [
                'nama' => 'Penakluk Level',
                'deskripsi' => 'Menyelesaikan 3 Level',
                'ikon' => 'assets/badges/penakluklevel.png',
                'progress' => 1,
                'target' => 3,
                'warna' => 'bg-green-100',
            ],
            [
                'nama' => 'Pemula Hebat',
                'deskripsi' => 'Menyelesaikan Level 1 pertama kali',
                'ikon' => 'assets/badges/pemulahebat.png',
                'progress' => 1,
                'target' => 1,
                'warna' => 'bg-blue-100',
            ],
            [
                'nama' => 'Tanpa Celah',
                'deskripsi' => 'Selesaikan 1 Step tanpa salah',
                'ikon' => 'assets/badges/tanpacelah.png',
                'progress' => 1,
                'target' => 1,
                'warna' => 'bg-yellow-100',
            ],
            [
                'nama' => 'Membara',
                'deskripsi' => 'Login & latihan 7 hari berturut-turut',
                'ikon' => 'assets/badges/membara.png',
                'progress' => 2,
                'target' => 7,
                'warna' => 'bg-orange-100',
            ],
            [
                'nama' => 'Sicepat',
                'deskripsi' => '1 step akurasi ≥90% & waktu <50%',
                'ikon' => 'assets/badges/sicepat.png',
                'progress' => 0,
                'target' => 1,
                'warna' => 'bg-red-100',
            ],
            [
                'nama' => 'Rajin Latihan',
                'deskripsi' => 'Kerjakan latihan 5x',
                'ikon' => 'assets/badges/rajinlatihan.png',
                'progress' => 2,
                'target' => 5,
                'warna' => 'bg-blue-50',
            ],
            [
                'nama' => 'Raja XP',
                'deskripsi' => 'Kumpulkan total 150 XP mingguan',
                'ikon' => 'assets/badges/rajaxp.png',
                'progress' => 30,
                'target' => 100,
                'warna' => 'bg-green-50',
            ],
            [
                'nama' => 'Penasaran AI',
                'deskripsi' => 'Mengerjakan Latihan Rekomendasi AI > 3 kali',
                'ikon' => 'assets/badges/penasaranai.png',
                'progress' => 4,
                'target' => 7,
                'warna' => 'bg-yellow-100',
            ],
        ];

        return view('students.lencana', compact('badges'));
    }
}
