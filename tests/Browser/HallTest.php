<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class HallTest extends DuskTestCase
{

    public function testCreateHall()
    {
        $admin = \App\User::find(1);
        $hall = factory('App\Hall')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $hall) {
            $browser->loginAs($admin)
                ->visit(route('admin.halls.index'))
                ->clickLink('Add new')
                ->type("nome", $hall->nome)
                ->type("descrizione", $hall->descrizione)
                ->type("capienza", $hall->capienza)
                ->select("id_giorno_id", $hall->id_giorno_id)
                ->press('Save')
                ->assertRouteIs('admin.halls.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $hall->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $hall->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='capienza']", $hall->capienza)
                ->assertSeeIn("tr:last-child td[field-key='id_giorno']", $hall->id_giorno->nome)
                ->logout();
        });
    }

    public function testEditHall()
    {
        $admin = \App\User::find(1);
        $hall = factory('App\Hall')->create();
        $hall2 = factory('App\Hall')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $hall, $hall2) {
            $browser->loginAs($admin)
                ->visit(route('admin.halls.index'))
                ->click('tr[data-entry-id="' . $hall->id . '"] .btn-info')
                ->type("nome", $hall2->nome)
                ->type("descrizione", $hall2->descrizione)
                ->type("capienza", $hall2->capienza)
                ->select("id_giorno_id", $hall2->id_giorno_id)
                ->press('Update')
                ->assertRouteIs('admin.halls.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $hall2->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $hall2->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='capienza']", $hall2->capienza)
                ->assertSeeIn("tr:last-child td[field-key='id_giorno']", $hall2->id_giorno->nome)
                ->logout();
        });
    }

    public function testShowHall()
    {
        $admin = \App\User::find(1);
        $hall = factory('App\Hall')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $hall) {
            $browser->loginAs($admin)
                ->visit(route('admin.halls.index'))
                ->click('tr[data-entry-id="' . $hall->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $hall->nome)
                ->assertSeeIn("td[field-key='descrizione']", $hall->descrizione)
                ->assertSeeIn("td[field-key='capienza']", $hall->capienza)
                ->assertSeeIn("td[field-key='id_giorno']", $hall->id_giorno->nome)
                ->logout();
        });
    }

}
