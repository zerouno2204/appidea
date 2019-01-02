<?php

$factory->define(App\CongressEntry::class, function (Faker\Generator $faker) {
    return [
        "id_congress_id" => factory('App\Congress')->create(),
        "id_entry_id" => factory('App\Entry')->create(),
    ];
});
