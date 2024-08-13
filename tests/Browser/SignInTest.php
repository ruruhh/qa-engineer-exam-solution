<?php

namespace Tests\Browser;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SignInTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Admin::create([
            'name' => 'user',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);
    }

    public function testSuccessfulSignIn(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('@email-input', 'test@example.com')
                ->type('@password-input', 'password')
                ->press('@sign-in-button')
                ->assertPathIs('/product');

            $browser->logout();
        });
    }

    public function testUnsuccessfulSignIn(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('@email-input', 'test@example.com')
                ->type('@password-input', 'wrong_password')
                ->press('@sign-in-button')
                ->assertSee('These credentials do not match our records.')
                ->assertPathIs('/login');
        });
    }
}
