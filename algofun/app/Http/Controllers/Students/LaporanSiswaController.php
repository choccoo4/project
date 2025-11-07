<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanSiswaController extends Controller
{
    public function index()
    {
        // DUMMY DATA — nanti bisa diganti ambil dari database
        $levels = [
            ['nama' => 'Level 1', 'steps' => [
                ['step' => 'Step 1', 'nilai' => 90],
                ['step' => 'Step 2', 'nilai' => 100],
                ['step' => 'Step 3', 'nilai' => 92],
                ['step' => 'Step 4', 'nilai' => 95],
                ['step' => 'Step 5', 'nilai' => 90],
            ]],
            ['nama' => 'Level 2', 'steps' => [
                ['step' => 'Step 1', 'nilai' => 88],
                ['step' => 'Step 2', 'nilai' => 96],
                ['step' => 'Step 3', 'nilai' => 91],
            ]],
        ];

        $chartData = [
            'labels' => ['5', '6', '7', '8', '9', '10'],
            'values' => [8, 14, 5, 9, 11, 4, 16],
        ];

        $aiInsight = [
            'hebat' => 'Operasi Penjumlahan dan Pengurangan',
            'lemah' => 'Soal cerita tentang “Waktu dan Durasi”',
            'tipe' => 'Word Problem'
        ];

        return view('students.laporan', compact('levels', 'chartData', 'aiInsight'));
    }
}
