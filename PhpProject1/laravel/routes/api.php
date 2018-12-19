<?php

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware'=>'auth:api'], function () {
    Route::post('calendar','Api\UserController@calendar');
});
