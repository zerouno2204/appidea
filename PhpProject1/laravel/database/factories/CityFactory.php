<?php

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "province_id" => factory('App\Province')->create(),
    ];
});
