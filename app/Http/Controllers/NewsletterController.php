<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $checkEmail = NewsletterSubscriber::where('email', $data['email'])->first();

        if ($checkEmail != null) {
            return back()->with('errorfeedback', 'Sorry you already subscribed for our news updates');
        } elseif ($data['email'] == null) {
            return back()->with('errorfeedback', 'Please enter your email address to subscribe to our news letter');
        } else {
            NewsletterSubscriber::create([
                'email' => $data['email'],
            ]);

            return back()->with('feedback', 'Subscription Successful');
        }

    }
}
