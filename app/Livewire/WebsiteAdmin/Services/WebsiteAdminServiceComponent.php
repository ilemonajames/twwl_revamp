<?php

namespace App\Livewire\WebsiteAdmin\Services;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class WebsiteAdminServiceComponent extends Component
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
       public function getServices(){
        $services = Service::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('service_title', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('service_description', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $services;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }


    //delete Service
    public function deleteService(){
        $service= Service::find($this->actionId);
        if($service){
            // unlink('guest/images/uploads/'.$service->service_icon);
            unlink('guest/images/uploads/'.$service->service_image);
        }
        $service->delete();
        $this->dispatch('feedback',feedback:'Service Successfully Deleted');
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
        $services = $this->getServices();
        return view('livewire.website-admin.services.website-admin-service-component',compact('services'))->layout('livewire.website-admin.layouts.app');
    }
}
