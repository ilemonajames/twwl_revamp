<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactDeliveryTest extends TestCase
{
    private function data(): array
    {
        return ['name' => 'Test Client', 'email' => 'client@example.com', 'message' => 'Please contact me.', 'g-recaptcha-response' => 'test-token'];
    }

    public function test_contact_mail_goes_to_requested_address_with_reply_to_and_renders_body(): void
    {
        Mail::fake();
        config(['services.recaptcha.secret_key' => 'configured-secret']);
        Http::fake(['www.google.com/*' => Http::response(['success' => true])]);
        $this->post(route('sendMessage'), $this->data())->assertSessionHas('feedback');
        Mail::assertSent(ContactMail::class, function ($mail) {
            return $mail->hasTo('thewaywelove24@gmail.com')
                && $mail->envelope()->replyTo[0]->address === 'client@example.com'
                && str_contains($mail->render(), 'Please contact me.');
        });
        Http::assertSent(fn ($request) => $request['secret'] === 'configured-secret');
    }

    public function test_invalid_captcha_does_not_send_mail(): void
    {
        Mail::fake();
        Http::fake(['www.google.com/*' => Http::response(['success' => false])]);
        $this->post(route('sendMessage'), $this->data())->assertSessionHas('error');
        Mail::assertNothingSent();
    }

    public function test_delivery_failure_is_visible_and_not_reported_as_success(): void
    {
        Http::fake(['www.google.com/*' => Http::response(['success' => true])]);
        Mail::shouldReceive('to')->once()->with('thewaywelove24@gmail.com')->andReturnSelf();
        Mail::shouldReceive('send')->once()->andThrow(new \RuntimeException('private-transport-detail'));
        $this->post(route('sendMessage'), $this->data())->assertSessionHas('error')->assertSessionMissing('feedback');
    }
}
