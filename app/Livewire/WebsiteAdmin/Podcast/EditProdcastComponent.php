<?php

namespace App\Livewire\WebsiteAdmin\Podcast;

use Livewire\Component;
use App\Models\Podcast;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;

class EditProdcastComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $release_date;
    public $category;
    public $host;
    public $link;
    public $photo;
    public $selPodcast;


    public $message = [
        'title.required' => "Please provide your blog title",
        'description.required' => "Please provide your blog description",
        'photo.required' => "Please upload a blog image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];

    public function mount($id){
        $this->selPodcast = $podcast = Podcast::find($id);
        $this->title = $podcast->title;
        $this->description = $podcast->description;
        $this->release_date = $podcast->release_date;
        $this->host = $podcast->host;
        $this->link = $podcast->link;
        $this->category = $podcast->category;
    }

    public function updatedPhoto($photo){
        if($this->photo){
            $fileExtension = $this->photo->getClientOriginalExtension();
            if ($this->isImage($fileExtension)) {
                $this->dispatch('image_file', image_file:  'image_file');
            }
        }
    }

    private function isImage($extension)
    {
        return in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
    }

    private function isVideo($extension)
    {
        return in_array(strtolower($extension), ['mp4', 'avi', 'mov']);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'title'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            'photo' => 'required',
        ],$this->message);

        if($this->photo){
            // Determine the file type based on the extension
            $fileExtension = $this->photo->getClientOriginalExtension();

            if ($this->isImage($fileExtension)) {
                $this->validateOnly($fields,[
                    'photo' => 'required|mimes:jpeg,png,gif',
                ],$this->message);
            } elseif ($this->isVideo($fileExtension)) {
                $this->validateOnly($fields,[
                    'photo' => 'required|mimes:mp4,avi,mov|max:12000',
                ],$this->message);
            } else {
                $this->message = 'Unsupported file type!';
            }
        }

    }

    public function uploadProductImage($image){
        $img =$image;
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $postImage = Carbon::now()->timestamp.'blog.png';//generate name for image
        $img = Image::make($image_base64)->encode('jpg', 60);
        file_put_contents('guest/images/uploads/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function updatePodcast($formData){
        $this->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
            'category' => ['required','string'],
            'host' => ['required','string'],
            'release_date' => ['required','string'],
            'link' => ['required','string'],

        ]);

        if($this->photo){

            $fileExtension = $this->photo->getClientOriginalExtension();
            $this->validate([
                'photo' => 'required',
            ]);

            if ($this->isImage($fileExtension)) {
                $this->validate([
                    'photo' => 'required|mimes:jpeg,png,gif',
                ],$this->message);
            } elseif ($this->isVideo($fileExtension)) {
                $this->validate([
                    'photo' => 'required|mimes:mp4,avi,mov|max:12000',
                ],$this->message);
            } else {
                $this->message = 'Unsupported file type!';
            }

            if ($this->isImage($fileExtension)) {
                $imageName  = $this->uploadProductImage($formData['croped_image']);
            }else{
                $imageName = Carbon::now()->timestamp. '.' . $this->photo->getClientOriginalName(); //generates name for the news image
                $this->photo->storeAs('/uploads',$imageName);
            }

            $this->selPodcast->update([
                'photo' => $imageName
            ]);
        }


        $this->selPodcast->update([
            'title' => $this->title,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'category' => $this->category,
            'host' => $this->host,
            'audio_url' => $this->link,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Podcast created Updated");
        return redirect()->route('podcasts.index');

    }


    public function render()
    {
        return view('livewire.website-admin.podcast.edit-prodcast-component')->layout('livewire.website-admin.layouts.app');
    }
}
