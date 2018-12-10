<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ImageTest extends DuskTestCase
{

    public function testCreateImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $image) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->clickLink('Add new')
                ->type("nome", $image->nome)
                ->press('Save')
                ->assertRouteIs('admin.images.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $image->nome)
                ->logout();
        });
    }

    public function testEditImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->create();
        $image2 = factory('App\Image')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $image, $image2) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->click('tr[data-entry-id="' . $image->id . '"] .btn-info')
                ->type("nome", $image2->nome)
                ->press('Update')
                ->assertRouteIs('admin.images.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $image2->nome)
                ->logout();
        });
    }

    public function testShowImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $image) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->click('tr[data-entry-id="' . $image->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $image->nome)
                ->logout();
        });
    }

}
