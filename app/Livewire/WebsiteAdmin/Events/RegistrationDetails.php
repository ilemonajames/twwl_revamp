<?php

namespace App\Livewire\WebsiteAdmin\Events;

use Livewire\Component;
use App\Models\EventRegistration;
class RegistrationDetails extends Component
{

    protected $listeners = ['delete-confirmed'=>'deleteBook'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;

    public $event_id;
    public function mount($id){
        $this->event_id = $id;
    }


    public function getRegistrants(){
        $regs = EventRegistration::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('name', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $regs;
    }

    public function render()
    {
        $eventRegs = $this->getRegistrants();
        $regStats = EventRegistration::all();
        return view('livewire.website-admin.events.registration-details',compact('eventRegs','regStats'))->layout('livewire.website-admin.layouts.app');
    }
}
