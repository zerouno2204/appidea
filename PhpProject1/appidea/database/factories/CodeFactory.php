<?php

$factory->define(App\Code::class, function (Faker\Generator $faker) {
    return [
        "code" => $faker->name,
        "qrcode" => $faker->name,
        "id_congress_id" => factory('App\Congress')->create(),
        "id_user_id" => factory('App\User')->create(),
    ];
});
