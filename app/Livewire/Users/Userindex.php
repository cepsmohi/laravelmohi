<?php

namespace App\Livewire\Users;

use Livewire\Component;

class Userindex extends Component
{
    public function render()
    {
        return view('livewire.users.userindex')
            ->layout('components.master');
    }
}
