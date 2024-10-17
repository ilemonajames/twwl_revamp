<?php

namespace App\Livewire\WebsiteAdmin\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Carbon\Carbon;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileComponent extends Component
{
    use WithFileUploads;
    public $photo;
    public $selectedPhoto;

    public $message = [
        'photo.required' => "Please select your passport photograph",
        'photo.required' => "photo must be of type jpg, or png",
        'photo.image' => "photo must be an image",
        'photo.dimensions' => "photo must have a minimum of 230 width and 230 height",
    ];

    public function updated($fields){
        $this->validateOnly($fields,[
            'photo' => ['required','image', 'dimensions:min_width=230,min_height=230', 'mimes:jpg,png,jpeg','max:100'],
        ],$this->message);
    }


    public function updateProfilePhoto(){
        $this->validate([
            'photo' => ['required','image', 'dimensions:min_width=230,min_height=230', 'mimes:jpg,png','max:200'],
        ]);

        $user = User::find(Auth::user()->id);

        if($this->photo){
            if($user->profile_photo_path != 'user.png'){
                Storage::disk('do')->delete(storePhoto().$user->profile_photo_path);
            }
            $photoName = Carbon::now()->timestamp. '.' . $this->photo->getClientOriginalName();
            $this->photo->storePubliclyAs(storePhoto(),$photoName,'do');
            $user->update(['profile_photo_path'=> $photoName]);

        }

        // dd($photoName);
        $this->dispatch('feedback', feedback: "Photo Successfully Uploaded");
    }

    public function setPhoto(User $photos){
        $this->selectedPhoto = $photos;
    }

    public function mount(){
        $user = User::find(Auth::user()->id);
    }

    public function render()
    {
        $staff = User::find(Auth::user()->id);
        return view('livewire.website-admin.profile.profile-component',compact('staff'))->layout('livewire.website-admin.layouts.app');
    }
}
