<?php

$factory->define(App\Hall::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "descrizione" => $faker->name,
        "capienza" => $faker->name,
        "id_giorno_id" => factory('App\Day')->create(),
    ];
});
