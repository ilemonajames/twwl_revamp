<?php

namespace App\Livewire\WebsiteAdmin\Sponsors;

use Livewire\Component;
use App\Models\Sponsor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
class SponsorsComponent extends Component
{

    protected $listeners = ['delete-confirmed'=>'deleteBlog'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $selSpnor;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of sponsors
       public function getSponsors(){
        $sponsors = Sponsor::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('sponsor', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $sponsors;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    //delete sponsor
    public function deleteBlog(){
        $sponsor= Sponsor::find($this->actionId);
        if($sponsor){
            unlink('assets/images/partners/'.$sponsor->image);

        }
        $sponsor->delete();
        $this->dispatch('feedback',feedback:'Partner Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setService(Sponsor $sponsor){
        $this->selSponsor = $sponsor;
    }


    public function render()
    {
        $sponsors = $this->getSponsors();
        return view('livewire.website-admin.sponsors.sponsors-component',compact('sponsors'))->layout('livewire.website-admin.layouts.app');
    }
}
