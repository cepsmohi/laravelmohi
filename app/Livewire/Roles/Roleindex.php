<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Traits\RoleTrait;
use Livewire\Component;

class Roleindex extends Component
{
    use RoleTrait;

    public function render()
    {
        $roles = Role::orderBy('id')
            ->get();
        return view('livewire.roles.roleindex', compact('roles'))
            ->layout('components.master');
    }
}
