<?php

namespace App\Services;

use OpenAI\Factory;

class OpenAIService
{
    protected $openai;

    public function __construct()
    {
        // Correct way to instantiate OpenAI
        $this->openai = (new Factory())
            ->withApiKey(env('OPENAI_API_KEY'))
            ->make();
    }

    public function generateResponse($message)
    {
        $response = $this->openai->chat()->create([
            'model' => 'gpt-4', // or 'gpt-3.5-turbo'
            'messages' => [
                ['role' => 'system', 'content' => 'You are an AI assistant.'],
                ['role' => 'user', 'content' => $message]
            ]
        ]);

        return $response['choices'][0]['message']['content'] ?? 'No response';
    }
}
