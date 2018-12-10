<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class HotelTest extends DuskTestCase
{

    public function testCreateHotel()
    {
        $admin = \App\User::find(1);
        $hotel = factory('App\Hotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.hotels.index'))
                ->clickLink('Add new')
                ->type("nome", $hotel->nome)
                ->type("lat", $hotel->lat)
                ->type("lng", $hotel->lng)
                ->type("indirizzo", $hotel->indirizzo)
                ->type("cap", $hotel->cap)
                ->select("citta_id", $hotel->citta_id)
                ->select("provincia_id", $hotel->provincia_id)
                ->type("descrizione", $hotel->descrizione)
                ->press('Save')
                ->assertRouteIs('admin.hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $hotel->nome)
                ->assertSeeIn("tr:last-child td[field-key='lat']", $hotel->lat)
                ->assertSeeIn("tr:last-child td[field-key='lng']", $hotel->lng)
                ->assertSeeIn("tr:last-child td[field-key='indirizzo']", $hotel->indirizzo)
                ->assertSeeIn("tr:last-child td[field-key='cap']", $hotel->cap)
                ->assertSeeIn("tr:last-child td[field-key='citta']", $hotel->citta->name)
                ->assertSeeIn("tr:last-child td[field-key='provincia']", $hotel->provincia->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $hotel->descrizione)
                ->logout();
        });
    }

    public function testEditHotel()
    {
        $admin = \App\User::find(1);
        $hotel = factory('App\Hotel')->create();
        $hotel2 = factory('App\Hotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $hotel, $hotel2) {
            $browser->loginAs($admin)
                ->visit(route('admin.hotels.index'))
                ->click('tr[data-entry-id="' . $hotel->id . '"] .btn-info')
                ->type("nome", $hotel2->nome)
                ->type("lat", $hotel2->lat)
                ->type("lng", $hotel2->lng)
                ->type("indirizzo", $hotel2->indirizzo)
                ->type("cap", $hotel2->cap)
                ->select("citta_id", $hotel2->citta_id)
                ->select("provincia_id", $hotel2->provincia_id)
                ->type("descrizione", $hotel2->descrizione)
                ->press('Update')
                ->assertRouteIs('admin.hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $hotel2->nome)
                ->assertSeeIn("tr:last-child td[field-key='lat']", $hotel2->lat)
                ->assertSeeIn("tr:last-child td[field-key='lng']", $hotel2->lng)
                ->assertSeeIn("tr:last-child td[field-key='indirizzo']", $hotel2->indirizzo)
                ->assertSeeIn("tr:last-child td[field-key='cap']", $hotel2->cap)
                ->assertSeeIn("tr:last-child td[field-key='citta']", $hotel2->citta->name)
                ->assertSeeIn("tr:last-child td[field-key='provincia']", $hotel2->provincia->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $hotel2->descrizione)
                ->logout();
        });
    }

    public function testShowHotel()
    {
        $admin = \App\User::find(1);
        $hotel = factory('App\Hotel')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.hotels.index'))
                ->click('tr[data-entry-id="' . $hotel->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $hotel->nome)
                ->assertSeeIn("td[field-key='lat']", $hotel->lat)
                ->assertSeeIn("td[field-key='lng']", $hotel->lng)
                ->assertSeeIn("td[field-key='indirizzo']", $hotel->indirizzo)
                ->assertSeeIn("td[field-key='cap']", $hotel->cap)
                ->assertSeeIn("td[field-key='citta']", $hotel->citta->name)
                ->assertSeeIn("td[field-key='provincia']", $hotel->provincia->nome)
                ->assertSeeIn("td[field-key='descrizione']", $hotel->descrizione)
                ->logout();
        });
    }

}
