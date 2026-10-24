<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingReceived extends Notification implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public function __construct(public int $appointmentId, public string $date, public string $time, public string $timezone)
    {
        $this->onConnection('database')->afterCommit();
    }

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)->subject('We have received your appointment request')
            ->greeting('Thank you for booking with The Way We Love')
            ->line('We have received your booking request. Reference: '.$this->appointmentId.'.')
            ->line('Requested date and time: '.$this->date.' at '.$this->time.' ('.$this->timezone.').')
            ->line('This is an acknowledgement, not a confirmed appointment or payment receipt. Your appointment date will be confirmed once payment has been received and verified.')
            ->line('If you have already paid, please allow our team to verify it. Contact us if you need help with payment or your requested date.')
            ->action('Contact our team', route('contact'));
    }
}
