<?php

namespace Tests\Feature;

use App\Services\OpenAIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PublicPagesAndReliabilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_repaired_public_pages_render(): void
    {
        foreach (['/about', '/resources', '/resources/videos', '/resources/podcasts', '/resources/books', '/booking', '/booking-success', '/hypnotheraphy', '/product-checkout'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_shared_layout_contains_one_document_and_no_payment_sdk_on_about(): void
    {
        $html = $this->get('/about')->assertOk()->getContent();
        $this->assertSame(1, substr_count(strtolower($html), '<!doctype html>'));
        $this->assertSame(1, substr_count(strtolower($html), '<head>'));
        $this->assertSame(1, preg_match_all('/<body[ >]/i', $html));
        $this->assertStringNotContainsString('squarecdn.com', $html);
        $this->assertStringNotContainsString('.css/', $html);
    }

    public function test_chat_failure_is_bounded_and_does_not_expose_provider_errors(): void
    {
        config(['services.openai.key' => 'test']);
        Http::fake(['api.openai.com/*' => Http::response(['message' => 'private provider detail'], 429)]);
        $text = app(OpenAIService::class)->generateResponse('Hello');
        $this->assertSame('Chat is currently unavailable. Please try again later.', $text);
        Http::assertSentCount(1);
    }

    public function test_oversized_chat_input_is_rejected_before_upstream_call(): void
    {
        Http::fake();
        $this->postJson('/chat', ['input' => str_repeat('x', 2001)])->assertUnprocessable();
        Http::assertNothingSent();
    }
}
