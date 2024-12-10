<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Session;

class NewsletterSubscription extends Component
{

    public $email;

    public function subscribe(){

        $this->validate([
            'email' => ['required','email','unique:newsletter_subscribers']
        ]);

        $checkEmail = NewsletterSubscriber::where('email',$this->email)->first();

        if($checkEmail!=null){
            Session::flash('errorfeedbaack', 'Sorry you already subscribed for our news updates');
        }elseif($this->email==null){
            Session::flash('errorfeedbaack', 'Please enter your email address to subscribe to our news letter');
        }else{
            NewsletterSubscriber::create([
                'email' => $this->email
            ]);

            $this->reset();
            Session::flash('feedback', 'Subscribtion Successful');
        }

    }

    public function render()
    {
        return view('livewire.newsletter-subscription');
    }
}
