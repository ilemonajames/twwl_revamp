<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Program;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EditProgramComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $photo;
    public $program;
    public $croped_image; // To hold the cropped image data

    protected $rules = [
        'title' => 'required|string|max:255|unique:programs,program_title,{{ $program->id }}',
        'description' => 'required|string',
        'photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048|dimensions:min_width=860,min_height=500',
        'croped_image' => 'nullable|string',
    ];

    public function mount($id)
    {
        $this->program = Program::findOrFail($id);
        $this->title = $this->program->program_title;
        $this->description = $this->program->program_description;
    }

    public function updateService()
    {
        $this->validate();

        try {
            if ($this->croped_image) {
                // Delete the old image if it exists
                if ($this->program->program_image && Storage::disk('do')->exists("guest/images/uploads/{$this->program->program_image}")) {
                    Storage::disk('do')->delete("guest/images/uploads/{$this->program->program_image}");
                }

                // Upload the new cropped image
                $programPhoto = $this->uploadProductImage($this->croped_image);
                $this->program->program_image = $programPhoto;
            }

            $this->program->program_title = $this->title;
            $this->program->program_description = $this->description;
            $this->program->save();

            session()->flash('message', 'Program successfully updated.');
        } catch (\Exception $e) {
            \Log::error("Error updating program: " . $e->getMessage());
            session()->flash('error', 'An error occurred while updating the program.');
        }
    }

    public function uploadProductImage($image)
    {
        try {
            $image_parts = explode(";base64,", $image);
            $image_base64 = base64_decode($image_parts[1]);
            $postImageName = Carbon::now()->timestamp . '_service.jpg';

            $img = Image::make($image_base64)->encode('jpg', 60);
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
