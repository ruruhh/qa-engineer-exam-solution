<?php

namespace Tests\Browser;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
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

    public function testLogout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(Admin::find(1))
                ->visit('/product')
                ->assertPathIs('/product')
                ->press('@logout-button')
                ->assertSee('Sign In');
        });
    }
}
