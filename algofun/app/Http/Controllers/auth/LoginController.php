<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('students.onboarding');
        }

        if (Auth::guard('guru')->check()) {
            return redirect()->route('guru.dashboard');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login - AUTO DETECT ROLE dari database
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $email = strtolower($request->email);
        $password = $request->password;
        $remember = $request->has('remember');

        // ============================================
        // AUTO-DETECT: Cek di 3 tabel (siswa, guru, admin)
        // ============================================

        // 1. CEK DI TABEL SISWA
        $siswa = Siswa::where('email', $email)->first();
        if ($siswa) {
            // Cek password
            if (Hash::check($password, $siswa->password)) {
                // Login sebagai siswa
                Auth::guard('siswa')->login($siswa, $remember);
                $request->session()->regenerate();

                return redirect()->route('students.onboarding')
                    ->with('success', 'Selamat datang kembali, ' . $siswa->username . '! 🎉');
            } else {
                // Email ketemu tapi password salah
                return redirect()->back()
                    ->withErrors(['login' => 'Password yang Anda masukkan salah'])
                    ->withInput($request->only('email'));
            }
        }

        // 2. CEK DI TABEL GURU
        $guru = Guru::where('email', $email)->first();
        if ($guru) {
            // Cek password
            if (Hash::check($password, $guru->password)) {
                // Login sebagai guru
                Auth::guard('guru')->login($guru, $remember);
                $request->session()->regenerate();

                return redirect()->route('guru.dashboard')
                    ->with('success', 'Selamat datang kembali, ' . $guru->nama . '! 🎉');
            } else {
                // Email ketemu tapi password salah
                return redirect()->back()
                    ->withErrors(['login' => 'Password yang Anda masukkan salah'])
                    ->withInput($request->only('email'));
            }
        }

        // 3. CEK DI TABEL ADMIN
        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            // Cek password
            if (Hash::check($password, $admin->password)) {
                // Login sebagai admin
                Auth::guard('admin')->login($admin, $remember);
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang kembali, Admin! 🎉');
            } else {
                // Email ketemu tapi password salah
                return redirect()->back()
                    ->withErrors(['login' => 'Password yang Anda masukkan salah'])
                    ->withInput($request->only('email'));
            }
        }

        // ============================================
        // JIKA EMAIL TIDAK DITEMUKAN DI SEMUA TABEL
        // ============================================
        return redirect()->back()
            ->withErrors(['login' => 'Email belum terdaftar. Silakan daftar terlebih dahulu.'])
            ->withInput($request->only('email'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // Cek guard mana yang aktif dan logout
        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        } elseif (Auth::guard('guru')->check()) {
            Auth::guard('guru')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout. Sampai jumpa! 👋');
    }
}
