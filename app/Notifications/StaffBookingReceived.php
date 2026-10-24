<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffBookingReceived extends Notification implements ShouldQueue
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
        return (new MailMessage)->subject('New appointment request #'.$this->appointmentId)
            ->greeting('New booking request received')
            ->line('Appointment reference: '.$this->appointmentId.'.')
            ->line('Requested date and time: '.$this->date.' at '.$this->time.' ('.$this->timezone.').')
            ->line('Please review the customer details in the administration portal and verify payment before confirming the appointment date.')
            ->line('This notification does not confirm payment. Check the current booking and payment status in the portal.')
            ->action('Review bookings', route('admin.bookings'));
    }
}
