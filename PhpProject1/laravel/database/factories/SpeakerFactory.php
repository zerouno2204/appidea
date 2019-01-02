<?php

$factory->define(App\Speaker::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "cognome" => $faker->name,
        "contatti" => $faker->name,
        "ruolo" => $faker->name,
        "descrizione" => $faker->name,
    ];
});
