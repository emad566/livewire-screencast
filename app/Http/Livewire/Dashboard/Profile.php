<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    protected $listeners = ['notify-saved'=>'$refresh'];
    public $name;
    public $about;
    public $imgSrc ='';
    public $newAvatar ='';
    public $birthday = null;

    function mount()  {
        $user = auth()->user();
        $this->name = $user->name;
        $this->about = $user->about;
        $this->imgSrc = Storage::disk('avatars')->url(auth()->user()->avatar);
        $this->birthday = optional(auth()->user()->birthday)->format('m/d/Y');
    }

    function updatedNewAvatar()
    {
       $this->validate([
            'newAvatar' => 'image|max:1024'
        ]);

        $fileName = $this->newAvatar->store('/', 'avatars');
        auth()->user()->update(['avatar'=>$fileName]);
        $this->imgSrc = Storage::disk('avatars')->url(auth()->user()->avatar);


    }
    public function save()
    {

        $data = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|min:24|max:100',
            'birthday' => 'sometimes',
            'newAvatar' => 'image|max:1024'
        ]);
        auth()->user()->update([
            'name' => $this->name,
            'about' => $this->about,
            'birthday' => $this->birthday,
        ]);

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
