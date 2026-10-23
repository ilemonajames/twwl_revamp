<?php

namespace App\Livewire\WebsiteAdmin\Programs;

use App\Livewire\WebsiteAdmin\AdminComponent as Component;
use App\Models\Program;
use Livewire\WithPagination;

class ProgramsComponent extends Component
{
    protected $listeners = ['delete-confirmed' => 'deleteService']; // listen to emited action

    public $paginate;

    public $actionId;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;

    public $sn;

    public $program;

    use WithPagination;

    public function index()
    {
        $this->paginate = 10;
    }

    // get record of services
    public function getProducts()
    {
        $program = Program::query()
            ->where(function ($query) {
                if ($this->searchTerm) {
                    $query->where('program_title', 'like', '%'.$this->searchTerm.'%')
                        ->orWhere('program_content', 'like', '%'.$this->searchTerm.'%')
                        ->orWhere('program_description', 'like', '%'.$this->searchTerm.'%');
                }
            })
            ->latest()->paginate($this->paginate);

        return $program;
    }

    public function clearSearch()
    {
        $this->searchTerm = '';
    }

    // delete Service
    public function deleteService()
    {
        app(\App\Services\CatalogDeletionService::class)->program($this->actionId);
        $this->dispatch('feedback', feedback: 'Program Successfully Deleted');
    }

    // set action id
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    public function setprogram(Program $program)
    {
        $this->program = $program;
    }

    public function render()
    {
        $programs = $this->getProducts();

        return view('livewire.website-admin.programs.programs-list', compact('programs'))->layout('livewire.website-admin.layouts.app');
    }
}
