<?php

$factory->define(App\Hotel::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "lat" => $faker->name,
        "lng" => $faker->name,
        "indirizzo" => $faker->name,
        "cap" => $faker->name,
        "citta_id" => factory('App\City')->create(),
        "provincia_id" => factory('App\Province')->create(),
        "descrizione" => $faker->name,
    ];
});
