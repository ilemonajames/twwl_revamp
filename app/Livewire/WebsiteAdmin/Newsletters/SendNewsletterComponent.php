<?php

namespace App\Livewire\WebsiteAdmin\Newsletters;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Models\NewsletterSubscriber;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class SendNewsletterComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $photo;
    public $file;

    public $message = [
        'title.required' => "Please provide your title",
        'description.required' => "Please provide your description",
        'photo.required' => "Please upload a image",
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
            'title'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            // 'photo' => 'required',
            // 'file' => 'required',
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
        $postImage = Carbon::now()->timestamp.'newsletter.png';//generate name for image
        $img = Image::make($image_base64)->encode('jpg', 60);
        file_put_contents('guest/images/uploads/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function sendNewsletter($formData)
    {
        $newsletterName = null;
        $newsletterAttachement = null;

        $this->validate([
            'title'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            // 'photo' => 'required',
            // 'file' => 'required',
        ], $this->message);

        if($this->photo){
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
                $newsletterName  = $this->uploadProductImage($formData['croped_image']);
            }else{
                $newsletterName = Carbon::now()->timestamp; //generates name for the news image
                $this->photo->storeAs('/guest/images/uploads',$newsletterName);
            }

        }

        if($this->file){
            $newsletterAttachement = Carbon::now()->timestamp. '.' . $this->file->getClientOriginalName();
            $this->file->storeAs('/uploads',$newsletterAttachement);
        }


        $newsletter = NewsLetter::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $newsletterName,
            'user_id' => Auth::user()->id,
            'file' => $newsletterAttachement,
            'user_id' => Auth::user()->id
        ]);


        $subscribers = NewsletterSubscriber::all();

        $chunkedSubscribers = $subscribers->chunk(5);
        Mail::to("ilemonaj@gmail.com")->send(new NewsletterMail($newsletter));
        if(count($subscribers)>0){
            foreach($chunkedSubscribers as $subscribers){
                $email = $subscribers->pluck('email')->toArray();

                try{
                    //Mail::to($email)->send(new NewsletterMail($newsletter));
                }catch(\Exception $e){}
            }
        }

        $this->reset();
        $this->dispatch('feedback', feedback: "Newsletter successfully sent");
    }

    public function render()
    {
        return view('livewire.website-admin.newsletters.send-newsletter-component')->layout('livewire.website-admin.layouts.app');
    }
}
