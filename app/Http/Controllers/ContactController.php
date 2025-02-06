<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Biscolab\ReCaptcha\Facades\ReCaptcha;

class ContactController extends Controller
{
    public function sendMessage(Request $request){
        $data = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email'],
            'message' => ['required','string','max:500'],
            'g-recaptcha-response' => 'required|recaptcha', 
        ]);

        $question = [
            'email' => $data['email'],
            'name' => $data['name'],
            'message' => $data['message'],

        ];
        // Verify reCAPTCHA response
    // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
    //     'secret' => env('RECAPTCHA_SECRET_KEY'),
    //     'response' => $request->input('g-recaptcha-response'),
    // ]);

    // $responseData = $response->json();

    // if (!$responseData['success']) {
    //     return back()->withErrors(['captcha' => 'reCAPTCHA verification failed. Please try again.']);
    // }


        try{
            // Mail::to("support@maytrustmicrolending.com")->send(new ContactMail($question));
            Mail::to("thewaywelove24@gmail.com")->send(new ContactMail($question));
        }catch(\Exception $e){}

        return back()->with('feedback','Message Successully Sent');
    }
}
