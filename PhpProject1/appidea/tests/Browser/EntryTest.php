<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EntryTest extends DuskTestCase
{

    public function testCreateEntry()
    {
        $admin = \App\User::find(1);
        $entry = factory('App\Entry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.entries.index'))
                ->clickLink('Add new')
                ->type("nome", $entry->nome)
                ->type("data_inizio", $entry->data_inizio)
                ->type("data_fine", $entry->data_fine)
                ->type("prezzo", $entry->prezzo)
                ->type("ab_codice", $entry->ab_codice)
                ->type("descrizione", $entry->descrizione)
                ->press('Save')
                ->assertRouteIs('admin.entries.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $entry->nome)
                ->assertSeeIn("tr:last-child td[field-key='data_inizio']", $entry->data_inizio)
                ->assertSeeIn("tr:last-child td[field-key='data_fine']", $entry->data_fine)
                ->assertSeeIn("tr:last-child td[field-key='prezzo']", $entry->prezzo)
                ->assertSeeIn("tr:last-child td[field-key='ab_codice']", $entry->ab_codice)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $entry->descrizione)
                ->logout();
        });
    }

    public function testEditEntry()
    {
        $admin = \App\User::find(1);
        $entry = factory('App\Entry')->create();
        $entry2 = factory('App\Entry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $entry, $entry2) {
            $browser->loginAs($admin)
                ->visit(route('admin.entries.index'))
                ->click('tr[data-entry-id="' . $entry->id . '"] .btn-info')
                ->type("nome", $entry2->nome)
                ->type("data_inizio", $entry2->data_inizio)
                ->type("data_fine", $entry2->data_fine)
                ->type("prezzo", $entry2->prezzo)
                ->type("ab_codice", $entry2->ab_codice)
                ->type("descrizione", $entry2->descrizione)
                ->press('Update')
                ->assertRouteIs('admin.entries.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $entry2->nome)
                ->assertSeeIn("tr:last-child td[field-key='data_inizio']", $entry2->data_inizio)
                ->assertSeeIn("tr:last-child td[field-key='data_fine']", $entry2->data_fine)
                ->assertSeeIn("tr:last-child td[field-key='prezzo']", $entry2->prezzo)
                ->assertSeeIn("tr:last-child td[field-key='ab_codice']", $entry2->ab_codice)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $entry2->descrizione)
                ->logout();
        });
    }

    public function testShowEntry()
    {
        $admin = \App\User::find(1);
        $entry = factory('App\Entry')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.entries.index'))
                ->click('tr[data-entry-id="' . $entry->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $entry->nome)
                ->assertSeeIn("td[field-key='data_inizio']", $entry->data_inizio)
                ->assertSeeIn("td[field-key='data_fine']", $entry->data_fine)
                ->assertSeeIn("td[field-key='prezzo']", $entry->prezzo)
                ->assertSeeIn("td[field-key='ab_codice']", $entry->ab_codice)
                ->assertSeeIn("td[field-key='descrizione']", $entry->descrizione)
                ->logout();
        });
    }

}
