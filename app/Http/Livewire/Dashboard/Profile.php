<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email;

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|unique:users,name,id'. auth()->user()->id,
            'email' => 'required|min:11|max:20|email|unique:users,email,id'. auth()->user()->id,
        ]);

        auth()->user()->update([
            'name'=>$this->name,
            'email'=>$this->email,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
