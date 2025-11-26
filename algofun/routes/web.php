<?php

use Illuminate\Support\Facades\Route;

//  Import Controller Students
use App\Http\Controllers\Students\LevelController;
use App\Http\Controllers\Students\BelajarController;
use App\Http\Controllers\Students\LatihanController;
use App\Http\Controllers\Students\MisiController;
use App\Http\Controllers\Students\LencanaController;
use App\Http\Controllers\Students\LaporanSiswaController;
use App\Http\Controllers\Students\DataDiriController;
use App\Http\Controllers\Students\PapanSkorController;
use App\Http\Controllers\Students\QuizController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;

// AI Controller
use App\Http\Controllers\AIController;

//  Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\ScoreboardController;
use App\Http\Controllers\Teacher\ProfileController;

//  Admin Controller
use App\Http\Controllers\Admin\AdminDashboardController;

// =========================
// ROUTES
// =========================

// Default route
Route::get('/', function () {
    return view('welcome');
});

// =========================
// STUDENTS
// =========================
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// LOGIN
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');


// LUPA PASSWORD
Route::get('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');

// RESET PASSWORD
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');


Route::get('/dashboard', function () {
    return view('students.dashboard');
});

Route::get('/latihan', function () {
    return view('students.latihan');
});

Route::get('/misi', function () {
    return view('students.misi');
});

Route::get('/onboarding', function () {
    return view('students.onboarding');
});

Route::get('/aturan', function () {
    return view('students.rule');
});

Route::get('/belajar', [BelajarController::class, 'index'])->name('students.belajar');
Route::get('/lencana', [LencanaController::class, 'index'])->name('lencana.index');
Route::get('/laporan-belajar', [LaporanSiswaController::class, 'index'])->name('laporan.belajar');
Route::get('/data-diri', [DataDiriController::class, 'index'])->name('students.data-diri');
Route::get('/papan-skor', [PapanSkorController::class, 'index'])->name('students.papan-skor');

// =========================
// QUIZ
// =========================
Route::get('/soal/{id}', [QuizController::class, 'show'])->name('question.show');
Route::get('/quiz-results', [QuizController::class, 'results'])->name('quiz.results');
Route::get('/quiz/restart', [QuizController::class, 'restart'])->name('quiz.restart');
Route::get('/ulas-pelajaran', [QuizController::class, 'lessonReview'])->name('lesson.review');

// =========================
// AI
// =========================
Route::get('/test-gemini', [AIController::class, 'ask']);
Route::get('/generate-soal-ai', [AIController::class, 'generateQuestion']);
Route::get('/debug-gemini', function () {
    dd(config('services.gemini.key'), config('services.gemini.model'));
});

// =========================
// ADMIN
// =========================
Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

// =========================
// TEACHER
// =========================
Route::get('/guru/dashboard', [DashboardController::class, 'dashboard'])->name('guru.dashboard');
Route::get('/guru/kelas', [ClassController::class, 'kelas'])->name('guru.kelas');
Route::get('/guru/papanskor', [ScoreboardController::class, 'index'])->name('guru.papanskor');
Route::get('/guru/datadiri', [ProfileController::class, 'profil'])->name('guru.profile');
Route::get('/guru/kelas/{id}', [ClassController::class, 'show'])->name('guru.kelas.show');
Route::get('/guru/kelas/{id}/report/{student_id}', [ClassController::class, 'studentReport'])->name('guru.kelas.report');
Route::get('/guru/kelas/{id}/pengaturan', [ClassController::class, 'settings'])->name('guru.kelas.settings');

Route::get('/', function () {
    return view('public.landing');
});
