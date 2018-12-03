<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SpeakerTest extends DuskTestCase
{

    public function testCreateSpeaker()
    {
        $admin = \App\User::find(1);
        $speaker = factory('App\Speaker')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $speaker) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers.index'))
                ->clickLink('Add new')
                ->type("nome", $speaker->nome)
                ->type("cognome", $speaker->cognome)
                ->attach("img_path", base_path("tests/_resources/test.jpg"))
                ->type("contatti", $speaker->contatti)
                ->type("ruolo", $speaker->ruolo)
                ->type("descrizione", $speaker->descrizione)
                ->attach("curriculuum", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.speakers.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $speaker->nome)
                ->assertSeeIn("tr:last-child td[field-key='cognome']", $speaker->cognome)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Speaker::first()->img_path . "']")
                ->assertSeeIn("tr:last-child td[field-key='contatti']", $speaker->contatti)
                ->assertSeeIn("tr:last-child td[field-key='ruolo']", $speaker->ruolo)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $speaker->descrizione)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Speaker::first()->curriculuum . "']")
                ->logout();
        });
    }

    public function testEditSpeaker()
    {
        $admin = \App\User::find(1);
        $speaker = factory('App\Speaker')->create();
        $speaker2 = factory('App\Speaker')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $speaker, $speaker2) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers.index'))
                ->click('tr[data-entry-id="' . $speaker->id . '"] .btn-info')
                ->type("nome", $speaker2->nome)
                ->type("cognome", $speaker2->cognome)
                ->attach("img_path", base_path("tests/_resources/test.jpg"))
                ->type("contatti", $speaker2->contatti)
                ->type("ruolo", $speaker2->ruolo)
                ->type("descrizione", $speaker2->descrizione)
                ->attach("curriculuum", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.speakers.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $speaker2->nome)
                ->assertSeeIn("tr:last-child td[field-key='cognome']", $speaker2->cognome)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Speaker::first()->img_path . "']")
                ->assertSeeIn("tr:last-child td[field-key='contatti']", $speaker2->contatti)
                ->assertSeeIn("tr:last-child td[field-key='ruolo']", $speaker2->ruolo)
                ->assertSeeIn("tr:last-child td[field-key='descrizione']", $speaker2->descrizione)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Speaker::first()->curriculuum . "']")
                ->logout();
        });
    }

    public function testShowSpeaker()
    {
        $admin = \App\User::find(1);
        $speaker = factory('App\Speaker')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $speaker) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers.index'))
                ->click('tr[data-entry-id="' . $speaker->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $speaker->nome)
                ->assertSeeIn("td[field-key='cognome']", $speaker->cognome)
                ->assertSeeIn("td[field-key='contatti']", $speaker->contatti)
                ->assertSeeIn("td[field-key='ruolo']", $speaker->ruolo)
                ->assertSeeIn("td[field-key='descrizione']", $speaker->descrizione)
                ->logout();
        });
    }

}
