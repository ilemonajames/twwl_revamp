<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class GuestNavigation extends Component
{
    protected $listeners = ['refreshComponent' => 'refresh'];

    public function render()
    {
        return view('livewire.guest.guest-navigation');
    }
}
