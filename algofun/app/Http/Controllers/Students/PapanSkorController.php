<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PapanSkorController extends Controller
{
    public function index()
    {
        $papanSkor = [
            ['rank' => 1, 'nama' => 'Chocco', 'xp' => 320, 'avatar' => 'avatar1.png', 'medal' => 'gold.png'],
            ['rank' => 2, 'nama' => 'Latte', 'xp' => 290, 'avatar' => 'avatar2.png', 'medal' => 'silver.png'],
            ['rank' => 3, 'nama' => 'Mocca', 'xp' => 275, 'avatar' => 'avatar3.png', 'medal' => 'bronze.png'],
            ['rank' => 4, 'nama' => 'Cowi', 'xp' => 265, 'avatar' => 'avatar4.png', 'medal' => null],
            ['rank' => 5, 'nama' => 'Molly', 'xp' => 265, 'avatar' => 'avatar5.png', 'medal' => null],
            ['rank' => 6, 'nama' => 'Oreo', 'xp' => 250, 'avatar' => 'avatar6.png', 'medal' => null],
        ];

        return view('students.papan-skor', compact('papanSkor'));
    }
}
