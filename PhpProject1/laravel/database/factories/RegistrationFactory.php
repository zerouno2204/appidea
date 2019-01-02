<?php

$factory->define(App\Registration::class, function (Faker\Generator $faker) {
    return [
        "nome_documento" => $faker->name,
        "luogo_rilascio" => $faker->name,
        "data_emissione" => $faker->date("d-m-Y", $max = 'now'),
        "data_scadenza" => $faker->date("d-m-Y", $max = 'now'),
        "id_tipo_doc" => $faker->randomNumber(2),
        "path_img_doc" => $faker->name,
        "note" => $faker->name,
        "registrationscol" => $faker->name,
        "id_entry_id" => factory('App\Entry')->create(),
        "id_congress_id" => factory('App\Congress')->create(),
        "id_speaker_id" => factory('App\Speaker')->create(),
        "id_hotel_id" => factory('App\Hotel')->create(),
        "id_user_id" => factory('App\User')->create(),
        "id_camera_id" => factory('App\Room')->create(),
    ];
});
