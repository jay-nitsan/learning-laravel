<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class OpenAIController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function askAI(Request $request)
    {
        $question = $request->input('question');
        $answer = $this->openAIService->generateResponse($question);

        return view('ai-response', compact('answer', 'question'));
    }
}
