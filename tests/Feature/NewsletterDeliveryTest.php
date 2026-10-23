<?php

namespace Tests\Feature;

use App\Jobs\SendNewsletterDelivery;
use App\Livewire\WebsiteAdmin\Newsletters\SendNewsletterComponent;
use App\Mail\NewsletterMail;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class NewsletterDeliveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_newsletters_queue_individual_deliveries_and_record_success(): void
    {
        Queue::fake();
        Mail::fake();
        NewsletterSubscriber::create(['email' => 'one@example.com']);
        NewsletterSubscriber::create(['email' => 'two@example.com']);
        Livewire::actingAs(User::factory()->create(['user_type' => 'Website Admin']))
            ->test(SendNewsletterComponent::class)
            ->set('title', 'Updates')->set('description', 'Our latest news')
            ->call('sendNewsletter', [])->assertHasNoErrors();
        Queue::assertPushed(SendNewsletterDelivery::class, 2);
        $this->assertDatabaseCount('newsletter_deliveries', 2);
        foreach (DB::table('newsletter_deliveries')->get() as $delivery) {
            (new SendNewsletterDelivery($delivery->id))->handle();
            Mail::assertSent(NewsletterMail::class, fn ($mail) => $mail->hasTo($delivery->email) && count($mail->to) === 1);
        }
        $this->assertSame(2, DB::table('newsletter_deliveries')->where('status', 'sent')->count());
    }

    public function test_newsletter_failures_are_recorded_for_followup(): void
    {
        $id = DB::table('newsletter_deliveries')->insertGetId([
            'newsletter_id' => 'missing', 'email' => 'one@example.com',
            'status' => 'queued', 'created_at' => now(), 'updated_at' => now(),
        ]);
        (new SendNewsletterDelivery($id))->failed(new \RuntimeException('failure'));
        $this->assertDatabaseHas('newsletter_deliveries', ['id' => $id, 'status' => 'failed']);
    }
}
