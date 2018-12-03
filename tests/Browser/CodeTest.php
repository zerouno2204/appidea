<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CodeTest extends DuskTestCase
{

    public function testCreateCode()
    {
        $admin = \App\User::find(1);
        $code = factory('App\Code')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $code) {
            $browser->loginAs($admin)
                ->visit(route('admin.codes.index'))
                ->clickLink('Add new')
                ->type("code", $code->code)
                ->type("qrcode", $code->qrcode)
                ->select("id_congress_id", $code->id_congress_id)
                ->select("id_user_id", $code->id_user_id)
                ->press('Save')
                ->assertRouteIs('admin.codes.index')
                ->assertSeeIn("tr:last-child td[field-key='code']", $code->code)
                ->assertSeeIn("tr:last-child td[field-key='qrcode']", $code->qrcode)
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $code->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_user']", $code->id_user->name)
                ->logout();
        });
    }

    public function testEditCode()
    {
        $admin = \App\User::find(1);
        $code = factory('App\Code')->create();
        $code2 = factory('App\Code')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $code, $code2) {
            $browser->loginAs($admin)
                ->visit(route('admin.codes.index'))
                ->click('tr[data-entry-id="' . $code->id . '"] .btn-info')
                ->type("code", $code2->code)
                ->type("qrcode", $code2->qrcode)
                ->select("id_congress_id", $code2->id_congress_id)
                ->select("id_user_id", $code2->id_user_id)
                ->press('Update')
                ->assertRouteIs('admin.codes.index')
                ->assertSeeIn("tr:last-child td[field-key='code']", $code2->code)
                ->assertSeeIn("tr:last-child td[field-key='qrcode']", $code2->qrcode)
                ->assertSeeIn("tr:last-child td[field-key='id_congress']", $code2->id_congress->nome)
                ->assertSeeIn("tr:last-child td[field-key='id_user']", $code2->id_user->name)
                ->logout();
        });
    }

    public function testShowCode()
    {
        $admin = \App\User::find(1);
        $code = factory('App\Code')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $code) {
            $browser->loginAs($admin)
                ->visit(route('admin.codes.index'))
                ->click('tr[data-entry-id="' . $code->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='code']", $code->code)
                ->assertSeeIn("td[field-key='qrcode']", $code->qrcode)
                ->assertSeeIn("td[field-key='id_congress']", $code->id_congress->nome)
                ->assertSeeIn("td[field-key='id_user']", $code->id_user->name)
                ->logout();
        });
    }

}
