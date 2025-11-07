<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    public function index()
    {
        // dummy data sementara
        $dataDiri = [
            'avatar' => '/images/avatar-boy.png',
            'nama_lengkap' => 'Chocolatte',
            'nama_pengguna' => 'chocoverse',
            'email' => 'chocolate@gmail.com',
            'asal_sekolah' => 'SDIT Nabilah',
            'nisn' => '21-1022',
            'kelas' => 'Matematika 3D',
            'guru' => 'Septia Riski Maturiy',
            'runtunan_hari' => 2,
            'total_xp' => 734,
        ];

        return view('students.data-diri', compact('dataDiri'));
    }
}
