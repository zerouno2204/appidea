<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RegistrationTest extends DuskTestCase
{

    public function testCreateRegistration()
    {
        $admin = \App\User::find(1);
        $registration = factory('App\Registration')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $registration) {
            $browser->loginAs($admin)
                ->visit(route('admin.registrations.index'))
                ->clickLink('Add new')
                ->type("nome_documento", $registration->nome_documento)
                ->type("luogo_rilascio", $registration->luogo_rilascio)
                ->type("data_emissione", $registration->data_emissione)
                ->type("data_scadenza", $registration->data_scadenza)
                ->type("id_tipo_doc", $registration->id_tipo_doc)
                ->type("path_img_doc", $registration->path_img_doc)
                ->type("note", $registration->note)
                ->type("registrationscol", $registration->registrationscol)
                ->select("id_entry_id", $registration->id_entry_id)
                ->select("id_congress_id", $registration->id_congress_id)
                ->select("id_speaker_id", $registration->id_speaker_id)
                ->select("id_hotel_id", $registration->id_hotel_id)
                ->select("id_user_id", $registration->id_user_id)
                ->select("id_camera_id", $registration->id_camera_id)
                ->press('Save')
                ->assertRouteIs('admin.registrations.index')
                ->assertSeeIn("tr:last-child td[field-key='nome_documento']", $registration->nome_documento)
                ->assertSeeIn("tr:last-child td[field-key='luogo_rilascio']", $registration->luogo_rilascio)
                ->assertSeeIn("tr:last-child td[field-key='data_emissione']", $registration->data_emissione)
                ->assertSeeIn("tr:last-child td[field-key='data_scadenza']", $registration->data_scadenza)
                ->assertSeeIn("tr:last-child td[field-key='id_tipo_doc']", $registration->id_tipo_doc)
                ->assertSeeIn("tr:last-child td[field-key='path_img_doc']", $registration->path_img_doc)
                ->assertSeeIn("tr:last-child td[field-key='note']", $registration->note)
                ->assertSeeIn("tr:last-child td[field-key='registrationscol']", $registration->registrationscol)
                ->logout();
        });
    }

    public function testEditRegistration()
    {
        $admin = \App\User::find(1);
        $registration = factory('App\Registration')->create();
        $registration2 = factory('App\Registration')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $registration, $registration2) {
            $browser->loginAs($admin)
                ->visit(route('admin.registrations.index'))
                ->click('tr[data-entry-id="' . $registration->id . '"] .btn-info')
                ->type("nome_documento", $registration2->nome_documento)
                ->type("luogo_rilascio", $registration2->luogo_rilascio)
                ->type("data_emissione", $registration2->data_emissione)
                ->type("data_scadenza", $registration2->data_scadenza)
                ->type("id_tipo_doc", $registration2->id_tipo_doc)
                ->type("path_img_doc", $registration2->path_img_doc)
                ->type("note", $registration2->note)
                ->type("registrationscol", $registration2->registrationscol)
                ->select("id_entry_id", $registration2->id_entry_id)
                ->select("id_congress_id", $registration2->id_congress_id)
                ->select("id_speaker_id", $registration2->id_speaker_id)
                ->select("id_hotel_id", $registration2->id_hotel_id)
                ->select("id_user_id", $registration2->id_user_id)
                ->select("id_camera_id", $registration2->id_camera_id)
                ->press('Update')
                ->assertRouteIs('admin.registrations.index')
                ->assertSeeIn("tr:last-child td[field-key='nome_documento']", $registration2->nome_documento)
                ->assertSeeIn("tr:last-child td[field-key='luogo_rilascio']", $registration2->luogo_rilascio)
                ->assertSeeIn("tr:last-child td[field-key='data_emissione']", $registration2->data_emissione)
                ->assertSeeIn("tr:last-child td[field-key='data_scadenza']", $registration2->data_scadenza)
                ->assertSeeIn("tr:last-child td[field-key='id_tipo_doc']", $registration2->id_tipo_doc)
                ->assertSeeIn("tr:last-child td[field-key='path_img_doc']", $registration2->path_img_doc)
                ->assertSeeIn("tr:last-child td[field-key='note']", $registration2->note)
                ->assertSeeIn("tr:last-child td[field-key='registrationscol']", $registration2->registrationscol)
                ->logout();
        });
    }

    public function testShowRegistration()
    {
        $admin = \App\User::find(1);
        $registration = factory('App\Registration')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $registration) {
            $browser->loginAs($admin)
                ->visit(route('admin.registrations.index'))
                ->click('tr[data-entry-id="' . $registration->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome_documento']", $registration->nome_documento)
                ->assertSeeIn("td[field-key='luogo_rilascio']", $registration->luogo_rilascio)
                ->assertSeeIn("td[field-key='data_emissione']", $registration->data_emissione)
                ->assertSeeIn("td[field-key='data_scadenza']", $registration->data_scadenza)
                ->assertSeeIn("td[field-key='id_tipo_doc']", $registration->id_tipo_doc)
                ->assertSeeIn("td[field-key='path_img_doc']", $registration->path_img_doc)
                ->assertSeeIn("td[field-key='note']", $registration->note)
                ->assertSeeIn("td[field-key='registrationscol']", $registration->registrationscol)
                ->logout();
        });
    }

}
