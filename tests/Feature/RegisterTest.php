<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registration_page_contains_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    /** @test */
    function can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'emade09@gmail.com')
            ->set('email', 'emade09@gmail.com')
            ->set('password', '123456')
            ->set('passwordConfirmation', '123456')
            ->call('register')
            ->assertRedirect('/');

        User::whereEmail('emade09@gmail.com')->update(['email_verified_at'=>now()]);

        $this->assertTrue(User::whereEmail('emade09@gmail.com')->exists());
        $this->assertEquals('emade09@gmail.com', auth()->user()?->email);
    }

    /** @test */
    function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', '')
            ->set('name', 'ffer')
            ->set('password', '123456')
            ->set('passwordConfirmation', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('email', 'emade09')
            ->set('name', 'emade09')
            ->set('password', '123456')
            ->set('passwordConfirmation', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_hasnt_been_taken_already()
    {
        User::create([
            'email' => 'email2@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email2@gmail.com',
            'password' => 'password',
        ]);

        Livewire::test('auth.register')
            ->set('email', 'email2@gmail.com')
            ->set('name', 'email2@gmail.com')
            ->set('password', '123456')
            ->set('passwordConfirmation', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        User::create([
            'email' => 'email3@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email3@gmail.com',
            'password' => 'password',
        ]);

        Livewire::test('auth.register')
            ->set('email', 'email4@gmail.com')
            ->assertHasNoErrors()
            ->set('email', 'email3@gmail.com')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', 'emade09@gmail.com')
            ->set('name', 'emade09@gmail.com')
            ->set('password', '')
            ->set('passwordConfirmation', '123456')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_characters()
    {
        Livewire::test('auth.register')
            ->set('email', 'emade09@gmail.com')
            ->set('name', 'emade09@gmail.com')
            ->set('password', 'se')
            ->set('passwordConfirmation', 'sec')
            ->call('register')
            ->assertHasErrors(['password' => 'min:3']);
    }

    /** @test */
    function password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('email', 'emade09@gmail.com')
            ->set('name', 'emade09@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'not-secret')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}

