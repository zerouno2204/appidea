<?php

$factory->define(App\Congress::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "descrizione" => $faker->name,
        "data_inizio" => $faker->date("d-m-Y", $max = 'now'),
        "data_fine" => $faker->date("d-m-Y", $max = 'now'),
        "descr_sede" => $faker->name,
        "ind_sede" => $faker->name,
        "lat" => $faker->name,
        "lng" => $faker->name,
        "cap_sede" => $faker->name,
        "id_citta_sede_id" => factory('App\City')->create(),
        "id_prov_sede_id" => factory('App\Province')->create(),
    ];
});
