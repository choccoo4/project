<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimateController extends Controller
{
    public function index()
    {
        // Mengarahkan ke view resources/views/misi.blade.php
        return view('misi');
    }
}
