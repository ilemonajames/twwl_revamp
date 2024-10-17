<?php

namespace App\Livewire\WebsiteAdmin\Sponsors;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;
class NewSponsorComponent extends Component
{
    use WithFileUploads;

    public $sponsor;
    public $photo;
    public $website;

    public $message = [
        'sponsor.required' => "Please enter your partner name",
        'description.required' => "Please provide your blog description",
        'photo.required' => "Please upload your partner logo",
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

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'sponsor'=> ['required', 'string', 'max:255','unique:sponsors,sponsor'],
            'photo' => 'required',
        ],$this->message);

        if($this->photo){
            // Determine the file type based on the extension
            $fileExtension = $this->photo->getClientOriginalExtension();

            if ($this->isImage($fileExtension)) {
                $this->validateOnly($fields,[
                    'photo' => 'required|mimes:jpeg,png,gif',
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
        $postImage = Carbon::now()->timestamp.'sponsor.png';//generate name for image
        $img = Image::make($image_base64)->encode('jpg', 60);
        file_put_contents('assets/images/partners/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function newSponsor($formData)
    {
        $this->validate([
            'sponsor'=> ['required', 'string', 'max:255','unique:sponsors,sponsor'],
            'photo' => 'required',
            'website' => ['required','string'],
        ], $this->message);

        $fileExtension = $this->photo->getClientOriginalExtension();

        if ($this->isImage($fileExtension)) {
            $this->validate([
                'photo' => 'required|mimes:jpeg,png,gif',
            ],$this->message);
        } else {
            $this->message = 'Unsupported file type!';
        }

        if ($this->isImage($fileExtension)) {
            $sponsorLogo  = $this->uploadProductImage($formData['croped_image']);
        }

        Sponsor::create([
            'sponsor' => $this->sponsor,
            'website' => $this->website,
            'image' => $sponsorLogo,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Blog post created successfully");
    }

    public function render()
    {
        return view('livewire.website-admin.sponsors.new-sponsor-component')->layout('livewire.website-admin.layouts.app');
    }
}
