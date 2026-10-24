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
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'phone' => ['nullable','string','max:40'],
            'message' => ['required','string','max:500'],
            'g-recaptcha-response' => 'required', 
        ]);

        $question = [
            'email' => $data['email'],
            'name' => $data['name'],
            'message' => $data['message'],
            'phone' => $data['phone'] ?? null,

        ];

  // Verify reCAPTCHA token with Google(version 2)
      try {
      $response = Http::asForm()->connectTimeout(5)->timeout(10)->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => config('services.recaptcha.secret_key'),
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);
      } catch (\Illuminate\Http\Client\ConnectionException $exception) {
          return back()->withInput($request->only('name', 'email', 'phone', 'message'))
              ->with('error', 'Verification is temporarily unavailable. Please try again.');
      }

    $responseData = $response->json();

    if (!$response->successful() || !($responseData['success'] ?? false)) {
        \Log::info('Contact form email not sent');
        return redirect()->back()->withInput($request->only('name', 'email', 'phone', 'message'))->with('error', 'reCAPTCHA verification failed. Try again.');
    }

        try{
            // Mail::to("support@maytrustmicrolending.com")->send(new ContactMail($question));
            Mail::to(config('services.contact.recipient'))->send(new ContactMail($question));
            \Log::info('Contact form email sent');
            
        }catch(\Exception $e){
            \Log::error('Contact mail sending failed.', ['exception_type' => get_class($e)]);
          //   dd('Email error: ' . $e->getMessage());
            return redirect()->back()->withInput($request->only('name', 'email', 'phone', 'message'))->with('error', 'Failed to send the message. Please try again later or email thewaywelove24@gmail.com directly.');
            
        }

        return back()->with('feedback','Your message has been submitted to our team.');
    }
}

