<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Image;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Program;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewProgramComponent extends Component
{

    public $description;
    public $title;
    public $photo;
    public $program_icon;
    use WithFileUploads;


    public $message = [
        'title.required' => "Please enter your program title",
        'content.description' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];


    //create new service
    public function newService($formData){

        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:programs,program_title'],
            'description'=> ['required', 'string'],
            'photo' => 'required|mimes:jpeg,png,gif',
            // 'program_icon' => 'required|mimes:png',
        ],$this->message);

        $servicePhoto  = $this->uploadProductImage($formData['croped_image']);
        // $serviceIcon = $this->uploadIcon();

        Program::create([
            'program_title' => $this->title,
            'program_description' => $this->description,
            'program_image' => $servicePhoto,
            // 'program_icon' => $serviceIcon,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Program successfully added");
    }


    //upload service icon
    // public function uploadIcon(){
    //     $photoName = Carbon::now()->timestamp. '.' . $this->program_icon->getClientOriginalName();//generate name for image
    //     $this->program_icon->storeAs('/services',$photoName);
    //     return $photoName;
    // }

    //upload service image
    public function uploadProductImage($image){
        $img =$image;
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $postImage = Carbon::now()->timestamp.'service';//generate name for image
        $img = Image::make($image_base64)->encode('jpg', 60);
        file_put_contents('guest/images/uploads/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function render()
    {
        return view('livewire.website-admin.programs.new-program-component')->layout('livewire.website-admin.layouts.app');
    }
}
