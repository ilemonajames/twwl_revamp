<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:diagnose', function () {
    $mailer = config('mail.default');
    $this->line('Default mailer: '.$mailer);
    $this->line('SMTP host configured: '.(filled(config('mail.mailers.smtp.host')) ? 'yes' : 'no'));
    $this->line('SMTP credentials configured: '.(filled(config('mail.mailers.smtp.username')) && filled(config('mail.mailers.smtp.password')) ? 'yes' : 'no'));
    $this->line('From address configured: '.(filled(config('mail.from.address')) && config('mail.from.address') !== 'hello@example.com' ? 'yes' : 'no'));
    $this->line('Contact destination: '.config('services.contact.recipient'));
    if (in_array($mailer, ['log', 'array'], true)) {
        $this->warn('This mailer does not deliver email to inboxes. Configure a delivery transport such as SMTP.');
    }
    try {
        $this->line('Queued database jobs: '.\Illuminate\Support\Facades\DB::table('jobs')->count());
        $this->line('Failed jobs: '.\Illuminate\Support\Facades\DB::table('failed_jobs')->count());
    } catch (\Throwable $exception) {
        $this->warn('Queue tables could not be inspected; check migrations and database connectivity.');
    }
    $this->line('Booking and setup emails require a database queue worker. This command sends no email and does not test SMTP connectivity.');
})->purpose('Show non-secret mail configuration and queue diagnostics');
