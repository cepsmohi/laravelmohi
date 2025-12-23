<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Userindex extends Component
{
    public function render()
    {
        $users = User::where('id', '>', 1)
            ->orderBy('id')
            ->get();
        return view('livewire.users.userindex', compact('users'))
            ->layout('components.master');
    }
}
