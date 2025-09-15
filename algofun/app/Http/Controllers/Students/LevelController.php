<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = [
            [
                'title' => 'Level 1 - Desa Pemula',
                'completed' => false, // true kalau semua step selesai
                'steps' => [
                    ['completed' => true],
                    ['completed' => true],
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                ]
            ],
            [
                'title' => 'Level 2 - Hutan Simbolik',
                'completed' => false,
                'steps' => [
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                ]
            ],
            [
                'title' => 'Level 3 - Gunung Perbandingan',
                'completed' => false,
                'steps' => [
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                    ['completed' => false],
                ]
            ],
        ];

        return view('students.roadmap', compact('levels'));
    }
}
