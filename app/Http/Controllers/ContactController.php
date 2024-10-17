<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(Request $request){
        $data = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email'],
            'message' => ['required','string','max:500'],
        ]);

        $question = [
            'email' => $data['email'],
            'name' => $data['name'],
            'message' => $data['message'],
        ];

        try{
            // Mail::to("support@maytrustmicrolending.com")->send(new ContactMail($question));
            Mail::to("emberugbon@gmail.com")->send(new ContactMail($question));
        }catch(\Exception $e){}

        return back()->with('feedback','Message Successully Sent');
    }
}
