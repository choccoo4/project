<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa\Siswa;
use App\Models\Guru\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google OAuth
     * UNTUK LOGIN: Tidak perlu pilih role, akan auto-detect dari database
     * UNTUK REGISTER: Harus pilih role dulu (dari halaman register)
     */
    public function redirectToGoogle(Request $request)
    {
        // Cek apakah dari halaman register (ada parameter role)
        if ($request->has('role') && in_array($request->role, ['siswa', 'guru'])) {
            // Simpan role untuk register
            session(['register_role' => $request->role]);
        }

        // Jika dari halaman login (tidak ada role), kosongkan session
        if (!$request->has('role')) {
            session()->forget('register_role');
        }

        // Redirect ke Google
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google OAuth
     * AUTO-DETECT: Cek apakah user sudah terdaftar di database
     */
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // ============================================
            // AUTO-DETECT: Cek di database
            // ============================================

            // 1. CEK DI TABEL SISWA (by google_id atau email)
            $siswa = Siswa::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($siswa) {
                // Update google_id jika belum ada
                if (!$siswa->google_id) {
                    $siswa->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }

                // Login sebagai siswa
                Auth::guard('siswa')->login($siswa);
                session()->forget('register_role');

                return redirect()->route('students.onboarding')
                    ->with('success', 'Selamat datang kembali! 🎉');
            }

            // 2. CEK DI TABEL GURU (by google_id atau email)
            $guru = Guru::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($guru) {
                // Update google_id jika belum ada
                if (!$guru->google_id) {
                    $guru->update([
                        'google_id' => $googleUser->getId(),
                        'foto_profil' => $googleUser->getAvatar(),
                    ]);
                }

                // Login sebagai guru
                Auth::guard('guru')->login($guru);
                session()->forget('register_role');

                return redirect()->route('guru.dashboard')
                    ->with('success', 'Selamat datang kembali! 🎉');
            }

            // ============================================
            // JIKA TIDAK DITEMUKAN: REGISTER BARU
            // ============================================

            // Cek apakah ada role dari session (dari halaman register)
            $role = session('register_role');

            if (!$role) {
                // Jika dari halaman login (tidak ada role di session)
                // Redirect ke register dengan pesan
                return redirect()->route('register')
                    ->with('error', 'Email Anda belum terdaftar. Silakan daftar terlebih dahulu dan pilih role (Siswa atau Guru).');
            }

            // Register baru berdasarkan role
            if ($role === 'siswa') {
                return $this->registerSiswaGoogle($googleUser);
            } elseif ($role === 'guru') {
                return $this->registerGuruGoogle($googleUser);
            }

            return redirect()->route('register')
                ->with('error', 'Role tidak valid');
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }

    /**
     * Register Siswa baru dengan Google
     */
    private function registerSiswaGoogle($googleUser)
    {
        // Generate username dari email
        $username = explode('@', $googleUser->getEmail())[0];
        $baseUsername = $username;
        $counter = 1;

        // Pastikan username unik
        while (Siswa::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $siswa = Siswa::create([
            'username' => $username,
            'email' => $googleUser->getEmail(),
            'password' => Hash::make(uniqid()), // Random password
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'nama_pengguna' => $googleUser->getName(),
            'role' => 'siswa',
        ]);

        // Login
        Auth::guard('siswa')->login($siswa);
        session()->forget('register_role');

        return redirect()->route('students.onboarding')
            ->with('success', 'Akun siswa berhasil dibuat dengan Google! 🎉');
    }

    /**
     * Register Guru baru dengan Google
     */
    private function registerGuruGoogle($googleUser)
    {
        $guru = Guru::create([
            'nama' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make(uniqid()), // Random password
            'google_id' => $googleUser->getId(),
            'foto_profil' => $googleUser->getAvatar(),
            'role' => 'guru',
        ]);

        // Login
        Auth::guard('guru')->login($guru);
        session()->forget('register_role');

        return redirect()->route('guru.dashboard')
            ->with('success', 'Akun guru berhasil dibuat dengan Google! 🎉');
    }
}
