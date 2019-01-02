<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EventTest extends DuskTestCase
{

    public function testCreateEvent()
    {
        $admin = \App\User::find(1);
        $event = factory('App\Event')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $event) {
            $browser->loginAs($admin)
                ->visit(route('admin.events.index'))
                ->clickLink('Add new')
                ->type("intervallo_orario", $event->intervallo_orario)
                ->type("nome", $event->nome)
                ->type("descrizione", $event->descrizione)
                ->select("id_sala_id", $event->id_sala_id)
                ->press('Save')
                ->assertRouteIs('admin.events.index')
                ->assertSeeIn("tr:last-child td[field-key='intervallo_orario']", $event->intervallo_orario)
                ->assertSeeIn("tr:last-child td[field-key='nome']", $event->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $event->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='id_sala']", $event->id_sala->nome)
                ->logout();
        });
    }

    public function testEditEvent()
    {
        $admin = \App\User::find(1);
        $event = factory('App\Event')->create();
        $event2 = factory('App\Event')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $event, $event2) {
            $browser->loginAs($admin)
                ->visit(route('admin.events.index'))
                ->click('tr[data-entry-id="' . $event->id . '"] .btn-info')
                ->type("intervallo_orario", $event2->intervallo_orario)
                ->type("nome", $event2->nome)
                ->type("descrizione", $event2->descrizione)
                ->select("id_sala_id", $event2->id_sala_id)
                ->press('Update')
                ->assertRouteIs('admin.events.index')
                ->assertSeeIn("tr:last-child td[field-key='intervallo_orario']", $event2->intervallo_orario)
                ->assertSeeIn("tr:last-child td[field-key='nome']", $event2->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $event2->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='id_sala']", $event2->id_sala->nome)
                ->logout();
        });
    }

    public function testShowEvent()
    {
        $admin = \App\User::find(1);
        $event = factory('App\Event')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $event) {
            $browser->loginAs($admin)
                ->visit(route('admin.events.index'))
                ->click('tr[data-entry-id="' . $event->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='intervallo_orario']", $event->intervallo_orario)
                ->assertSeeIn("td[field-key='nome']", $event->nome)
                ->assertSeeIn("td[field-key='descrizione']", $event->descrizione)
                ->assertSeeIn("td[field-key='id_sala']", $event->id_sala->nome)
                ->logout();
        });
    }

}
