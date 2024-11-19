<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Program;

class ProgramListComponent extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.website-admin.programs.program-list-component', [
            'programs' => Program::orderBy('created_at', 'desc')->paginate(10) // Adjust the pagination count as needed
        ])->layout('livewire.website-admin.layouts.app');;
    }
}
