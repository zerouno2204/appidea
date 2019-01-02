<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProvinceTest extends DuskTestCase
{

    public function testCreateProvince()
    {
        $admin = \App\User::find(1);
        $province = factory('App\Province')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $province) {
            $browser->loginAs($admin)
                ->visit(route('admin.provinces.index'))
                ->clickLink('Add new')
                ->type("nome", $province->nome)
                ->type("slug", $province->slug)
                ->press('Save')
                ->assertRouteIs('admin.provinces.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $province->nome)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $province->slug)
                ->logout();
        });
    }

    public function testEditProvince()
    {
        $admin = \App\User::find(1);
        $province = factory('App\Province')->create();
        $province2 = factory('App\Province')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $province, $province2) {
            $browser->loginAs($admin)
                ->visit(route('admin.provinces.index'))
                ->click('tr[data-entry-id="' . $province->id . '"] .btn-info')
                ->type("nome", $province2->nome)
                ->type("slug", $province2->slug)
                ->press('Update')
                ->assertRouteIs('admin.provinces.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $province2->nome)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $province2->slug)
                ->logout();
        });
    }

    public function testShowProvince()
    {
        $admin = \App\User::find(1);
        $province = factory('App\Province')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $province) {
            $browser->loginAs($admin)
                ->visit(route('admin.provinces.index'))
                ->click('tr[data-entry-id="' . $province->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $province->nome)
                ->assertSeeIn("td[field-key='slug']", $province->slug)
                ->logout();
        });
    }

}
