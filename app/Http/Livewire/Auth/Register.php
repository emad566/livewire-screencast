<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;

    public function updatedEmail()
    {
        $data = $this->validate([
            'email' => 'required|min:11|max:20|email|unique:users,email',
        ]);
    }

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|max:24|unique:users,name',
            'email' => 'required|min:11|max:20|email|unique:users,email',
            'password' => 'required|min:3|max:8|required_with:passwordConfirmation|same:passwordConfirmation',
            'passwordConfirmation' => 'min:3|max:8',
        ]);

        $user = User::create([
            'email'=> $data['email'],
            'name'=> $data['name'],
            'password'=> $data['password'],
        ]);

        auth()->login($user);
        return redirect('/');
//        return $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
