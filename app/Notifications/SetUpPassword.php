<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetUpPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public function __construct(public string $token)
    {
        $this->onConnection('database')->afterCommit();
    }

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)->subject('Welcome - set up your password')
            ->greeting('Welcome to The Way We Love')
            ->line('Your account has been created. Choose your own password before your first sign-in.')
            ->action('Set up my password', route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]))
            ->line('This single-use link expires in '.config('auth.passwords.users.expire', 60).' minutes. Setting your password also verifies your email address.')
            ->line('If it expires, request a new link using Forgot password on the login page. If you did not register, you can ignore this email.');
    }
}
