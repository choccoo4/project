<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $questions = [
        [
            'type' => 'multiple_choice',
            'question' => 'Manakah yang merupakan bilangan genap?',
            'options' => ['3', '7', '8', '9'],
            'answer' => '8',
        ],
        [
            'type' => 'ordering',
            'question' => 'Apa urutan langkah yang tepat?',
            'options' => ['Sarapan', 'Mandi', 'Sekolah'],
            'answer' => ['Mandi', 'Sarapan', 'Sekolah'],
        ],
        // ... tambah sampai 10
    ];

    public function start(Request $request)
    {
        $request->session()->put('xp', 0);
        $request->session()->put('solved', []);     // [index => true] untuk yang sudah BENAR
        $request->session()->put('attempts', []);   // [index => jumlah_kesalahan]
        return redirect()->route('quiz.show', ['index' => 0]);
    }

    public function show(Request $request, $index)
    {
        $total = count($this->questions);
        $i = (int) $index;
        if ($i >= $total) {
            return redirect()->route('quiz.finish');
        }

        $soal = $this->questions[$i];
        $xp   = (int) $request->session()->get('xp', 0);
        $solved = $request->session()->get('solved', []);
        $solvedCount = count($solved);

        return view('students.question', [
            'soal'        => $soal,
            'index'       => $i,
            'total'       => $total,
            'xp'          => $xp,
            'solvedCount' => $solvedCount,
        ]);
    }

    // dipanggil saat user tekan "Lanjutkan"
    // query: ?result=correct|incorrect|skip
    public function next(Request $request, $index)
    {
        $result   = $request->query('result', 'incorrect');
        $i        = (int) $index;
        $total    = count($this->questions);

        $xp       = (int) $request->session()->get('xp', 0);
        $solved   = $request->session()->get('solved', []);
        $attempts = $request->session()->get('attempts', []);

        if ($result === 'correct') {
            // kasih XP sekali saja saat pertama kali benar
            if (!isset($solved[$i])) {
                $mistakes = $attempts[$i] ?? 0;
                $award = ($mistakes === 0) ? 5 : (($mistakes === 1) ? 4 : 2);
                $xp += $award;
                $solved[$i] = true;
            }
        } elseif ($result === 'incorrect') {
            // tambah jumlah kesalahan untuk index ini
            $attempts[$i] = ($attempts[$i] ?? 0) + 1;
        } elseif ($result === 'skip') {
            // tidak menambah attempts, tidak menambah solved
        }

        // simpan kembali
        $request->session()->put('xp', $xp);
        $request->session()->put('solved', $solved);
        $request->session()->put('attempts', $attempts);

        // tentukan next index
        if ($i < $total - 1) {
            // masih ada soal di sesi utama
            return redirect()->route('quiz.show', ['index' => $i + 1]);
        }

        // sudah di soal terakhir → cek apakah masih ada yang salah
        if (count($solved) < $total) {
            // cari index pertama yang belum solved
            for ($k = 0; $k < $total; $k++) {
                if (!isset($solved[$k])) {
                    return redirect()->route('quiz.show', ['index' => $k]);
                }
            }
        }

        // semua sudah solved → selesai
        return redirect()->route('quiz.finish');
    }

    public function finish(Request $request)
    {
        $xp     = (int) $request->session()->get('xp', 0);
        $solved = $request->session()->get('solved', []);
        $total  = count($this->questions);

        $scorePercent = $total > 0 ? round((count($solved) / $total) * 100) : 0;

        return view('students.quiz-finish', [
            'xp' => $xp,
            'scorePercent' => $scorePercent,
            'total' => $total,
            'benar' => count($solved),
            'salah' => $total - count($solved),
        ]);
    }
}
