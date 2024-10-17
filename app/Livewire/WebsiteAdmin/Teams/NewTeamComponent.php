<?php

namespace App\Livewire\WebsiteAdmin\Teams;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\LivingwordTeam;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;

class NewTeamComponent extends Component
{


    use WithFileUploads;

    public $fullname;
    public $facebook;
    public $instagram;
    public $twitter;
    public $linkedin;
    public $role;
    public $photo;
    public $about;

    public $message = [
        'title.required' => "Please provide your blog title",
        'description.required' => "Please provide your blog description",
        'photo.required' => "Please upload a blog image",
        'photo.dimensions' => "image must have a minimum of 860 width and 500 height",
    ];


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
            'fullname'=> ['required', 'string'],
            'role'=> ['required', 'string'],
            'facebook'=> ['required', 'string'],
            'instagram'=> ['required', 'string'],
            'linkedin'=> ['required', 'string'],
            'twitter'=> ['required', 'string'],
            'about'=> ['required', 'string'],
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
        file_put_contents('assets/images/team/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function addTeamMember($formData)
    {
        $this->validate([
            'fullname'=> ['required', 'string'],
            'role'=> ['required', 'string'],
            'facebook'=> ['required', 'string'],
            'instagram'=> ['required', 'string'],
            'linkedin'=> ['required', 'string'],
            'twitter'=> ['required', 'string'],
            'about'=> ['required', 'string'],
            'photo' => 'required',
        ], $this->message);

        $fileExtension = $this->photo->getClientOriginalExtension();

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
            $memberPhoto  = $this->uploadProductImage($formData['croped_image']);
        }else{
            $memberPhoto = Carbon::now()->timestamp. '.' . $this->photo->getClientOriginalName(); //generates name for the news image
            $this->photo->storeAs('/team',$memberPhoto);
        }

        LivingwordTeam::create([
            'full_name' => $this->fullname,
            'role' => $this->role,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'image' => $memberPhoto,
            'user_id' => Auth::user()->id,
            'about' => $this->about
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Team member added successfully");
    }

    public function render()
    {
        return view('livewire.website-admin.teams.new-team-component')->layout('livewire.website-admin.layouts.app');
    }
}
