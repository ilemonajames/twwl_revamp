<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request){
        $data = $request->validate([
            'email' => ['required','string']
        ]);

        $checkEmail = NewsletterSubscriber::where('email',$data['email'])->first();

        if($checkEmail!=null){
            return back()->with('errorfeedback', 'Sorry you already subscribed for our news updates');
        }elseif($data['email']==null){
            return back()->with('errorfeedback', 'Please enter your email address to subscribe to our news letter');
        }else{
            NewsletterSubscriber::create([
                'email' => $data['email']
            ]);

            return back()->with('feedback','Subscription Successful');
        }

    }
}
