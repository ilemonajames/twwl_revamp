<?php

namespace App\Livewire\WebsiteAdmin\Programfees;

use Livewire\Component;
use App\Models\ProgramFee;
use App\Models\Program;
use App\Models\Service;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ProgramFeesComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteService'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $program;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of services
       public function getFees(){
        $fee = ProgramFee::query()
            ->where(function($query) {
                if($this->searchTerm) {
                    $service = Service::where('service_title', 'like', '%'.$this->searchTerm.'%')->pluck('id');
                    $query->wherein('service_id',$service);
                }
            })
            ->orWhere(function($query) {
                if($this->searchTerm) {
                    $program = pPogram::where('program_title', 'like', '%'.$this->searchTerm.'%')->pluck('id');
                    $query->wherein('program_id',$program);
                }
            })


        ->latest()->paginate($this->paginate);
        return $fee;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }


    //delete Service
    public function deleteService(){
        $fee= ProgramFee::find($this->actionId);
        $fee->delete();
        $this->dispatch('feedback',feedback:'fee Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setFee(ProgramFee $fees){
        $this->fees = $fees;
    }


    public function render()
    {
        $fees = $this->getFees();
        return view('livewire.website-admin.programfees.program-fees-component',compact('fees'))->layout('livewire.website-admin.layouts.app');
    }
}
