<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DocumentTypeTest extends DuskTestCase
{

    public function testCreateDocumentType()
    {
        $admin = \App\User::find(1);
        $document_type = factory('App\DocumentType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_types.index'))
                ->clickLink('Add new')
                ->type("nome", $document_type->nome)
                ->type("slug", $document_type->slug)
                ->press('Save')
                ->assertRouteIs('admin.document_types.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $document_type->nome)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $document_type->slug)
                ->logout();
        });
    }

    public function testEditDocumentType()
    {
        $admin = \App\User::find(1);
        $document_type = factory('App\DocumentType')->create();
        $document_type2 = factory('App\DocumentType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_type, $document_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_types.index'))
                ->click('tr[data-entry-id="' . $document_type->id . '"] .btn-info')
                ->type("nome", $document_type2->nome)
                ->type("slug", $document_type2->slug)
                ->press('Update')
                ->assertRouteIs('admin.document_types.index')
                ->assertSeeIn("tr:last-child td[field-key='nome']", $document_type2->nome)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $document_type2->slug)
                ->logout();
        });
    }

    public function testShowDocumentType()
    {
        $admin = \App\User::find(1);
        $document_type = factory('App\DocumentType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $document_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_types.index'))
                ->click('tr[data-entry-id="' . $document_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='nome']", $document_type->nome)
                ->assertSeeIn("td[field-key='slug']", $document_type->slug)
                ->logout();
        });
    }

}
