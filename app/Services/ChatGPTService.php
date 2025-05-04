<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $apiUrl = 'https://api.openai.com/v1/chat/completions';

    public function generateResponse(string $message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'gpt-4', // or 'gpt-3.5-turbo' for a cheaper option
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $message],
            ],
            'max_tokens' => 500,
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'Sorry, something went wrong!';
    }
}
