<?php

namespace App\Livewire\WebsiteAdmin\Blogs;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Image;
class NewBlogComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $photo;

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
            'title'=> ['required', 'string', 'max:255','unique:blogs,blog_title'],
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
        file_put_contents('guest/images/uploads/'.$postImage, $img->stream()->__toString());

        return $postImage;
    }

    public function newBlog($formData)
    {
        $this->validate([
            'title'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
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
            $blogImageName  = $this->uploadProductImage($formData['croped_image']);
        }else{
            $blogImageName = Carbon::now()->timestamp. '.' . $this->photo->getClientOriginalName(); //generates name for the news image
            $this->photo->storeAs('/blogs',$blogImageName);
        }

        $blog = Blog::create([
            'blog_title' => $this->title,
            'description' => $this->description,
            'image' => $blogImageName,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->dispatch('feedback', feedback: "Blog post created successfully");
    }

    public function render()
    {
        return view('livewire.website-admin.blogs.new-blog-component')->layout('livewire.website-admin.layouts.app');
    }
}
