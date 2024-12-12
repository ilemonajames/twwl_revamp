<?php

namespace App\Livewire\WebsiteAdmin\Newsletters;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use Livewire\WithPagination;

class SubscribersComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteService'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $service;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of services
       public function getSubscribers(){
        $subscribers = NewsletterSubscriber::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('email', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $subscribers;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }


    //delete Service
    public function deleteService(){
        $subscriber= NewsletterSubscriber::find($this->actionId);
        $subscriber->delete();
        $this->dispatch('feedback',feedback:'Subscriber Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setService(Service $service){
        $this->service = $service;
    }


    public function render()
    {
        $subscribers = $this->getSubscribers();
        return view('livewire.website-admin.newsletters.subscribers-component',compact('subscribers'))->layout('livewire.website-admin.layouts.app');
    }
}
