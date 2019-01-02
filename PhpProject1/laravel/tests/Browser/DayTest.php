<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DayTest extends DuskTestCase
{

    public function testCreateDay()
    {
        $admin = \App\User::find(1);
        $day = factory('App\Day')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $day) {
            $browser->loginAs($admin)
                ->visit(route('admin.days.index'))
                ->clickLink('Add new')
                ->type("nome", $day->nome)
                ->type("descrizione", $day->descrizione)
                ->select("id_congresso_id", $day->id_congresso_id)
                ->type("data", $day->data)
                ->press('Save')
                ->assertRouteIs('admin.days.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $day->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $day->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='id_congresso']", $day->id_congresso->nome)
                ->assertSeeIn("tr:last-child td[field-key='data']", $day->data)
                ->logout();
        });
    }

    public function testEditDay()
    {
        $admin = \App\User::find(1);
        $day = factory('App\Day')->create();
        $day2 = factory('App\Day')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $day, $day2) {
            $browser->loginAs($admin)
                ->visit(route('admin.days.index'))
                ->click('tr[data-entry-id="' . $day->id . '"] .btn-info')
                ->type("nome", $day2->nome)
                ->type("descrizione", $day2->descrizione)
                ->select("id_congresso_id", $day2->id_congresso_id)
                ->type("data", $day2->data)
                ->press('Update')
                ->assertRouteIs('admin.days.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $day2->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $day2->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='id_congresso']", $day2->id_congresso->nome)
                ->assertSeeIn("tr:last-child td[field-key='data']", $day2->data)
                ->logout();
        });
    }

    public function testShowDay()
    {
        $admin = \App\User::find(1);
        $day = factory('App\Day')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $day) {
            $browser->loginAs($admin)
                ->visit(route('admin.days.index'))
                ->click('tr[data-entry-id="' . $day->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $day->nome)
                ->assertSeeIn("td[field-key='descrizione']", $day->descrizione)
                ->assertSeeIn("td[field-key='id_congresso']", $day->id_congresso->nome)
                ->assertSeeIn("td[field-key='data']", $day->data)
                ->logout();
        });
    }

}
