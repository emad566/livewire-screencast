<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class HelloWorld extends Component
{
    public $name = 'Jelly';
    public $loud = true;
    public $greating = '';
    public $greatings = [];


    public  function resetName($name)
    {
        $this->name = $name;
    }

    public  function mount(Request $request, $name)
    {
        $this->name = $request->input('name', $name);
    }

    public  function hydrate()
    {
        $this->name = 'hydrate';
    }

    public  function updated($name)
    {
        $this->name = "updated $name";
    }

    public  function updatedName()
    {
        $this->name = "updatedName";
    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
