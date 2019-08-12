<?php



Route::get('/', 'EventsController@index')->name('root_web');
Route::resource('events', 'EventsController');
