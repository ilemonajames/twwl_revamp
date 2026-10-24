<?php

namespace App\Livewire\WebsiteAdmin\Users;

use App\Livewire\WebsiteAdmin\AdminComponent;
use App\Models\User;
use Livewire\WithPagination;

class UsersComponent extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public string $search = '';
    public string $type = 'Client';

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedType(): void { $this->resetPage(); }

    public function render()
    {
        $search = mb_substr(trim($this->search), 0, 255);
        $users = User::query()
            ->select(['id', 'surname', 'othernames', 'email', 'phoneno', 'user_type', 'status', 'email_verified_at', 'password_setup_required', 'preferred_service_id', 'preferred_program_id', 'created_at'])
            ->with(['preferredService:id,service_title', 'preferredProgram:id,program_title'])
            ->when(in_array($this->type, ['Client', 'Website Admin', 'Super Admin'], true), fn ($query) => $query->where('user_type', $this->type))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    foreach (['surname', 'othernames', 'email', 'phoneno'] as $index => $column) {
                        $query->{$index === 0 ? 'where' : 'orWhere'}($column, 'like', '%'.$search.'%');
                    }
                });
            })->latest()->orderBy('id')->paginate(15);

        return view('livewire.website-admin.users.users-component', compact('users'))
            ->layout('livewire.website-admin.layouts.app');
    }
}
