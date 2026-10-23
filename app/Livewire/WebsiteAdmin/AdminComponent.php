<?php

namespace App\Livewire\WebsiteAdmin;

abstract class AdminComponent extends \Livewire\Component
{
    public function boot(): void
    {
        abort_unless(auth()->user()?->status === 'Active'
            && auth()->user()?->hasVerifiedEmail()
            && in_array(auth()->user()?->user_type, ['Website Admin', 'Super Admin'], true), 403);
    }
}
