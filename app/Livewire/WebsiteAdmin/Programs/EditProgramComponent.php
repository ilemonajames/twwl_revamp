<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Program;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProgramComponent extends Component
{
    public $description;
    public $title;
    public $photo;
    public $program;
    // public $program_icon;
    use WithFileUploads;
    public $message = [
        'title.required' => "Please enter your program title",
        'content.description' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];

    public function mount($id){
        $program = Program::find($id);
        $this->title = $program->program_title;
        $this->description = $program->program_description;
        $this->program = $program;
    }

    //service modification
    public function updateService(){
        $this->validate([
            'title'=> ['required', 'string', 'max:255','unique:programs,program_title,'.$this->program->id],
            'description'=> ['required', 'string'],
            'photo' => 'nullable|mimes:jpeg,png,gif',
            // 'program_icon' => 'nullable|mimes:png',
        ],$this->message);

        //update service image if a new service image is selected
        if($this->photo){
            Storage::disk('do')->delete(storePhoto().$this->program->program_image);//delete old service image
            $programPhoto  = $this->uploadProductImage($formData['croped_image']);
            $this->program->update(['program_image'=>$programPhoto ]);
        }

        //update service icon if a new service icon is selected
        // if($this->program_icon){
        //     $serviceIcon = $this->uploadIcon();
        //     Storage::disk('do')->delete(storePhoto().$this->service->program_image);
        //     $this->service->update(['program_icon'=>$serviceIcon ]);
        // }

        $this->program->update([
            'program_title' => $this->title,
            'program_description' => $this->description,
        ]);

        return redirect()->route('programs.index')->with('feedback','program successfully updated');
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
        return view('livewire.website-admin.programs.edit-program-component')->layout('livewire.website-admin.layouts.app');
    }
}
