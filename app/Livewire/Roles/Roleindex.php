<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;

class Roleindex extends Component
{
    public function render()
    {
        $roles = Role::orderBy('id')
            ->get();
        return view('livewire.roles.roleindex', compact('roles'))
            ->layout('components.master');
    }
}
