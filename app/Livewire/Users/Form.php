<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Form extends Component
{
    public ?User $user = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $role = 'client';

    public function mount(User $user = null)
    {
        if ($user && $user->exists) {
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles->first()->slug ?? 'client';
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user?->id)],
            'role' => 'required|exists:roles,slug',
        ];

        if (!$this->user) {
            $rules['password'] = 'required|min:8';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->user) {
            $this->user->update($data);
            $user = $this->user;
        } else {
            $user = User::create($data);
        }

        $user->roles()->sync([Role::where('slug', $this->role)->first()->id]);

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.users.form', [
            'roles' => Role::all(),
        ]);
    }
}
