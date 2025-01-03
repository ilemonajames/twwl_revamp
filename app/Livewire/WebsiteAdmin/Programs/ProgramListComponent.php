<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Program;

class ProgramListComponent extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh']; // Add a listener to refresh the component

    public function deleteProgram($id)
    {
        \Log::info("Delete function triggered with ID: $id");
    
        $program = Program::find($id);
    
        if ($program) {
            \Log::info("Program found: {$program->program_title}");
    
            if ($program->program_image && file_exists(public_path('guest/images/uploads/' . $program->program_image))) {
                unlink(public_path('guest/images/uploads/' . $program->program_image));
                \Log::info("Program image deleted: {$program->program_image}");
            }
    
            $program->delete();
            \Log::info("Program deleted successfully.");
            session()->flash('message', 'Program deleted successfully.');

            return redirect()->to('/website-admin/programs');// Emit an event to refresh the component
        } else {
            \Log::info("Program not found.");
            session()->flash('error', 'Program not found.');
        }
    }
    
    public function render()
    {
        return view('livewire.website-admin.programs.program-list-component', [
            'programs' => Program::orderBy('created_at', 'desc')->paginate(10) // Adjust the pagination count as needed
        ])->layout('livewire.website-admin.layouts.app');
    }
}
