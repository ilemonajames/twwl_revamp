<?php

namespace App\Livewire\WebsiteAdmin\Newsletters;

use Livewire\Component;
use App\Models\NewsLetter;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
class SentNewsletterComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteGrowth'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $newsletter;
    public $selNewsletter;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getNewsletters(){
        $newsletters = NewsLetter::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('title', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $newsletters;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function setNewsletter(NewsLetter $newsletter){
        $this->title = $newsletter->title;
        $this->description = $newsletter->description;
        $this->selNewsletter = $newsletter;
    }
    //delete Service
    public function deleteGrowth(){
        $newsletter= NewsLetter::find($this->actionId);
        if($newsletter){
            unlink('assets/images/newsletter/'.$newsletter->image);
            unlink('assets/images/newsletter/'.$newsletter->file);
        }
        $newsletter->delete();
        $this->dispatch('feedback',feedback:'Newsletter Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setGrowth(NewsLetter $newsletter){
        $this->selNewsletter = $newsletter;
    }


    public function render()
    {
        $newsletters = $this->getNewsletters();
        return view('livewire.website-admin.newsletters.sent-newsletter-component',compact('newsletters'))->layout('livewire.website-admin.layouts.app');
    }
}
