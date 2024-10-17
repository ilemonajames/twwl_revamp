<?php

namespace App\Livewire\WebsiteAdmin\Faqs;

use Livewire\Component;
use App\Models\Faq;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class FaqsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteBlog'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $selFaq;
    public $question;
    public $answer;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getFaqs(){
        $faq = Faq::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('question', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $faq;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    //delete Service
    public function deleteBlog(){
        $blog= Faq::find($this->actionId);

        $blog->delete();
        $this->dispatch('feedback',feedback:'Qeustion Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setFaq(Faq $faq){
        $this->selFaq = $faq;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
    }

    public function updateFaq(){
        $this->validate([
            'question' => ['required','string','unique:faqs,question,'.$this->selFaq->id],
            'answer' => ['required','string']
        ]);

        $this->selFaq->update([
            'question' => $this->question,
            'answer' => $this->answer
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Quesiton successfully added");
    }

    public function render()
    {
        $faqs = $this->getFaqs();
        return view('livewire.website-admin.faqs.faqs-component',compact('faqs'))->layout('livewire.website-admin.layouts.app');
    }
}
