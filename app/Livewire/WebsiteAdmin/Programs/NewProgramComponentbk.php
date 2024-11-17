<?php

namespace App\Livewire\WebsiteAdmin\Programs;

// use Carbon\Carbon;
// use Livewire\Component;
// use App\Models\Program;
// use Livewire\WithFileUploads;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

// class NewProgramComponent extends Component
// {
//     use WithFileUploads;

//     public $title;
//     public $description;
//     public $photo;

//     protected $rules = [
//         'title' => 'required|string|max:255|unique:programs,program_title',
//         'description' => 'required|string',
//         'photo' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048|dimensions:min_width=860,min_height=500',
//     ];

//     protected $messages = [
//         'title.required' => "Please enter your program title",
//         'description.required' => "Please enter your program description",
//         'photo.required' => "Please upload a program image",
//         'photo.dimensions' => "Image must be at least 860px wide and 500px tall",
//     ];

//     public function newService()
//     {
//         $this->validate();

//         try {
//             // Upload and save image
//             $servicePhoto = $this->uploadProductImage($this->photo);

//             // Create new Program record
//             Program::create([
//                 'program_title' => $this->title,
//                 'program_description' => $this->description,
//                 'program_image' => $servicePhoto,
//             ]);

//             // Reset inputs and provide success feedback
//             $this->reset();
//             session()->flash('message', 'Program successfully added.');

//         } catch (\Exception $e) {
//             Log::error("Error adding program: " . $e->getMessage());
//             session()->flash('error', 'An error occurred. Please try again.');
//         }
//     }

//     public function uploadProductImage($image)
//     {
//         try {
//             $postImageName = Carbon::now()->timestamp . '_service.jpg';

//             // Resize and compress image using Intervention Image
//             $img = Image::make($image->getRealPath())->encode('jpg', 60);

//             // Store image on DigitalOcean Spaces
//             Storage::disk('do')->put("guest/images/uploads/{$postImageName}", $img->stream());

//             return $postImageName;
//         } catch (\Exception $e) {
//             Log::error("Image upload failed: " . $e->getMessage());
//             throw new \Exception("Failed to upload image.");
//         }
//     }

//     public function render()
//     {
//         return view('livewire.website-admin.programs.new-program-component')
//             ->layout('livewire.website-admin.layouts.app');
//     }
// }

 

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
    // public function newService($formData){

    //     $this->validate([
    //         'title'=> ['required', 'string', 'max:255','unique:programs,program_title'],
    //         'description'=> ['required', 'string'],
    //         'photo' => 'required|mimes:jpeg,jpg,png,gif',
    //         // 'program_icon' => 'required|mimes:png',
    //     ],$this->message);
        

    //     $servicePhoto  = $this->uploadProductImage($formData['croped_image']);
    //     // $serviceIcon = $this->uploadIcon();

    //     Program::create([
    //         'program_title' => $this->title,
    //         'program_description' => $this->description,
    //         'program_image' => $servicePhoto,
    //         // 'program_icon' => $serviceIcon,
    //     ]);

    //     $this->reset();
    //     $this->dispatch('feedback', feedback: "Program successfully added");
    // }

    public function newService($formData){
        try {
            $this->validate([
                'title'=> ['required', 'string', 'max:255','unique:programs,program_title'],
                'description'=> ['required', 'string'],
                'photo' => 'required|mimes:jpeg,jpg,png,gif',
            ], $this->message);
    
            $servicePhoto  = $this->uploadProductImage($formData['croped_image']);
    
            Program::create([
                'program_title' => $this->title,
                'program_description' => $this->description,
                'program_image' => $servicePhoto,
            ]);
    
            $this->reset();
            $this->dispatch('feedback', feedback: "Program successfully added");
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->dispatch('feedback', feedback: "An error occurred: " . $e->getMessage());
        }
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


