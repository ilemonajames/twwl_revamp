<?php

namespace App\Livewire\WebsiteAdmin\Services;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Service;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class EditServiceComponent extends Component
{

    public $description;
    public $title;
    public $photo;
    public $service;
    // public $service_icon;
    use WithFileUploads;
    public $message = [
        'title.required' => "Please enter your service title",
        'content.description' => "Please enter your service description",
        'photo.required' => "Please upload a service image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];

    public function mount($id){
        $service = Service::find($id);
        $this->title = $service->service_title;
        $this->description = $service->service_description;
        $this->service = $service;
    }

    //service modification
    public function updateService(){
        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:services,service_title,'.$this->service->id],
            'description'=> ['required', 'string'],
            'photo' => 'nullable|mimes:jpeg,png,gif',
            // 'service_icon' => 'nullable|mimes:png',
        ],$this->message);

        //update service image if a new service image is selected
        if($this->photo){
            Storage::disk('do')->delete(storePhoto().$this->service->service_image);//delete old service image
            $servicePhoto  = $this->uploadProductImage($formData['croped_image']);
            $this->service->update(['service_image'=>$servicePhoto ]);
        }

        //update service icon if a new service icon is selected
        // if($this->service_icon){
        //     $serviceIcon = $this->uploadIcon();
        //     Storage::disk('do')->delete(storePhoto().$this->service->service_image);
        //     $this->service->update(['service_icon'=>$serviceIcon ]);
        // }

        $this->service->update([
            'service_title' => $this->title,
            'service_description' => $this->description,
        ]);

        return redirect()->route('services.index')->with('feedback','Service successfully updated');
    }

    //upload service icon
    public function uploadIcon(){
        $photoName = Carbon::now()->timestamp. '-' . trim($this->service_icon->getClientOriginalName());//generate name for image
        $this->service_icon->storePubliclyAs(storePhoto(),$photoName,'do'); //save photo to digital ocean storage
        return $photoName;
    }

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
        return view('livewire.website-admin.services.edit-service-component')->layout('livewire.website-admin.layouts.app');
    }
}
