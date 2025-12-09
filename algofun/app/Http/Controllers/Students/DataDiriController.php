<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;   // <= penting!
use App\Models\Siswa\Siswa;

class DataDiriController extends Controller
{
    public function index()
    {
        // Ambil siswa login
        $siswa = Auth::guard('siswa')->user();

        // Ambil semua sekolah
        $daftarSekolah = Sekolah::orderBy('nama', 'asc')->get();

        return view('students.data-diri', compact('siswa', 'daftarSekolah'));
    }

    public function update(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();

        // VALIDASI
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nama_pengguna' => 'required|string|max:100',
            'email' => 'required|email',
            'nisn' => 'nullable|numeric|digits_between:9,12',
            'nama_sekolah' => 'nullable|string',
            'nama_sekolah_lainnya' => 'nullable|string',
        ]);

        // Jika pilih “lainnya”
        $namaSekolah = $request->nama_sekolah == 'lainnya'
            ? $request->nama_sekolah_lainnya
            : $request->nama_sekolah;

        // UPDATE DATA
        $siswa->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'nama_sekolah' => $namaSekolah,
        ]);

        return back()->with('success', 'Data berhasil diperbarui!');
    }
}
