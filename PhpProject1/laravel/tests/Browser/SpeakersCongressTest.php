<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SpeakersCongressTest extends DuskTestCase
{

    public function testCreateSpeakersCongress()
    {
        $admin = \App\User::find(1);
        $speakers_congress = factory('App\SpeakersCongress')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $speakers_congress) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers_congresses.index'))
                ->clickLink('Add new')
                ->select("id_congress_id", $speakers_congress->id_congress_id)
                ->select("id_speaker_id", $speakers_congress->id_speaker_id)
                ->press('Save')
                ->assertRouteIs('admin.speakers_congresses.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $speakers_congress->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_speaker']", $speakers_congress->id_speaker->nome)
                ->logout();
        });
    }

    public function testEditSpeakersCongress()
    {
        $admin = \App\User::find(1);
        $speakers_congress = factory('App\SpeakersCongress')->create();
        $speakers_congress2 = factory('App\SpeakersCongress')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $speakers_congress, $speakers_congress2) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers_congresses.index'))
                ->click('tr[data-entry-id="' . $speakers_congress->id . '"] .btn-info')
                ->select("id_congress_id", $speakers_congress2->id_congress_id)
                ->select("id_speaker_id", $speakers_congress2->id_speaker_id)
                ->press('Update')
                ->assertRouteIs('admin.speakers_congresses.index')
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $speakers_congress2->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_speaker']", $speakers_congress2->id_speaker->nome)
                ->logout();
        });
    }

    public function testShowSpeakersCongress()
    {
        $admin = \App\User::find(1);
        $speakers_congress = factory('App\SpeakersCongress')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $speakers_congress) {
            $browser->loginAs($admin)
                ->visit(route('admin.speakers_congresses.index'))
                ->click('tr[data-entry-id="' . $speakers_congress->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='id_congress']", $speakers_congress->id_congress->nome)
                ->assertSeeIn("td[field-key='id_speaker']", $speakers_congress->id_speaker->nome)
                ->logout();
        });
    }

}
