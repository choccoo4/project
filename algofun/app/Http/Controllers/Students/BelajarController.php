<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        // Kumpulan level
        $levels = [
            (object)[
                'number' => 1,
                'title' => 'Urutan Langkah',
                'subtitle' => 'Desa Pemula',
                'steps' => [
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/village.png',
                        'right_icon' => 'https://img.icons8.com/color/96/steps.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/light-on.png',
                        'right_icon' => 'https://img.icons8.com/color/96/school.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/scroll.png',
                        'right_icon' => 'https://img.icons8.com/color/96/forest.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/village.png',
                        'right_icon' => 'https://img.icons8.com/color/96/steps.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/light-on.png',
                        'right_icon' => 'https://img.icons8.com/color/96/school.png',
                    ],
                ],
            ],
            (object)[
                'number' => 2,
                'title' => 'Perulangan Dasar',
                'subtitle' => 'Taman Kode',
                'steps' => [
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/robot-2.png',
                        'right_icon' => 'https://img.icons8.com/color/96/loop.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/dice.png',
                        'right_icon' => 'https://img.icons8.com/color/96/goal.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/puzzle.png',
                        'right_icon' => 'https://img.icons8.com/color/96/forest.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/robot-2.png',
                        'right_icon' => 'https://img.icons8.com/color/96/loop.png',
                    ],
                    (object)[
                        'left_icon' => 'https://img.icons8.com/color/96/dice.png',
                        'right_icon' => 'https://img.icons8.com/color/96/goal.png',
                    ],
                ],
            ],
        ];

        return view('students.learn-path', compact('levels'));
    }
}
