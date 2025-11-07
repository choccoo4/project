<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // halaman daftar kelas (view front-end)
    public function kelas()
    {
        return view('teacher.kelas');
    }

    // detail kelas -> menampilkan daftar siswa (dummy)
    public function show($id)
    {
        // contoh data dummy untuk daftar siswa
        $siswa = [
            (object)['id' => 11, 'nama' => 'ChoccoLatter', 'level' => 3, 'xp' => 50, 'waktu' => 30, 'progress' => 4, 'total_step' => 5],
            (object)['id' => 12, 'nama' => 'VanillaStar',  'level' => 3, 'xp' => 45, 'waktu' => 25, 'progress' => 3, 'total_step' => 5],
        ];

        // kalau mau, bisa juga pass $id kelas ke view: compact('siswa', 'id')
        return view('teacher.kelas-detail', compact('siswa', 'id'));
    }

    // laporan siswa per individu (frontend dummy)
    // pastikan parameter nama konsisten: $id (kelas) dan $studentId (siswa)
    public function studentReport($id, $studentId)
    {
        // (opsional) stub info kelas jika perlu
        $kelas = (object)[
            'id' => $id,
            'nama' => 'Matematika 3D',
        ];

        // Dummy data siswa / nilai / AI insight
        $siswa = (object) [
            'id' => $studentId,
            'nama' => 'ChoccoLatter',
            'level' => 3,
            'nilai' => [
                ['level' => 1, 'steps' => [90, 100, 92, 88, 90]],
                ['level' => 2, 'steps' => [80, 82, 78, 85, 87]],
                ['level' => 3, 'steps' => [95, 94, 92, 97, 99]],
            ],
            'kelemahan' => [
                'materi' => 'Soal cerita tentang Waktu dan Durasi',
                'tipe' => 'Word Problem'
            ]
        ];

        return view('teacher.student-report', compact('kelas', 'siswa'));
    }

    public function settings($id)
    {
        // dummy data kelas
        $kelas = (object) [
            'id' => $id,
            'kode' => 'XUDMZC',
            'nama' => 'Matematika 3D'
        ];

        return view('teacher.setting-class', compact('kelas'));
    }
}
