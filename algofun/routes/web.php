<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\students\LevelController;
use App\Http\Controllers\Students\BelajarController;
use App\Http\Controllers\Students\LatihanController;
use App\Http\Controllers\Students\MisiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Students\QuizController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\ScoreboardController;
use App\Http\Controllers\Teacher\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('students.dashboard');
});

Route::get('/latihan', function () {
    return view('students.latihan');
});

Route::get('/misi', function () {
    return view('students.misi');
});

Route::get('/belajar', [BelajarController::class, 'index']);

Route::get('/quiz', [QuizController::class, 'start'])->name('quiz.start');
Route::get('/quiz/{index}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{index}/next', [QuizController::class, 'next'])->name('quiz.next'); // NEW

Route::get('/quiz-results', function () {
    return view('questions.quiz-results');
});

Route::get('/soal/{id}', function ($id) {
    $questions = [
        1 => [
            'type' => 'multiple_choice',
            'text' => 'Apa hasil dari 2 + 2?',
            'options' => ['3', '4', '5'],
            'correct' => '4'
        ],
        2 => [
            'type' => 'ordering',
            'text' => 'Urutkan langkah memakai sepatu!',
            'options' => ['Pakai kaos kaki', 'Ikat tali sepatu', 'Masukkan kaki ke sepatu'],
            'correct' => ['Pakai kaos kaki', 'Masukkan kaki ke sepatu', 'Ikat tali sepatu']
        ],
        3 => [
            'type' => 'matching',
            'text' => 'Cocokkan benda dengan fungsinya',
            'left' => [
                ['id' => 1, 'text' => 'Pensil'],
                ['id' => 2, 'text' => 'Buku']
            ],
            'right' => [
                ['id' => 'a', 'text' => 'Menulis'],
                ['id' => 'b', 'text' => 'Membaca']
            ],
            'correct' => [[1, 'a'], [2, 'b']]
        ],
        4 => [
            'type' => 'fill_blank',
            'text' => 'Lengkapi kalimat!',
            'sentence' => 'Air itu rasanya <b>____</b>.',
            'correct' => 'tawar'
        ],
        5 => [
            'type' => 'drag_drop',
            'text' => 'Seret kata untuk membentuk kalimat: "Saya pergi sekolah"',
            'options' => ['Saya', 'sekolah', 'pergi'],
            'correct' => ['Saya', 'pergi', 'sekolah']
        ],
    ];

    $question = $questions[$id] ?? $questions[1];
    $total = count($questions);

    return view('questions.question', compact('question', 'id', 'total'));
});

Route::get('/test-gemini', [AIController::class, 'ask']);
Route::get('/generate-soal-ai', [AIController::class, 'generateQuestion']);

Route::get('/debug-gemini', function () {
    dd(config('services.gemini.key'), config('services.gemini.model'));
});
Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/guru/dashboard', [DashboardController::class, 'dashboard'])->name('guru.dashboard');
Route::get('/guru/kelas', [ClassController::class, 'kelas'])->name('guru.kelas');
Route::get('/guru/papanskor', [ScoreboardController::class, 'index'])->name('guru.papanskor');
Route::get('/guru/datadiri', [ProfileController::class, 'profil'])->name('guru.profil');
Route::get('/guru/kelas', [ClassController::class, 'kelas'])->name('guru.kelas');
Route::get('/guru/kelas/{id}', [ClassController::class, 'show'])->name('guru.kelas.show');
Route::get('/guru/kelas/{id}/report/{student_id}', [ClassController::class, 'studentReport'])->name('guru.kelas.report');
Route::get('/guru/kelas/{id}/pengaturan', [ClassController::class, 'settings'])->name('guru.kelas.settings');
