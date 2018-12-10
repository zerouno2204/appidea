<?php

$factory->define(App\ImagesHotel::class, function (Faker\Generator $faker) {
    return [
        "img_id" => factory('App\Image')->create(),
        "hotel_id" => factory('App\Hotel')->create(),
    ];
});
