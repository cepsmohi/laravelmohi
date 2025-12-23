<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Usercreate extends Component
{
    public $name, $email, $phone;

    public function createUser()
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('users', 'email'),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'phone'),
            ],
        ], [
            'email.unique' => 'Email is registered.',
            'phone.unique' => 'Phone is registered.',
        ]);
        $data['password'] = Hash::make($data['phone']);
        User::create($data);
        session()->flash('success', 'User created successfully.');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.users.usercreate')
            ->layout('components.master');
    }
}
