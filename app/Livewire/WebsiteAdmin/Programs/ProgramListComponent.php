<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use App\Livewire\WebsiteAdmin\AdminComponent as Component;
use App\Models\Program;
use Livewire\WithPagination;

class ProgramListComponent extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh']; // Add a listener to refresh the component

    public function deleteProgram($id)
    {
        abort_unless(auth()->user()?->status === 'Active'
            && auth()->user()?->hasVerifiedEmail()
            && in_array(auth()->user()?->user_type, ['Website Admin', 'Super Admin'], true), 403);
        app(\App\Services\CatalogDeletionService::class)->program($id);

        return redirect()->route('programs.index')->with('feedback', 'Program deleted successfully.');
    }

    public function render()
    {
        return view('livewire.website-admin.programs.program-list-component', [
            'programs' => Program::orderBy('created_at', 'desc')->paginate(10), // Adjust the pagination count as needed
        ])->layout('livewire.website-admin.layouts.app');
    }
}
