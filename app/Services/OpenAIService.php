<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

   public function generateResponse($prompt)
{
    try {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo', // or 'gpt-4' if you have access
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 100, // Reduce max tokens to optimize usage
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['choices'][0]['message']['content'] ?? 'Sorry, I could not generate a response.';
    } catch (\Exception $e) {
        // Retry mechanism for 429 errors
        if ($e->getCode() == 429) {
            sleep(30); // Wait for 30 seconds before retrying
            return $this->generateResponse($prompt);
        }
        return 'Error: ' . $e->getMessage();
    }
}

}
