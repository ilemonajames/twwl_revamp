<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\Appointment::created(function ($appointment) {
            if (! in_array($appointment->status, ['pending', 'pending_payment'], true)) {
                return;
            }
            $email = $appointment->email ?: $appointment->user?->email;
            if ($email) {
                \Illuminate\Support\Facades\Notification::route('mail', $email)->notify(
                    new \App\Notifications\BookingReceived(
                        $appointment->id, $appointment->appointment_date->format('Y-m-d'),
                        substr($appointment->appointment_time, 0, 5), config('app.timezone')
                    )
                );
            }
            foreach (array_unique(config('services.booking.notification_recipients', [])) as $recipient) {
                \Illuminate\Support\Facades\Notification::route('mail', $recipient)->notify(
                    new \App\Notifications\StaffBookingReceived(
                        $appointment->id, $appointment->appointment_date->format('Y-m-d'),
                        substr($appointment->appointment_time, 0, 5), config('app.timezone')
                    )
                );
            }
        });
        \Livewire\Livewire::addPersistentMiddleware([
            \App\Http\Middleware\WebsiteAdminMiddleware::class,
            \App\Http\Middleware\ClientMiddleware::class,
        ]);
    }
}
