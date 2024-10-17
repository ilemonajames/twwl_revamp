<?php

namespace App\Livewire\WebsiteAdmin;

use Livewire\Component;
use App\Models\Service;
class WebsiteAdminDashbaord extends Component
{
    public function render()
    {
        $services = Service::count();
        return view('livewire.website-admin.website-admin-dashbaord',compact('services'))->layout('livewire.website-admin.layouts.app');
    }
}
