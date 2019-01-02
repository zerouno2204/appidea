<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CityTest extends DuskTestCase
{

    public function testCreateCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $city) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->clickLink('Add new')
                ->type("name", $city->name)
                ->select("province_id", $city->province_id)
                ->press('Save')
                ->assertRouteIs('admin.cities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $city->name)
                ->assertSeeIn("tr:last-child td[field-key='province']", $city->province->nome)
                ->logout();
        });
    }

    public function testEditCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->create();
        $city2 = factory('App\City')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $city, $city2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->click('tr[data-entry-id="' . $city->id . '"] .btn-info')
                ->type("name", $city2->name)
                ->select("province_id", $city2->province_id)
                ->press('Update')
                ->assertRouteIs('admin.cities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $city2->name)
                ->assertSeeIn("tr:last-child td[field-key='province']", $city2->province->nome)
                ->logout();
        });
    }

    public function testShowCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $city) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->click('tr[data-entry-id="' . $city->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $city->name)
                ->assertSeeIn("td[field-key='province']", $city->province->nome)
                ->logout();
        });
    }

}
