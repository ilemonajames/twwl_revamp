<?php

namespace App\Livewire\WebsiteAdmin\Podcast;

use Livewire\Component;
use App\Models\Podcast;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PodcastsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deletePodcast'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $blog;
    public $selPodcast;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getPodcasts(){
        $podcasts = Podcast::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('title', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $podcasts;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function setPodcast(Podcast $podcast){
        $this->title = $podcast->title;
        $this->description = $podcast->description;
        $this->selPodcast = $podcast;
    }
    //delete Service
    public function deletePodcast(){
        $podcast= Podcast::find($this->actionId);
        $podcast->delete();
        $this->dispatch('feedback',feedback:'Podcast Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setService(Blog $blog){
        $this->blog = $blog;
    }


    public function render()
    {
        $podcasts = $this->getPodcasts();
        return view('livewire.website-admin.podcast.podcasts-component',compact('podcasts'))->layout('livewire.website-admin.layouts.app');
    }
}
