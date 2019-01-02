<?php

$factory->define(App\SpeakersCongress::class, function (Faker\Generator $faker) {
    return [
        "id_congress_id" => factory('App\Congress')->create(),
        "id_speaker_id" => factory('App\Speaker')->create(),
    ];
});
