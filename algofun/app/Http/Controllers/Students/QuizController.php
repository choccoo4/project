<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show($id)
    {
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
    }

    public function results()
    {
        return view('questions.quiz-results');
    }
}
