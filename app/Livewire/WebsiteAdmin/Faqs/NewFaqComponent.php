<?php

namespace App\Livewire\WebsiteAdmin\Faqs;

use Livewire\Component;
use App\Models\Faq;
class NewFaqComponent extends Component
{

    public $question;
    public $answer;

    public function newFaq(){
        $this->validate([
            'question' => ['required','string','unique:faqs,question'],
            'answer' => ['required','string']
        ]);

        Faq::create([
            'question' => $this->question,
            'answer' => $this->answer
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Quesiton successfully added");
    }
    public function render()
    {
        return view('livewire.website-admin.faqs.new-faq-component')->layout('livewire.website-admin.layouts.app');
    }
}
