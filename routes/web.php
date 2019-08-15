<?php



Route::get('/', 'LivresController@index')->name('home');
Route::get('/lecture', 'LecturesController@index')->name('lecture');
Route::resource('events', 'LecturesController');
