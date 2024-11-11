<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Program;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewProgramComponent extends Component
{
    public $description;
    public $title;
    public $photo;
    use WithFileUploads;

    protected $messages = [
        'title.required' => "Please enter your program title",
        'description.required' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "Image must have a minimum width of 860px and height of 500px",
        'photo.mimes' => "Only jpeg, jpg, png, and gif formats are allowed",
    ];

    public function newService($formData)
    {
        try {
            // Log MIME type of the photo to help with debugging if needed
            if ($this->photo) {
                Log::info('Photo MIME type: ' . $this->photo->getMimeType());
            }

            // Validate input fields
            $this->validate([
                'title' => ['required', 'string', 'max:255', 'unique:programs,program_title'],
                'description' => ['required', 'string'],
                'photo' => 'required|mimetypes:image/jpeg,image/png,image/gif|dimensions:min_width=860,min_height=500',
            ], $this->messages);

            // Process the uploaded image
            $servicePhoto = $this->uploadProductImage($formData['croped_image']);

            // Create new Program
            Program::create([
                'program_title' => $this->title,
                'program_description' => $this->description,
                'program_image' => $servicePhoto,
            ]);

            // Reset inputs and dispatch success feedback
            $this->reset();
            $this->dispatch('feedback', ['feedback' => "Program successfully added"]);

        } catch (\Exception $e) {
            Log::error($e);
            $this->dispatch('feedback', ['feedback' => "An error occurred: " . $e->getMessage()]);
        }
    }

    public function uploadProductImage($image)
{
    try {
        // Decode the base64 image
        $image_parts = explode(";base64,", $image);
        if (count($image_parts) < 2) {
            throw new \Exception("Invalid image data.");
        }
        
        $image_base64 = base64_decode($image_parts[1]);
        if ($image_base64 === false) {
            throw new \Exception("Image decoding failed.");
        }

        // Process image using Intervention Image
        $postImageName = Carbon::now()->timestamp . '_service.jpg';
        $img = Image::make($image_base64)->encode('jpg', 60);

        // Save the image to storage using Laravel Storage
        Storage::put("guest/images/uploads/{$postImageName}", $img->stream());

        return $postImageName;
    } catch (\Exception $e) {
        Log::error("Image upload failed: " . $e->getMessage());
        throw new \Exception("Failed to upload image.");
    }
}


    public function render()
    {
        return view('livewire.website-admin.programs.new-program-component')
            ->layout('livewire.website-admin.layouts.app');
    }
}
