<?php

$factory->define(App\CongressHotel::class, function (Faker\Generator $faker) {
    return [
        "id_congress_id" => factory('App\Congress')->create(),
        "id_hotel_id" => factory('App\Hotel')->create(),
    ];
});
