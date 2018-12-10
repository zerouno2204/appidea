<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ImagesHotelTest extends DuskTestCase
{

    public function testCreateImagesHotel()
    {
        $admin = \App\User::find(1);
        $images_hotel = factory('App\ImagesHotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $images_hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.images_hotels.index'))
                ->clickLink('Add new')
                ->select("img_id", $images_hotel->img_id)
                ->select("hotel_id", $images_hotel->hotel_id)
                ->press('Save')
                ->assertRouteIs('admin.images_hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='img']", $images_hotel->img->nome)
                ->assertSeeIn("tr:last-child td[field-key='hotel']", $images_hotel->hotel->nome)
                ->logout();
        });
    }

    public function testEditImagesHotel()
    {
        $admin = \App\User::find(1);
        $images_hotel = factory('App\ImagesHotel')->create();
        $images_hotel2 = factory('App\ImagesHotel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $images_hotel, $images_hotel2) {
            $browser->loginAs($admin)
                ->visit(route('admin.images_hotels.index'))
                ->click('tr[data-entry-id="' . $images_hotel->id . '"] .btn-info')
                ->select("img_id", $images_hotel2->img_id)
                ->select("hotel_id", $images_hotel2->hotel_id)
                ->press('Update')
                ->assertRouteIs('admin.images_hotels.index')
                ->assertSeeIn("tr:last-child td[field-key='img']", $images_hotel2->img->nome)
                ->assertSeeIn("tr:last-child td[field-key='hotel']", $images_hotel2->hotel->nome)
                ->logout();
        });
    }

    public function testShowImagesHotel()
    {
        $admin = \App\User::find(1);
        $images_hotel = factory('App\ImagesHotel')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $images_hotel) {
            $browser->loginAs($admin)
                ->visit(route('admin.images_hotels.index'))
                ->click('tr[data-entry-id="' . $images_hotel->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='img']", $images_hotel->img->nome)
                ->assertSeeIn("td[field-key='hotel']", $images_hotel->hotel->nome)
                ->logout();
        });
    }

}
