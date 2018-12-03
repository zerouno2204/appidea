<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CongressTest extends DuskTestCase
{

    public function testCreateCongress()
    {
        $admin = \App\User::find(1);
        $congress = factory('App\Congress')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress) {
            $browser->loginAs($admin)
                ->visit(route('admin.congresses.index'))
                ->clickLink('Add new')
                ->type("nome", $congress->nome)
                ->type("descrizione", $congress->descrizione)
                ->type("data_inizio", $congress->data_inizio)
                ->type("data_fine", $congress->data_fine)
                ->attach("img", base_path("tests/_resources/test.jpg"))
                ->type("descr_sede", $congress->descr_sede)
                ->type("ind_sede", $congress->ind_sede)
                ->type("lat", $congress->lat)
                ->type("lng", $congress->lng)
                ->type("cap_sede", $congress->cap_sede)
                ->select("id_citta_sede_id", $congress->id_citta_sede_id)
                ->select("id_prov_sede_id", $congress->id_prov_sede_id)
                ->press('Save')
                ->assertRouteIs('admin.congresses.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $congress->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='data_inizio']", $congress->data_inizio)
                ->assertSeeIn("tr:last-child td[field-key='data_fine']", $congress->data_fine)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Congress::first()->img . "']")
                ->assertSeeIn("tr:last-child td[field-key='descr_sede']", $congress->descr_sede)
                ->assertSeeIn("tr:last-child td[field-key='ind_sede']", $congress->ind_sede)
                ->assertSeeIn("tr:last-child td[field-key='lat']", $congress->lat)
                ->assertSeeIn("tr:last-child td[field-key='lng']", $congress->lng)
                ->assertSeeIn("tr:last-child td[field-key='cap_sede']", $congress->cap_sede)
                ->assertSeeIn("tr:last-child td[field-key='id_citta_sede']", $congress->id_citta_sede->name)
                ->assertSeeIn("tr:last-child td[field-key='id_prov_sede']", $congress->id_prov_sede->nome)
                ->logout();
        });
    }

    public function testEditCongress()
    {
        $admin = \App\User::find(1);
        $congress = factory('App\Congress')->create();
        $congress2 = factory('App\Congress')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $congress, $congress2) {
            $browser->loginAs($admin)
                ->visit(route('admin.congresses.index'))
                ->click('tr[data-entry-id="' . $congress->id . '"] .btn-info')
                ->type("nome", $congress2->nome)
                ->type("descrizione", $congress2->descrizione)
                ->type("data_inizio", $congress2->data_inizio)
                ->type("data_fine", $congress2->data_fine)
                ->attach("img", base_path("tests/_resources/test.jpg"))
                ->type("descr_sede", $congress2->descr_sede)
                ->type("ind_sede", $congress2->ind_sede)
                ->type("lat", $congress2->lat)
                ->type("lng", $congress2->lng)
                ->type("cap_sede", $congress2->cap_sede)
                ->select("id_citta_sede_id", $congress2->id_citta_sede_id)
                ->select("id_prov_sede_id", $congress2->id_prov_sede_id)
                ->press('Update')
                ->assertRouteIs('admin.congresses.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $congress2->nome)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $congress2->descrizione)
                ->assertSeeIn("tr:last-child td[field-key='data_inizio']", $congress2->data_inizio)
                ->assertSeeIn("tr:last-child td[field-key='data_fine']", $congress2->data_fine)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Congress::first()->img . "']")
                ->assertSeeIn("tr:last-child td[field-key='descr_sede']", $congress2->descr_sede)
                ->assertSeeIn("tr:last-child td[field-key='ind_sede']", $congress2->ind_sede)
                ->assertSeeIn("tr:last-child td[field-key='lat']", $congress2->lat)
                ->assertSeeIn("tr:last-child td[field-key='lng']", $congress2->lng)
                ->assertSeeIn("tr:last-child td[field-key='cap_sede']", $congress2->cap_sede)
                ->assertSeeIn("tr:last-child td[field-key='id_citta_sede']", $congress2->id_citta_sede->name)
                ->assertSeeIn("tr:last-child td[field-key='id_prov_sede']", $congress2->id_prov_sede->nome)
                ->logout();
        });
    }

    public function testShowCongress()
    {
        $admin = \App\User::find(1);
        $congress = factory('App\Congress')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $congress) {
            $browser->loginAs($admin)
                ->visit(route('admin.congresses.index'))
                ->click('tr[data-entry-id="' . $congress->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $congress->nome)
                ->assertSeeIn("td[field-key='descrizione']", $congress->descrizione)
                ->assertSeeIn("td[field-key='data_inizio']", $congress->data_inizio)
                ->assertSeeIn("td[field-key='data_fine']", $congress->data_fine)
                ->assertSeeIn("td[field-key='descr_sede']", $congress->descr_sede)
                ->assertSeeIn("td[field-key='ind_sede']", $congress->ind_sede)
                ->assertSeeIn("td[field-key='lat']", $congress->lat)
                ->assertSeeIn("td[field-key='lng']", $congress->lng)
                ->assertSeeIn("td[field-key='cap_sede']", $congress->cap_sede)
                ->assertSeeIn("td[field-key='id_citta_sede']", $congress->id_citta_sede->name)
                ->assertSeeIn("td[field-key='id_prov_sede']", $congress->id_prov_sede->nome)
                ->logout();
        });
    }

}
