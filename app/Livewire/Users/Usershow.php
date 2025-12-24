<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Traits\RoleTrait;
use App\Traits\SessionTrait;
use Livewire\Component;

class Usershow extends Component
{
    use RoleTrait;
    use SessionTrait;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.users.usershow')
            ->layout('components.master');
    }
}
