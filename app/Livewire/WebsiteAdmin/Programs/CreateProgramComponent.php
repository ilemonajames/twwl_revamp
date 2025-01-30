<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Program;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CreateProgramComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $program_content;
    public $photo;
    public $croped_image; // To hold the cropped image data

    protected $rules = [
        'title' => 'required|string|max:255|unique:programs,program_title',
        'description' => 'required|string',
        'program_content'=>'required|string',
        'photo' => 'required|mimes:jpeg,jpg,png,gif|max:2048|dimensions:min_width=860,min_height=500',
        'croped_image' => 'nullable|string', // To validate cropped image data
    ];

    protected $messages = [
        'title.required' => "Please enter your program title",
        'program_content'=>"Please enter program detailed content",
        'description.required' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "Image must be at least 860px wide and 500px tall",
    ];

    public function createService()
    {
        $this->validate();

        try {
            // Process and upload the cropped image
            $servicePhoto = $this->uploadProductImage($this->croped_image);

            // Create new program entry
            Program::create([
                'program_title' => $this->title,
                'program_description' => $this->description,
                'program_content'=> $this->program_content,
                'program_image' => $servicePhoto,
            ]);

            // Reset inputs and flash success message
            $this->reset();
            session()->flash('message', 'Program successfully created.');
        } catch (\Exception $e) {
            \Log::error("Error creating program: " . $e->getMessage());
            session()->flash('error', 'An error occurred while creating the program.');
        }
    }

    public function uploadProductImage($image)
    {
        try {
            // Decode base64 image
            $image_parts = explode(";base64,", $image);
            if (count($image_parts) < 2) {
                throw new \Exception("Invalid image data.");
            }
            $image_base64 = base64_decode($image_parts[1]);
            if ($image_base64 === false) {
                throw new \Exception("Image decoding failed.");
            }

            $postImageName = Carbon::now()->timestamp . '_service.jpg';
            $img = Image::make($image_base64)->encode('jpg', 60);

            // Save the image to DigitalOcean Spaces
            Storage::disk('do')->put("guest/images/uploads/{$postImageName}", $img->stream());

            return $postImageName;
        } catch (\Exception $e) {
            \Log::error("Image upload failed: " . $e->getMessage());
            throw new \Exception("Failed to upload image.");
        }
    }

    public function render()
    {
        return view('livewire.website-admin.programs.create-program-component')
            ->layout('livewire.website-admin.layouts.app');
    }
}
