<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\NewsLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendNewsletterDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $timeout = 60;

    public function __construct(public int $deliveryId)
    {
        $this->onConnection('database');
    }

    public function backoff(): array
    {
        return [30, 120, 300];
    }

    public function handle(): void
    {
        $delivery = DB::table('newsletter_deliveries')->find($this->deliveryId);
        if (! $delivery || $delivery->status === 'sent') {
            return;
        }
        $newsletter = NewsLetter::findOrFail($delivery->newsletter_id);
        Mail::to($delivery->email)->send(new NewsletterMail($newsletter));
        DB::table('newsletter_deliveries')->where('id', $delivery->id)->update(['status' => 'sent', 'updated_at' => now()]);
    }

    public function failed(?\Throwable $exception): void
    {
        DB::table('newsletter_deliveries')->where('id', $this->deliveryId)->update(['status' => 'failed', 'updated_at' => now()]);
        \Log::warning('Newsletter delivery failed', ['delivery_id' => $this->deliveryId]);
    }
}
