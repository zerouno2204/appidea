<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CongressEntryTest extends DuskTestCase
{

    public function testCreateCongressEntry()
    {
        $admin = \App\User::find(1);
        $congress_entry = factory('App\CongressEntry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress_entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_entries.index'))
                ->clickLink('Add new')
                ->select("id_congress_id", $congress_entry->id_congress_id)
                ->select("id_entry_id", $congress_entry->id_entry_id)
                ->press('Save')
                ->assertRouteIs('admin.congress_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $congress_entry->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_entry']", $congress_entry->id_entry->nome)
                ->logout();
        });
    }

    public function testEditCongressEntry()
    {
        $admin = \App\User::find(1);
        $congress_entry = factory('App\CongressEntry')->create();
        $congress_entry2 = factory('App\CongressEntry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress_entry, $congress_entry2) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_entries.index'))
                ->click('tr[data-entry-id="' . $congress_entry->id . '"] .btn-info')
                ->select("id_congress_id", $congress_entry2->id_congress_id)
                ->select("id_entry_id", $congress_entry2->id_entry_id)
                ->press('Update')
                ->assertRouteIs('admin.congress_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $congress_entry2->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_entry']", $congress_entry2->id_entry->nome)
                ->logout();
        });
    }

    public function testShowCongressEntry()
    {
        $admin = \App\User::find(1);
        $congress_entry = factory('App\CongressEntry')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $congress_entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.congress_entries.index'))
                ->click('tr[data-entry-id="' . $congress_entry->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='id_congress']", $congress_entry->id_congress->nome)
                ->assertSeeIn("td[field-key='id_entry']", $congress_entry->id_entry->nome)
                ->logout();
        });
    }

}
