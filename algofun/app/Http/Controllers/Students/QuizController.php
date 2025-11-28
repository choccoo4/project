<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private function getQuestions()
    {
        return [
            1 => [
                'type' => 'multiple_choice',
                'text' => 'Apa hasil dari 2 + 2?',
                'options' => ['3', '4', '5'],
                'correct' => '4',
                'explanation' => 'Penjumlahan dasar: 2 + 2 = 4'
            ],
            2 => [
                'type' => 'ordering',
                'text' => 'Urutkan langkah memakai sepatu!',
                'options' => ['Pakai kaos kaki', 'Ikat tali sepatu', 'Masukkan kaki ke sepatu'],
                'correct' => ['Pakai kaos kaki', 'Masukkan kaki ke sepatu', 'Ikat tali sepatu'],
                'explanation' => 'Urutan yang benar: pakai kaos kaki dulu, lalu masukkan kaki, terakhir ikat tali'
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
                'correct' => [[1, 'a'], [2, 'b']],
                'explanation' => 'Pensil untuk menulis, buku untuk membaca'
            ],
            4 => [
                'type' => 'fill_blank',
                'text' => 'Lengkapi kalimat!',
                'sentence' => 'Air itu rasanya <b>____</b>.',
                'correct' => 'tawar',
                'explanation' => 'Air yang bersih rasanya tawar'
            ],
            5 => [
                'type' => 'drag_drop',
                'text' => 'Susun kalimat: "Saya pergi sekolah"',
                'options' => ['Saya', 'sekolah', 'pergi'],
                'correct' => ['Saya', 'pergi', 'sekolah'],
                'explanation' => 'Susunan yang benar: Saya pergi sekolah'
            ]
        ];
    }

    /**
     * Get dummy user answers untuk simulasi
     */
    private function getUserAnswers()
    {
        return [
            1 => '3', // Salah
            2 => ['Pakai kaos kaki', 'Ikat tali sepatu', 'Masukkan kaki ke sepatu'], // Salah
            3 => [[1, 'b'], [2, 'a']], // Salah
            4 => 'manis', // Salah  
            5 => ['Saya', 'sekolah', 'pergi'], // Salah
        ];
    }

    public function show($id)
    {
        $questions = $this->getQuestions();

        $question = $questions[$id] ?? $questions[1];
        $total = count($questions);

        $ids = array_keys($questions);
        $currentIndex = array_search($id, $ids);
        $nextQuestionId = $ids[$currentIndex + 1] ?? null;

        $correctAnswer = $question['correct'];
        $questionOptions = $question['options'] ?? [];

        return view('questions.question', compact('question', 'id', 'total', 'nextQuestionId', 'correctAnswer', 'questionOptions'));
    }

    public function results()
    {
        $questions = $this->getQuestions();
        $userAnswers = $this->getUserAnswers();

        // Hitung score berdasarkan user answers
        $correct = 0;
        $wrong = 0;

        foreach ($questions as $id => $question) {
            if ($this->isAnswerCorrect($question, $userAnswers[$id] ?? null)) {
                $correct++;
            } else {
                $wrong++;
            }
        }

        $total = $correct + $wrong;
        $percent = $total > 0 ? round(($correct / $total) * 100) : 0;
        $xp = $correct * 10;

        return view('questions.quiz-results', compact('correct', 'wrong', 'percent', 'xp'));
    }

    public function restart()
    {
        return redirect()->route('question.show', ['id' => 1]);
    }

    public function lessonReview()
    {
        $questions = $this->getQuestions();
        $userAnswers = $this->getUserAnswers();

        $reviewQuestions = [];

        foreach ($questions as $id => $question) {
            $userAnswer = $userAnswers[$id] ?? null;
            $isCorrect = $this->isAnswerCorrect($question, $userAnswer);

            // Format data untuk review
            $reviewQuestions[$id] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question['correct'],
                'is_correct' => $isCorrect,
                'explanation' => $question['explanation'] ?? 'Tidak ada penjelasan tambahan.',
                'question_number' => $id
            ];
        }

        return view('questions.lesson-review', compact('reviewQuestions'));
    }

    /**
     * Helper function untuk cek jawaban benar/salah
     */
    private function isAnswerCorrect($question, $userAnswer)
    {
        if (!$question || $userAnswer === null) {
            return false;
        }

        $correctAnswer = $question['correct'];

        switch ($question['type']) {
            case 'multiple_choice':
            case 'fill_blank':
                return $userAnswer === $correctAnswer;

            case 'ordering':
                return json_encode($userAnswer) === json_encode($correctAnswer);

            case 'matching':
                // Sort both arrays untuk comparison
                $userSorted = $userAnswer;
                $correctSorted = $correctAnswer;
                sort($userSorted);
                sort($correctSorted);
                return json_encode($userSorted) === json_encode($correctSorted);

            case 'drag_drop':
                return json_encode($userAnswer) === json_encode($correctAnswer);

            default:
                return false;
        }
    }
}
