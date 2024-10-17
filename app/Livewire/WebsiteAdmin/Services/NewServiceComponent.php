<?php

namespace App\Livewire\WebsiteAdmin\Services;
use Image;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Service;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewServiceComponent extends Component
{

    public $description;
    public $title;
    public $photo;
    public $service_icon;
    use WithFileUploads;


    public $message = [
        'title.required' => "Please enter your service title",
        'content.description' => "Please enter your service description",
        'photo.required' => "Please upload a service image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];


    //create new service
    public function newService($formData){

        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:services,service_title'],
            'description'=> ['required', 'string'],
            'photo' => 'required|mimes:jpeg,png,gif',
            // 'service_icon' => 'required|mimes:png',
        ],$this->message);

        $servicePhoto  = $this->uploadProductImage($formData['croped_image']);
        // $serviceIcon = $this->uploadIcon();

        Service::create([
            'service_title' => $this->title,
            'service_description' => $this->description,
            'service_image' => $servicePhoto,
            // 'service_icon' => $serviceIcon,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Service successfully added");
    }


    //upload service icon
    // public function uploadIcon(){
    //     $photoName = Carbon::now()->timestamp. '.' . $this->service_icon->getClientOriginalName();//generate name for image
    //     $this->service_icon->storeAs('/services',$photoName);
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
        return view('livewire.website-admin.services.new-service-component')->layout('livewire.website-admin.layouts.app');
    }
}
