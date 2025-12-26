<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Userindex extends Component
{
    public function render()
    {
        $users = User::orderBy('id')
            ->get();
        return view('livewire.users.userindex', compact('users'))
            ->layout('components.master');
    }
}
