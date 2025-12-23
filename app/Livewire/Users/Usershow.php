<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Usershow extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function logoutDevice(string $sessionId)
    {
        DB::table('sessions')
            ->where('id', $sessionId)
            ->delete();

        return redirect()
            ->route('admin.users.show', $this->user)
            ->with('success', 'Device logged out successfully.');
    }


    public function render()
    {
        return view('livewire.users.usershow')
            ->layout('components.master');
    }
}
