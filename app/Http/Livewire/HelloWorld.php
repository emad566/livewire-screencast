<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class HelloWorld extends Component
{
    public $contacts;

    public function mount(){
        $this->contacts = User::all();
    }

    public function removeContact($contact_id)
    {
        $contact = User::find($contact_id);
        $contact->delete();
        $this->contacts = User::all();
    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
