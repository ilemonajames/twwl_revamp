<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    public function generateResponse($prompt)
    {
        if (! config('services.openai.key')) {
            return 'Chat is currently unavailable. Please try again later.';
        }
        try {
            $response = Http::withToken(config('services.openai.key'))
                ->connectTimeout(5)->timeout(20)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => config('services.openai.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 100,
                ]);
            if ($response->successful()) {
                return $response->json('choices.0.message.content') ?? 'Chat is currently unavailable. Please try again later.';
            }
            Log::warning('Chat provider request failed', ['status' => $response->status()]);
        } catch (\Throwable $e) {
            Log::warning('Chat provider unavailable', ['exception' => get_class($e)]);
        }

        return 'Chat is currently unavailable. Please try again later.';
    }
}
