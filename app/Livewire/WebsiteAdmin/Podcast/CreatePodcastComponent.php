<?php

namespace App\Livewire\WebsiteAdmin\Podcast;

use Livewire\Component;
use App\Models\Podcast;

class CreatePodcastComponent extends Component
{

    public $title;
    public $description;
    public $release_date;
    public $duration;
    public $host;
    public $link;

    public function newPodcast(){
        $this->validate([
            'title' => ['required','string','unique:podcasts'],
            'description' => ['required','string'],
            'duration' => ['required','string'],
            'host' => ['required','string'],
            'release_date' => ['required','string'],
            'link' => ['required','string'],
        ]);

        Podcast::create([
            'title' => $this->title,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'duration' => $this->duration,
            'host' => $this->host,
            'audio_url' => $this->link,
        ]);

        $this->dispatch('feedback', feedback: "Podcast created successfully");

    }
    public function render()
    {
        return view('livewire.website-admin.podcast.create-podcast-component')->layout('livewire.website-admin.layouts.app');
    }
}
