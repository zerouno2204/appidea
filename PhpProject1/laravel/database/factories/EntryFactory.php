<?php

$factory->define(App\Entry::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "data_inizio" => $faker->date("d-m-Y", $max = 'now'),
        "data_fine" => $faker->date("d-m-Y", $max = 'now'),
        "prezzo" => $faker->name,
        "ab_codice" => $faker->name,
        "descrizione" => $faker->name,
    ];
});
