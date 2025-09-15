<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $baseUrl;
    protected $apiKey;
    protected $model;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.gemini.base_url'), '/'); // pastikan gak dobel slash
        $this->apiKey  = config('services.gemini.api_key');
        $this->model   = config('services.gemini.model');
    }

    public function generateContent(string $prompt)
    {
        $url = "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            dd($url, $response->status(), $response->body()); // kasih lihat URL juga
        }

        return $response->json();
    }
}
