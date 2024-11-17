<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Program;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EditProgramComponent extends Component
{
    public $description;
    public $title;
    public $photo;
    public $program;
    public $croped_image; // Add croped_image as a public property
    use WithFileUploads;

    protected $messages = [
        'title.required' => "Please enter your program title",
        'description.required' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "Image must have a minimum width of 860px and height of 500px",
    ];

    public function mount($id){
        $this->program = Program::findOrFail($id);
        $this->title = $this->program->program_title;
        $this->description = $this->program->program_description;
    }

    // Service modification
    public function updateService(){
        // Validate inputs
        $this->validate([
            'title' => ['required', 'string', 'max:255', 'unique:programs,program_title,' . $this->program->id],
            'description' => ['required', 'string'],
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif',
            'croped_image' => 'nullable|string',
        ], $this->messages);

        // Update program image if a new cropped image is provided
        if ($this->croped_image) {
            // Delete the old image if it exists
            if ($this->program->program_image && Storage::disk('do')->exists("guest/images/uploads/{$this->program->program_image}")) {
                Storage::disk('do')->delete("guest/images/uploads/{$this->program->program_image}");
            }

            // Upload the new image
            $programPhoto = $this->uploadProductImage($this->croped_image);
            $this->program->update(['program_image' => $programPhoto]);
        }

        // Update program details
        $this->program->update([
            'program_title' => $this->title,
            'program_description' => $this->description,
        ]);

        // Redirect with feedback
        return redirect()->route('programs.index')->with('feedback', 'Program successfully updated');
    }

    // Upload service image
    public function uploadProductImage($image)
    {
        try {
            $image_parts = explode(";base64,", $image);
            $image_base64 = base64_decode($image_parts[1]);
            $postImageName = Carbon::now()->timestamp . '_service.jpg';

            // Process image using Intervention Image
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
        return view('livewire.website-admin.programs.edit-program-component')
            ->layout('livewire.website-admin.layouts.app');
    }
}
