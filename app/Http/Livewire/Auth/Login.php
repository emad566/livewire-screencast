<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $user = User::where('email', $this->email)->first();
        if ($user && Hash::check($this->password, $user->password)) {
            auth()->login($user);
            return redirect()->route('dashboard.home');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
