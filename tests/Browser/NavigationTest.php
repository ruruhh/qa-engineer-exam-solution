<?php

namespace Tests\Browser;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavigationTest extends DuskTestCase
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

    public function testNavigation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(Admin::find(1))
                ->visit('/product')
                ->assertSee('List')
                ->press('@create-nav-button')
                ->assertPathIs('/product/form')
                ->press('@videos-nav-button')
                ->assertPathIs('/videos')
                ->press('@list-nav-button')
                ->assertPathIs('/product');
        });
    }
}
