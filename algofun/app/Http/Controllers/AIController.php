<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;

class AIController extends Controller
{
    protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    public function ask()
    {
        $prompt = "Explain how AI works in a few words";
        $result = $this->gemini->generateContent($prompt);

        // ambil teks jawaban pertama
        $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

        return response()->json([
            'answer' => $text,
        ]);
    }

    public function generateQuestion()
    {
        // kasih instruksi ke Gemini untuk hasilkan soal sesuai format
        $prompt = <<<EOT
Buat 1 soal logika untuk anak SD dalam format JSON seperti berikut:

{
    "type": "multiple_choice",
    "text": "Pertanyaan di sini",
    "options": ["opsi1", "opsi2", "opsi3"],
    "correct": "opsi yang benar"
}

Hanya kembalikan JSON valid tanpa penjelasan tambahan.
EOT;

        $result = $this->gemini->generateContent($prompt);

        // ambil text dari jawaban
        $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
        $text = trim($text); // hapus spasi di awal/akhir
        $text = preg_replace('/^```json\s*|\s*```$/', '', $text);
        // coba parse jadi array PHP
        $question = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'error' => 'Invalid JSON from Gemini',
                'raw'   => $text,
            ]);
        }

        return response()->json([
            'question' => $question
        ]);
    }
}
