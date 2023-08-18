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
            'about' => 'about',
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
            'about' => 'about',   
            'password' => 'password',
        ]);

        Livewire::actingAs($user)
            ->test('dashboard.profile')
            ->set('name', 'newname')
            ->set('about', str_repeat('newabout', 5))
            ->call('save');

        $user->refresh();
        
        $this->assertEquals('newname', $user->name);
        $this->assertEquals(str_repeat('newabout', 5), $user->about);
    }
    
    /** @test */
    function user_name_lt_char()  {
        $user = User::create([
            'email' => 'email4@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email4@gmail.com',
            'about' => 'about',
            'password' => 'password',
        ]);

        Livewire::actingAs($user)
            ->test('dashboard.profile')
            ->set('name', str_repeat('a', 26))
            ->set('about', str_repeat('newabout', 5))
            ->call('save')
            ->assertHasErrors(['name'=> 'max']);
    }

    function message_is_shown_save(){
        $user = User::create([
            'email' => 'email43@gmail.com',
            'email_verified_at' => now(),
            'name' => 'email43@gmail.com',
            'about' => 'about',
            'password' => 'password',
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->call('save')
            ->assertDispatchedBrowserEvent('notify');
            // ->assertEmitted('notify-saved');
    }
}
