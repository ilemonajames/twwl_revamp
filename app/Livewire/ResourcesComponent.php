<?php

namespace App\Livewire\WebsiteAdmin\Resources;

use Livewire\Component;
use App\Models\Resource; // Assuming you have a Resource model
use Livewire\WithPagination;

class ResourcesComponent extends Component
{
    protected $listeners = ['delete-confirmed' => 'deleteResource'];

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $resource;
    public $selResource;

    use WithPagination;

    public function mount()
    {
        $this->paginate = 10;
    }

    // Get records of resources
    public function getResources()
    {
        $resources = Resource::query()
            ->where(function ($query) {
                if ($this->searchTerm) {
                    $query->where('title', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
                }
            })
            ->latest()->paginate($this->paginate);
        return $resources;
    }

    public function clearSearch()
    {
        $this->searchTerm = "";
    }

    public function setResource(Resource $resource)
    {
        $this->resource = $resource;
        $this->selResource = $resource;
    }

    // Delete Resource
    public function deleteResource()
    {
        $resource = Resource::find($this->actionId);
        if ($resource) {
            unlink('guest/images/uploads/' . $resource->image); // Adjust path as necessary
        }
        $resource->delete();
        $this->dispatch('feedback', ['feedback' => 'Resource Successfully Deleted']);
    }

    // Set action id for deletion
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    public function render()
    {
        $resources = $this->getResources();
        return view('livewire.website-admin.resources.resources-component', compact('resources'))
            ->layout('livewire.website-admin.layouts.app');
    }
}
