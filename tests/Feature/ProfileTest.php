<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_see_profile()  {
        $user = User::create([
            'email' => 'email2@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email2@gmail.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->get('/dashboard/profile')
            ->assertSuccessful()
            ->assertSeeLivewire('dashboard.profile');
    }

    /** @test */
    function can_update_profile()  {
        $user = User::create([
            'email' => 'email1@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email1@gmail.com',
            'password' => 'password',
        ]);

        Livewire::actingAs($user)
            ->test('dashboard.profile')
            ->set('name', 'newname')
            ->set('email', 'newemail@mail.com')
            ->call('save');

        $user->refresh();
        
        $this->assertEquals('newname', $user->name);
        $this->assertEquals('newemail@mail.com', $user->email);
    }
    
    /** @test */
    function user_name_lt_char()  {
        $user = User::create([
            'email' => 'email4@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email4@gmail.com',
            'password' => 'password',
        ]);

        Livewire::actingAs($user)
            ->test('dashboard.profile')
            ->set('name', str_repeat('a', 20))
            ->set('email', 'newemail@mail.com')
            ->call('save')
            ->assertHasErrors(['username'=> 'max']);
    }
}
