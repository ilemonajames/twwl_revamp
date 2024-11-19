<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Program;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use WithPagination;

class ProgramComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $photo;
    public $croped_image; // Holds the cropped image data
    public $program; // Holds the program being edited
    public $mode = 'create'; // Default mode is create; change to 'edit' for editing

    protected $messages = [
        'title.required' => "Please enter your program title",
        'description.required' => "Please enter your program description",
        'photo.required' => "Please upload a program image",
        'photo.dimensions' => "Image must be at least 860px wide and 500px tall",
    ];

    //display all programs

    

    public function displayPrograms()
    {
        return view('livewire.website-admin.programs.program-list-component', [
            'programs' => Program::paginate(10) // Adjust the pagination count as needed
        ]);
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->mode = 'edit';
            $this->program = Program::findOrFail($id);
            $this->title = $this->program->program_title;
            $this->description = $this->program->program_description;
        }
    }

    public function saveProgram()
    {
        $this->validate([
            'title' => 'required|string|max:255' . ($this->mode === 'edit' ? '|unique:programs,program_title,' . $this->program->id : '|unique:programs,program_title'),
            'description' => 'required|string',
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif|dimensions:min_width=860,min_height=500',
            'croped_image' => 'nullable|string', // Validates cropped image as base64 string
        ]);

        try {
            // Handle the cropped image upload if provided
            if ($this->croped_image) {
                $programPhoto = $this->uploadProductImage($this->croped_image);

                // Delete the old image for edit mode
                if ($this->mode === 'edit' && $this->program->program_image && Storage::disk('do')->exists("guest/images/uploads/{$this->program->program_image}")) {
                    Storage::disk('do')->delete("guest/images/uploads/{$this->program->program_image}");
                }

                // Set the program image for both create and edit
                $this->program_image = $programPhoto;
            }

            if ($this->mode === 'create') {
                // Create a new program record
                Program::create([
                    'program_title' => $this->title,
                    'program_description' => $this->description,
                    'program_image' => $programPhoto ?? null,
                ]);
            } else {
                // Update an existing program record
                $this->program->update([
                    'program_title' => $this->title,
                    'program_description' => $this->description,
                    'program_image' => $programPhoto ?? $this->program->program_image,
                ]);
            }

            session()->flash('message', 'Program successfully ' . ($this->mode === 'create' ? 'created' : 'updated'));
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error("Error saving program: " . $e->getMessage());
            session()->flash('error', 'An error occurred while saving the program.');
        }
    }

    // public function uploadProductImage($image)
    // {
    //     try {
    //         $image_parts = explode(";base64,", $image);
    //         if (count($image_parts) < 2) throw new \Exception("Invalid image data.");
    //         $image_base64 = base64_decode($image_parts[1]);
    //         $postImageName = Carbon::now()->timestamp . '_service.jpg';
    //         $img = Image::make($image_base64)->encode('jpg', 60);

    //         // Save to DigitalOcean Spaces
    //         Storage::disk('do')->put("guest/images/uploads/{$postImageName}", $img->stream());
    //         return $postImageName;
    //     } catch (\Exception $e) {
    //         \Log::error("Image upload failed: " . $e->getMessage());
    //         throw new \Exception("Failed to upload image.");
    //     }
    // }

    public function uploadProductImage($base64Image)
{
    try {
        // Decode base64 image
        $image_parts = explode(";base64,", $base64Image);
        if (count($image_parts) < 2) {
            throw new \Exception("Invalid base64 image data.");
        }

        $image_base64 = base64_decode($image_parts[1]);
        if (!$image_base64) {
            throw new \Exception("Failed to decode base64 image.");
        }

        // Process the image
        $imageName = Carbon::now()->timestamp . '_service.jpg';
        $img = Image::make($image_base64)->encode('jpg', 60);

        // Save to storage
        Storage::disk('do')->put("guest/images/uploads/{$imageName}", $img->stream());

        return $imageName;
    } catch (\Exception $e) {
        \Log::error("Image upload failed: " . $e->getMessage());
        throw $e; // Rethrow to show error to the user
    }
}


    public function resetForm()
    {
        $this->reset(['title', 'description', 'photo', 'croped_image']);
    }

    public function render()
    {
        return view('livewire.website-admin.programs.program-component')
            ->layout('livewire.website-admin.layouts.app');
    }
}
    