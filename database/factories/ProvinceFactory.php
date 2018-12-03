<?php

$factory->define(App\Province::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "slug" => $faker->name,
    ];
});
