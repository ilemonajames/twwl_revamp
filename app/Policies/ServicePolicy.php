<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function create(User $user): bool
    {
        return $user->status === 'Active'
            && $user->hasVerifiedEmail()
            && in_array($user->user_type, ['Website Admin', 'Super Admin'], true);
    }

    public function update(User $user, Service $service): bool
    {
        return $this->create($user);
    }

    public function delete(User $user, Service $service): bool
    {
        return $this->create($user);
    }
}
