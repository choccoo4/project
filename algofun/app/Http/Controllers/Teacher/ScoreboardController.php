<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    public function index()
    {
        return view('teacher.scoreboard');
    }
}
