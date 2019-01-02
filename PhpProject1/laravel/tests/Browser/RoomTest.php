<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RoomTest extends DuskTestCase
{

    public function testCreateRoom()
    {
        $admin = \App\User::find(1);
        $room = factory('App\Room')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $room) {
            $browser->loginAs($admin)
                ->visit(route('admin.rooms.index'))
                ->clickLink('Add new')
                ->type("descrizione", $room->descrizione)
                ->type("prezzo", $room->prezzo)
                ->type("p_letto", $room->p_letto)
                ->select("id_hotel_id", $room->id_hotel_id)
                ->press('Save')
                ->assertRouteIs('admin.rooms.index')
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $room->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='prezzo']", $room->prezzo)
                ->assertSeeIn("tr:last-child td[field-key='p_letto']", $room->p_letto)
                ->assertSeeIn("tr:last-child td[field-key='id_hotel']", $room->id_hotel->nome)
                ->logout();
        });
    }

    public function testEditRoom()
    {
        $admin = \App\User::find(1);
        $room = factory('App\Room')->create();
        $room2 = factory('App\Room')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $room, $room2) {
            $browser->loginAs($admin)
                ->visit(route('admin.rooms.index'))
                ->click('tr[data-entry-id="' . $room->id . '"] .btn-info')
                ->type("descrizione", $room2->descrizione)
                ->type("prezzo", $room2->prezzo)
                ->type("p_letto", $room2->p_letto)
                ->select("id_hotel_id", $room2->id_hotel_id)
                ->press('Update')
                ->assertRouteIs('admin.rooms.index')
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $room2->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='prezzo']", $room2->prezzo)
                ->assertSeeIn("tr:last-child td[field-key='p_letto']", $room2->p_letto)
                ->assertSeeIn("tr:last-child td[field-key='id_hotel']", $room2->id_hotel->nome)
                ->logout();
        });
    }

    public function testShowRoom()
    {
        $admin = \App\User::find(1);
        $room = factory('App\Room')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $room) {
            $browser->loginAs($admin)
                ->visit(route('admin.rooms.index'))
                ->click('tr[data-entry-id="' . $room->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='descrizione']", $room->descrizione)
                ->assertSeeIn("td[field-key='prezzo']", $room->prezzo)
                ->assertSeeIn("td[field-key='p_letto']", $room->p_letto)
                ->assertSeeIn("td[field-key='id_hotel']", $room->id_hotel->nome)
                ->logout();
        });
    }

}
