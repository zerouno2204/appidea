<?php

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        "intervallo_orario" => $faker->name,
        "nome" => $faker->name,
        "descrizione" => $faker->name,
        "id_sala_id" => factory('App\Hall')->create(),
    ];
});
