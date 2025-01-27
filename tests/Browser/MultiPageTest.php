<?php
namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MultiPageTest extends DuskTestCase
{
    /** @test */
    public function user_can_register_and_logout()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/register')
                ->type('first_name', 'User')
                ->type('last_name', 'Test')
                ->type('email', 'user2@example.com')
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->press('Register')
                ->pause(1000)
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard')
                ->click('@dropdown-trigger')
                ->waitFor('@logout-button')
                ->click('@logout-button')
                ->assertPathIs('/')
                ->assertSee('Festibus');
        });
    }
}
