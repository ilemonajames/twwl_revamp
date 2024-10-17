<?php

namespace App\Livewire\WebsiteAdmin\Events;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;
class EditEventComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $photo;
    public $thumbnail;
    public $event_date;
    public $event_link;

    public $event_time;
    public $event_location;
    public $type_of_event;
    public $selEvent;
    public $isVideo = false;
    public $file_extension;

    public $message = [
        'title.required' => "Please provide your event title",
        'description.required' => "Please provide your event description",
        'photo.required' => "Please upload a event image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];

    public function mount($id){
        $this->selEvent = $selEvent = Event::find($id);
        $this->title = $selEvent->event_title;
        $this->event_link = $selEvent->event_link;
        $this->description = $selEvent->description;
        $this->event_location = $selEvent->event_location;
        $this->event_date = $selEvent->event_date->format('Y-m-d');
        $this->event_time = $selEvent->event_time->format('H:m');
        // DD($this->event_time);
        $this->type_of_event = $selEvent->type_of_event;
        $this->file_extension = substr(strrchr($selEvent->image ,'.'),1);
        if ($this->file_extension =='mp4' || $this->file_extension =='avi' || $this->file_extension =='mov'){
            $this->isVideo = true;
        }
    }

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

    public function uploadImage($image){
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

    public function updateEvent($formData)
    {
        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:events,event_title,'.$this->selEvent->id],
            'description'=> ['required', 'string'],
            'event_date'=> ['required', 'date'],
            'event_time'=> ['required', 'string'],
            'event_location'=> ['required', 'string'],
            'type_of_event'=> ['required', 'string'],
        ], $this->message);

        if($this->photo || $this->thumbnail){
            if($this->photo){
                $fileExtension = $this->photo->getClientOriginalExtension();

                if ($this->isImage($fileExtension)) {
                    $this->validate([
                        'photo' => 'required|mimes:jpeg,png,gif',
                    ],$this->message);

                    $eventImageName  = $this->uploadImage($formData['croped_image']);
                    $this->selEvent->update([
                        'image' => $eventImageName,
                        'thumbnail' => null
                    ]);

                    $this->getEventUpdated();
                }else{

                    $this->validate([
                        'photo' => 'required|mimes:mp4,avi,mov|max:30000',
                        'thumbnail' => 'required|mimes:jpeg,png,gif',
                    ],$this->message);

                    $thumbnailImage = $this->uploadImage($formData['croped_thumbnail']);

                    $this->selEvent->update([
                        'image' => $eventImageName,
                        'thumbnail' => $thumbnailImage,
                    ]);

                    $this->getEventUpdated();
                }
            }elseif($this->thumbnail){
                $this->validate([
                    'thumbnail' => 'required|mimes:jpeg,png,gif',
                ],$this->message);

                $eventImageName  = $this->uploadImage($formData['croped_thumbnail']);

                $this->selEvent->update([
                    'thumbnail' => $eventImageName
                ]);

                $this->getEventUpdated();
            }
        }else{
            $this->getEventUpdated();
        }
    }

    public function getEventUpdated(){
        $this->selEvent->update([
            'event_title' => $this->title,
            'description' => $this->description,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'type_of_event' => $this->type_of_event,
            'event_location' => $this->event_location,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('events.index')->with("feedback","Event updated successfully");
    }
    public function render()
    {
        return view('livewire.website-admin.events.edit-event-component')->layout('livewire.website-admin.layouts.app');
    }
}
