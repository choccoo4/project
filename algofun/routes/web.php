<?php

use Illuminate\Support\Facades\Route;

// =========================
// AUTH CONTROLLERS (Multi-Auth System)
// =========================
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\GoogleController;

// =========================
// STUDENTS CONTROLLERS
// =========================
use App\Http\Controllers\Students\LevelController;
use App\Http\Controllers\Students\BelajarController;
use App\Http\Controllers\Students\LatihanController;
use App\Http\Controllers\Students\MisiController;
use App\Http\Controllers\Students\LencanaController;
use App\Http\Controllers\Students\LaporanSiswaController;
use App\Http\Controllers\Students\DataDiriController;
use App\Http\Controllers\Students\PapanSkorController;
use App\Http\Controllers\Students\QuizController;

// =========================
// TEACHER CONTROLLERS
// =========================
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\ScoreboardController;
use App\Http\Controllers\Teacher\ProfileController;

// =========================
// ADMIN CONTROLLERS
// =========================
use App\Http\Controllers\Admin\AdminDashboardController;

// =========================
// AI CONTROLLER
// =========================
use App\Http\Controllers\AIController;

/*
|--------------------------------------------------------------------------
| Web Routes - AlgoFun Multi-Auth System
|--------------------------------------------------------------------------
*/

// =========================
// LANDING PAGE / HOME client id : 981283100942-7d52aqud7qm0pjlq8sg2jo6ubmdqrb8b.apps.googleusercontent.com client secretGOCSPX-qN9qHuuLmm4V-XerKAehkPXgNGi4
// =========================
Route::get('/', function () {
    // Jika sudah login, redirect ke dashboard sesuai role
    if (auth()->guard('siswa')->check()) {
        return redirect()->route('students.onboarding');
    }
    if (auth()->guard('guru')->check()) {
        return redirect()->route('teacher.dashboard');
    }
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    
    return view('students.onboarding');
})->name('home');

// =========================
// GUEST ROUTES (Belum Login)
// =========================
Route::middleware('guest')->group(function () {
    
    // REGISTER
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    
    // LOGIN
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    // GOOGLE OAUTH
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
    
    // LUPA PASSWORD
    Route::get('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');
    
    // RESET PASSWORD
    Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');
});

<<<<<<< HEAD
Route::get('/aturan', function () {
    return view('students.rule');
=======
// =========================
// LOGOUT ROUTE (Untuk semua role)
// =========================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =========================
// STUDENTS ROUTES (Auth: Siswa)
// =========================
Route::middleware(['auth:siswa'])->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('students.dashboard');
    })->name('siswa.dashboard');
    
    // ONBOARDING & RULES
    Route::get('/onboarding', function () {
        return view('students.onboarding');
    })->name('students.onboarding');
    
    Route::get('/peraturan', function () {
        return view('students.rule');
    })->name('students.peraturan');
    
    // BELAJAR
    Route::get('/belajar', [BelajarController::class, 'index'])->name('students.belajar');
    
    // LATIHAN
    Route::get('/latihan', function () {
        return view('students.latihan');
    })->name('students.latihan');
    
    // MISI
    Route::get('/misi', function () {
        return view('students.misi');
    })->name('students.misi');
    
    // LENCANA
    Route::get('/lencana', [LencanaController::class, 'index'])->name('lencana.index');
    
    // LAPORAN BELAJAR
    Route::get('/laporan-belajar', [LaporanSiswaController::class, 'index'])->name('laporan.belajar');
    
    // DATA DIRI (Profile Siswa)
    Route::get('/data-diri', [DataDiriController::class, 'index'])->name('students.data-diri');
    
    // PAPAN SKOR
    Route::get('/papan-skor', [PapanSkorController::class, 'index'])->name('students.papan-skor');
    
    // QUIZ ROUTES
    Route::get('/soal/{id}', [QuizController::class, 'show'])->name('question.show');
    Route::get('/quiz-results', [QuizController::class, 'results'])->name('quiz.results');
>>>>>>> 4a96cdb85012d010c8a2f4a1f44c74ea0ec7e8c0
});

// =========================
// TEACHER ROUTES (Auth: Guru)
// =========================
Route::middleware(['auth:guru'])->prefix('guru')->name('guru.')->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    // KELAS
    Route::get('/kelas', [ClassController::class, 'kelas'])->name('kelas');
    Route::get('/kelas/{id}', [ClassController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/{id}/report/{student_id}', [ClassController::class, 'studentReport'])->name('kelas.report');
    Route::get('/kelas/{id}/pengaturan', [ClassController::class, 'settings'])->name('kelas.settings');
    
    // PAPAN SKOR
    Route::get('/papanskor', [ScoreboardController::class, 'index'])->name('papanskor');
    
    // PROFILE (Data Diri Guru)
    Route::get('/datadiri', [ProfileController::class, 'profil'])->name('profile');
});

// =========================
// ADMIN ROUTES (Auth: Admin)
// =========================
<<<<<<< HEAD
Route::get('/soal/{id}', [QuizController::class, 'show'])->name('question.show');
Route::get('/quiz-results', [QuizController::class, 'results'])->name('quiz.results');
Route::get('/quiz/restart', [QuizController::class, 'restart'])->name('quiz.restart');
Route::get('/ulas-pelajaran', [QuizController::class, 'lessonReview'])->name('lesson.review');
=======
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Tambahkan route admin lainnya di sini
});
>>>>>>> 4a96cdb85012d010c8a2f4a1f44c74ea0ec7e8c0

// =========================
// AI ROUTES (Public - untuk testing)
// =========================
Route::get('/test-gemini', [AIController::class, 'ask']);
Route::get('/generate-soal-ai', [AIController::class, 'generateQuestion']);
Route::get('/debug-gemini', function () {
    dd(config('services.gemini.key'), config('services.gemini.model'));
});