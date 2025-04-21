<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Illuminate\Support\Facades\Http;

// require 'C:\Users\Legend\Documents\twwl_revamp\vendor\autoload.php';

// Include Google Cloud dependencies using Composer
use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

class ContactController extends Controller
{
    public function sendMessage(Request $request){
        $data = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email'],
            'message' => ['required','string','max:500'],
            'g-recaptcha-response' => 'required', 
        ]);

        $question = [
            'email' => $data['email'],
            'name' => $data['name'],
            'message' => $data['message'],

        ];

  // Verify reCAPTCHA token with Google(version 2)
      $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);

    $responseData = $response->json();

    if (!$responseData['success']) {
        \Log::info('Contact form email not sent');
        return redirect()->back()->with('error', 'reCAPTCHA verification failed. Try again.');
    }

        try{
            // Mail::to("support@maytrustmicrolending.com")->send(new ContactMail($question));
            Mail::to("thewaywelove24@gmail.com")->send(new ContactMail($question));
            \Log::info('Contact form email sent');
            
        }catch(\Exception $e){
            \Log::error('Mail sending failed: ' . $e->getMessage());
            // dd('Email error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send the message. Please try again later.');
            
        }

        return back()->with('feedback','Message Successully Sent');
    }
}

