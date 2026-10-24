<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        try {
            $request->user()->sendEmailVerificationNotification();
        } catch (\Symfony\Component\Mailer\Exception\TransportExceptionInterface $exception) {
            \Illuminate\Support\Facades\Log::warning('Verification email transport failed.', ['exception_type' => get_class($exception)]);
            return back()->withErrors(['email' => 'The verification email could not be sent. Please try again later or contact our team.']);
        }

        return back()->with('status', 'verification-link-sent');
    }
}
