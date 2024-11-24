<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class VideoManager extends Component
{
    use WithFileUploads;

    public $videoLink;      // The video URL
    public $description;    // Video description
    public $thumbnail;      // Thumbnail file

    public function saveVideo()
    {
        $this->validate([
            'videoLink' => 'required|url',
            'description' => 'required|string|max:500',
            'thumbnail' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Save thumbnail if provided
        $thumbnailPath = null;
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('thumbnails', 'public');
        }

        // Simulate saving to a database
        // Replace with actual database logic
        $videoData = [
            'video_link' => $this->videoLink,
            'description' => $this->description,
            'thumbnail' => $thumbnailPath,
        ];

        // For now, simulate success
        session()->flash('message', 'Video details saved successfully!');
    }

    public function render()
    {
        return view('livewire.website-admin.video-manager');
    }
}
