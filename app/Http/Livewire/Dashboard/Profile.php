<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $about;

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|min:24|max:100',
        ]);

        auth()->user()->update([
            'name'=>$this->name,
            'about'=>$this->about,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
