<?php

namespace App\Livewire\WebsiteAdmin\Teams;

use Livewire\Component;
use App\Models\LivingwordTeam;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManageTeamsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteTeam'];//listen to emited action

    public $fullname;
    public $facebook;
    public $instagram;
    public $twitter;
    public $linkedin;
    public $role;
    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $Team;
    public $selTeam;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getTeams(){
        $temas = LivingwordTeam::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('full_name', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('role', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $temas;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function setTeam(LivingwordTeam $team){
        $this->fullname = $team->full_name;
        $this->facebook = $team->facebook;
        $this->instagram = $team->instagram;
        $this->twitter = $team->twitter;
        $this->linkedin = $team->linkedin;
        $this->role = $team->role;
        $this->selTeam = $ream;
    }
    //delete Service
    public function deleteTeam(){
        $team= LivingwordTeam::find($this->actionId);
        if($team){
            unlink('assets/images/team/'.$team->image);
        }
        $team->delete();
        $this->dispatch('feedback',feedback:'Team Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setService(LivingwordTeam $team){
        $this->team = $team;
    }


    public function render()
    {
        $teams = $this->getTeams();
        return view('livewire.website-admin.teams.manage-teams-component',compact('teams'))->layout('livewire.website-admin.layouts.app');
    }
}
