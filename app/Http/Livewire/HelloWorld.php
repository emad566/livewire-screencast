<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public $count = 0;

    public function inc(){
        $this->count++;
    }

    public function dec(){
        $this->count--;
    }

    public function zero(){
        $this->count--;
    }

    public function render()
    {
        return view('livewire.hello-world', [
            'name'=> 'jelly',
        ]);
    }
}
