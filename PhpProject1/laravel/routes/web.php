<?php
Route::get('/', function () { return redirect('/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::get('/home', 'HomeController@index');
Route::get('/customer/congress/{id}', 'Admin\CongressesController@showEvent');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    
    Route::get('/calendar', 'Admin\SystemCalendarController@index'); 
  
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('cities', 'Admin\CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'Admin\CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);
    Route::resource('codes', 'Admin\CodesController');
    Route::post('codes_mass_destroy', ['uses' => 'Admin\CodesController@massDestroy', 'as' => 'codes.mass_destroy']);
    Route::resource('congresses', 'Admin\CongressesController');
    Route::post('congresses_mass_destroy', ['uses' => 'Admin\CongressesController@massDestroy', 'as' => 'congresses.mass_destroy']);
    Route::resource('congress_entries', 'Admin\CongressEntriesController');
    Route::post('congress_entries_mass_destroy', ['uses' => 'Admin\CongressEntriesController@massDestroy', 'as' => 'congress_entries.mass_destroy']);
    Route::resource('congress_hotels', 'Admin\CongressHotelsController');
    Route::post('congress_hotels_mass_destroy', ['uses' => 'Admin\CongressHotelsController@massDestroy', 'as' => 'congress_hotels.mass_destroy']);
    Route::resource('document_types', 'Admin\DocumentTypesController');
    Route::post('document_types_mass_destroy', ['uses' => 'Admin\DocumentTypesController@massDestroy', 'as' => 'document_types.mass_destroy']);
    Route::resource('entries', 'Admin\EntriesController');
    Route::post('entries_mass_destroy', ['uses' => 'Admin\EntriesController@massDestroy', 'as' => 'entries.mass_destroy']);
    Route::resource('hotels', 'Admin\HotelsController');
    Route::post('hotels_mass_destroy', ['uses' => 'Admin\HotelsController@massDestroy', 'as' => 'hotels.mass_destroy']);
    Route::resource('images', 'Admin\ImagesController');
    Route::post('images_mass_destroy', ['uses' => 'Admin\ImagesController@massDestroy', 'as' => 'images.mass_destroy']);
    Route::resource('images_hotels', 'Admin\ImagesHotelsController');
    Route::post('images_hotels_mass_destroy', ['uses' => 'Admin\ImagesHotelsController@massDestroy', 'as' => 'images_hotels.mass_destroy']);
    Route::resource('provinces', 'Admin\ProvincesController');
    Route::post('provinces_mass_destroy', ['uses' => 'Admin\ProvincesController@massDestroy', 'as' => 'provinces.mass_destroy']);
    Route::resource('registrations', 'Admin\RegistrationsController');
    Route::post('registrations_mass_destroy', ['uses' => 'Admin\RegistrationsController@massDestroy', 'as' => 'registrations.mass_destroy']);
    Route::resource('rooms', 'Admin\RoomsController');
    Route::post('rooms_mass_destroy', ['uses' => 'Admin\RoomsController@massDestroy', 'as' => 'rooms.mass_destroy']);
    Route::resource('speakers', 'Admin\SpeakersController');
    Route::post('speakers_mass_destroy', ['uses' => 'Admin\SpeakersController@massDestroy', 'as' => 'speakers.mass_destroy']);
    Route::resource('speakers_congresses', 'Admin\SpeakersCongressesController');
    Route::post('speakers_congresses_mass_destroy', ['uses' => 'Admin\SpeakersCongressesController@massDestroy', 'as' => 'speakers_congresses.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('faq_categories', 'Admin\FaqCategoriesController');
    Route::post('faq_categories_mass_destroy', ['uses' => 'Admin\FaqCategoriesController@massDestroy', 'as' => 'faq_categories.mass_destroy']);
    Route::resource('faq_questions', 'Admin\FaqQuestionsController');
    Route::post('faq_questions_mass_destroy', ['uses' => 'Admin\FaqQuestionsController@massDestroy', 'as' => 'faq_questions.mass_destroy']);
    Route::resource('days', 'Admin\DaysController');
    Route::post('days_mass_destroy', ['uses' => 'Admin\DaysController@massDestroy', 'as' => 'days.mass_destroy']);
    Route::post('days_restore/{id}', ['uses' => 'Admin\DaysController@restore', 'as' => 'days.restore']);
    Route::delete('days_perma_del/{id}', ['uses' => 'Admin\DaysController@perma_del', 'as' => 'days.perma_del']);
    Route::resource('halls', 'Admin\HallsController');
    Route::post('halls_mass_destroy', ['uses' => 'Admin\HallsController@massDestroy', 'as' => 'halls.mass_destroy']);
    Route::post('halls_restore/{id}', ['uses' => 'Admin\HallsController@restore', 'as' => 'halls.restore']);
    Route::delete('halls_perma_del/{id}', ['uses' => 'Admin\HallsController@perma_del', 'as' => 'halls.perma_del']);
    Route::resource('events', 'Admin\EventsController');
    Route::post('events_mass_destroy', ['uses' => 'Admin\EventsController@massDestroy', 'as' => 'events.mass_destroy']);
    Route::post('events_restore/{id}', ['uses' => 'Admin\EventsController@restore', 'as' => 'events.restore']);
    Route::delete('events_perma_del/{id}', ['uses' => 'Admin\EventsController@perma_del', 'as' => 'events.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');
    
    /* Congress Room routes */
    
    Route::post('/congress_room/delete', ['uses' => 'Admin\CongressesController@deleteCongressRoom', 'as' => 'congress_room.destroy' ]);

    /* Registration routes */
    
    Route::get('/customer/registration/{congress_id}', 'Admin\RegistrationsController@registration');
    
    /* Messengers routes */
    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');

       /* AJAX Call */
    
    Route::post('/ajax-get-rooms', 'Admin\CongressesController@getRooms');
    Route::post('/ajax-registration-rooms', 'Admin\CongressesController@getCongressRooms');
 
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
