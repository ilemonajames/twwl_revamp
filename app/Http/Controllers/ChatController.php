<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'input' => 'required|string',
        ]);

        $userInput = $request->input('input');

        $response = $this->openAIService->generateResponse($userInput);
        
        return response()->json(['response' => $response]);
    }
}
