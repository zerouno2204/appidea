<?php

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
    ];
});
