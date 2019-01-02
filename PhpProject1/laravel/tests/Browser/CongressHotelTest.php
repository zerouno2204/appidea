<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CongressHotelTest extends DuskTestCase
{

    public function testCreateCongressHotel()
    {
        $admin = \App\User::find(1);
        $congress_hotel = factory('App\CongressHotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress_hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_hotels.index'))
                ->clickLink('Add new')
                ->select("id_congress_id", $congress_hotel->id_congress_id)
                ->select("id_hotel_id", $congress_hotel->id_hotel_id)
                ->press('Save')
                ->assertRouteIs('admin.congress_hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $congress_hotel->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_hotel']", $congress_hotel->id_hotel->nome)
                ->logout();
        });
    }

    public function testEditCongressHotel()
    {
        $admin = \App\User::find(1);
        $congress_hotel = factory('App\CongressHotel')->create();
        $congress_hotel2 = factory('App\CongressHotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress_hotel, $congress_hotel2) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_hotels.index'))
                ->click('tr[data-entry-id="' . $congress_hotel->id . '"] .btn-info')
                ->select("id_congress_id", $congress_hotel2->id_congress_id)
                ->select("id_hotel_id", $congress_hotel2->id_hotel_id)
                ->press('Update')
                ->assertRouteIs('admin.congress_hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $congress_hotel2->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_hotel']", $congress_hotel2->id_hotel->nome)
                ->logout();
        });
    }

    public function testShowCongressHotel()
    {
        $admin = \App\User::find(1);
        $congress_hotel = factory('App\CongressHotel')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $congress_hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_hotels.index'))
                ->click('tr[data-entry-id="' . $congress_hotel->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='id_congress']", $congress_hotel->id_congress->nome)
                ->assertSeeIn("td[field-key='id_hotel']", $congress_hotel->id_hotel->nome)
                ->logout();
        });
    }

}
