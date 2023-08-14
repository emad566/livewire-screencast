<?php

namespace App\Http\Livewire;

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
    public function render()
    {
        return view('livewire.hello-world');
    }
}
