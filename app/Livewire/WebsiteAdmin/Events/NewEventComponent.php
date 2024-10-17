<?php

namespace App\Livewire\WebsiteAdmin\Events;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;
class NewEventComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $photo;
    public $thumbnail;
    public $event_date;
    public $event_time;
    public $event_location;
    public $event_link;
    public $type_of_event;
    public $isVideo = false;

    public $message = [
        'title.required' => "Please provide your event title",
        'description.required' => "Please provide your event description",
        'photo.required' => "Please upload a event image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];


    public function updatedPhoto($photo){
        if($this->photo){
            $fileExtension = $this->photo->getClientOriginalExtension();
            if ($this->isImage($fileExtension)) {
                $this->dispatch('image_file', image_file:  'image_file');
            }elseif($this->isVideo($fileExtension)){
                $this->isVideo = true;
            }
        }
    }

    public function updatedThumbnail($thumbnail){
        if($this->thumbnail){
            $fileExtension = $this->thumbnail->getClientOriginalExtension();
            if ($this->isImage($fileExtension)) {
                $this->dispatch('thumbnail_file', thumbnail_file:  'thumbnail_file');
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
                    'photo' => 'required|mimes:mp4,avi,mov|max:30000',
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
        $postImage = Carbon::now()->timestamp.'event.png';//generate name for image
        $img = Image::make($image_base64)->encode('jpg', 60);
        file_put_contents('guest/images/uploads/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function newEvent($formData)
    {
        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:events,event_title'],
            'description'=> ['required', 'string'],
            'event_date'=> ['required', 'date'],
            'event_time'=> ['required', 'string'],
            'type_of_event'=> ['required', 'string'],
            'photo' => 'required',
        ], $this->message);

        if($this->type_of_event!="Physical"){
            $this->validate([
                'event_link'=> ['required', 'string'],
            ], $this->message);
        }
        if($this->type_of_event!="Virtual"){
            $this->validate([
                'event_location'=> ['required', 'string'],
            ], $this->message);
        }


        $fileExtension = $this->photo->getClientOriginalExtension();

        if ($this->isImage($fileExtension)) {
            $this->validate([
                'photo' => 'required|mimes:jpeg,png,gif',
            ],$this->message);
        } elseif ($this->isVideo($fileExtension)) {
            $this->validate([
                'photo' => 'required|mimes:mp4,avi,mov|max:30000',
                'thumbnail' => 'required|mimes:jpeg,png,gif',
            ],$this->message);
        } else {
            $this->message = 'Unsupported file type!';
        }

        if ($this->isImage($fileExtension)) {
            $eventImageName  = $this->uploadProductImage($formData['croped_image']);
            $thumbnailImage = null;
        }else{
            $eventImageName = Carbon::now()->timestamp. '.' . $this->photo->getClientOriginalName(); //generates name for the news image
            $this->photo->storeAs('/guest/images/uploads',$thumbnailImage);

            $thumbnailImage = $this->uploadProductImage($formData['croped_thumbnail']);
        }

        $shortId = Str::random(6);
        $event = Event::create([
            'id' => $shortId,
            'event_title' => $this->title,
            'description' => $this->description,
            'image' => $eventImageName,
            'thumbnail' => $thumbnailImage,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'type_of_event' => $this->type_of_event,
            'event_location' => $this->event_location,
            'event_link' => $this->event_link,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Event scheduled successfully");
    }

    public function render()
    {
        return view('livewire.website-admin.events.new-event-component')->layout('livewire.website-admin.layouts.app');
    }
}
