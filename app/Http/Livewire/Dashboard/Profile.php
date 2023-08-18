<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $about;
    public $saved;

    function mount()  {
        $user = auth()->user();
        $this->name = $user->name; 
        $this->about = $user->about; 
    }

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
        // $this->emitSelf('notify-saved');    
        $this->dispatchBrowserEvent('notify');
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
