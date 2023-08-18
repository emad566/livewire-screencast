<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Profile extends Component
{
    protected $listeners = ['notify-saved'=>'$refresh'];
    public $name;
    public $about;
    public $birthday = null;

    function mount()  {
        $user = auth()->user();
        $this->name = $user->name; 
        $this->about = $user->about; 
        $this->birthday = optional(auth()->user()->birthday)->format('m/d/Y');
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|min:24|max:100',
            'birthday' => 'sometimes',
        ]);

        auth()->user()->update($data);
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
