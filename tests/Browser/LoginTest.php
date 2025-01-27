<?php
namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /** @test */
    public function user_can_see_login_form()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/login') // Navigate to the login page
            ->assertSee('Email'); // Check if the 'Login' text is present
        });
    }
    /** @test */
    public function user_can_login()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/login')
                ->type('email', 'user@example.com') // Type email in the email input field
                ->type('password', 'password123') // Type password in the password input field
                ->press('Login') // Press the login button
                ->waitForLocation('/dashboard')
                ->assertPathIs('/dashboard') // Assert the user is redirected to the dashboard
                ->assertSee('Welcome'); // Check if 'Welcome' is displayed on the dashboard page

        });
    }
}

