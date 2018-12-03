<?php

$factory->define(App\Day::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "descrizione" => $faker->name,
        "id_congresso_id" => factory('App\Congress')->create(),
        "data" => $faker->name,
    ];
});
