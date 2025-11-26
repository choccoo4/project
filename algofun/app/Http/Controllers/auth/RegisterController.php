<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function index()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }
        
        if (Auth::guard('guru')->check()) {
            return redirect()->route('guru.dashboard');
        }
        
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi input dasar
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:siswa,guru',
            'email' => 'required|email|max:255',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
            ],
        ], [
            'role.required' => 'Silakan pilih role terlebih dahulu',
            'role.in' => 'Role tidak valid. Hanya siswa atau guru yang diperbolehkan.',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $role = $request->role;

        try {
            // Register berdasarkan role
            if ($role === 'siswa') {
                return $this->registerSiswa($request);
            } elseif ($role === 'guru') {
                return $this->registerGuru($request);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage())
                ->withInput($request->except('password', 'password_confirmation'));
        }

        return redirect()->back()
            ->with('error', 'Role tidak valid')
            ->withInput($request->except('password', 'password_confirmation'));
    }

    /**
     * Registrasi Siswa
     */
    private function registerSiswa(Request $request)
    {
        // Validasi khusus siswa
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:siswa,username|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'unique:siswa,email',
        ], [
            'username.required' => 'Nama pengguna wajib diisi',
            'username.unique' => 'Nama pengguna sudah digunakan, silakan pilih yang lain',
            'username.regex' => 'Nama pengguna hanya boleh mengandung huruf, angka, dan underscore',
            'username.max' => 'Nama pengguna maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar sebagai siswa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Buat akun siswa
        $siswa = Siswa::create([
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            // Field lainnya akan null (nullable) dan diisi nanti di profil
            // level_terakhir, hari_berturut_aktif, total_xp sudah ada default value
        ]);

        // Login otomatis setelah register
        Auth::guard('siswa')->login($siswa);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Selamat datang di AlgoFun! Akun siswa berhasil dibuat. 🎉');
    }

    /**
     * Registrasi Guru
     */
    private function registerGuru(Request $request)
    {
        // Validasi khusus guru
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'unique:guru,email',
        ], [
            'username.required' => 'Nama wajib diisi',
            'username.max' => 'Nama maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar sebagai guru',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Buat akun guru
        $guru = Guru::create([
            'nama' => $request->username, // Gunakan username sebagai nama
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'guru',
            // Field lainnya akan null (nullable) dan diisi nanti di profil
        ]);

        // Login otomatis setelah register
        Auth::guard('guru')->login($guru);

        return redirect()->route('guru.dashboard')
            ->with('success', 'Selamat datang di AlgoFun! Akun guru berhasil dibuat. 🎉');
    }
}