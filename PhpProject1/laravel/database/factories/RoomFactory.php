<?php

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        "descrizione" => $faker->name,
        "prezzo" => $faker->name,
        "p_letto" => $faker->randomNumber(2),
        "id_hotel_id" => factory('App\Hotel')->create(),
    ];
});
