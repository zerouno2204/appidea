<?php

$factory->define(App\DocumentType::class, function (Faker\Generator $faker) {
    return [
        "nome" => $faker->name,
        "slug" => $faker->name,
    ];
});
