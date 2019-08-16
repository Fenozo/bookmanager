<?php

Route::get('/', 'LivresController@index')->name('livre.list');

Route::group(['prefix'=>'pages'],function(){

    Route::get('/list', 'PagesController@index')->name('page.list');
    Route::post('api/page/store','PagesController@store')->name('api.page.store');
});

Route::group(['prefix'=>'livre'], function(){
    Route::get('/list', 'LivresController@index')->name('livre.list');
    Route::post('api/livre/store','LivresController@store')->name('api.livre.store');
});
Route::group(['prefix'=> 'lecture'], function () {
    Route::get('/list', 'LecturesController@index')->name('lecture.list');
});
// Route::resource('events', 'LecturesController');

Route::get('api/chapiter','ChapitersController@index')->name('api.chapiter');