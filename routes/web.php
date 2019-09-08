<?php

Route::get("/finds", "Api\FindersController@find")->name("find");
/**
* ##################################################################
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/galerie','GaleriesController@index')->name('galerie.list');
Route::post('/galerie/upload','GaleriesController@upload')->name('galerie.upload');

/**
* ####################-GESTION DE PAGE-###########################################
*/

Route::group(['prefix'=>'pages'],function() {

    Route::get('/list', 'PagesController@index')->name('page.list');
    
});
/*******************************************************************************/
Route::get("/api/stories","Api\StoriesController@index")->name("api.stories.index");
/**
* ######################-GESTION DE LIVRE-############################################
*/
Route::group(['prefix'=>'livre'], function(){
    Route::get('/list', 'LivresController@index')->name('livre.list');
});

Route::group(['prefix' => 'api'], function () {
    
    Route::post('livre/update','Api\LivresController@update')->name('api.livre.update');
    Route::post('livre/store','Api\LivresController@store')->name('api.livre.store');
    Route::get('livre/index','Api\LivresController@index')->name('api.livre.index');
    Route::get('livre/where','Api\LivresController@where')->name('api.livre.where');
    Route::get('livre/list','Api\LivresController@list')->name('api.livre.list');

    Route::post('page/store','Api\PagesController@store')->name('api.page.store');
    Route::get('page/show/{id}', "Api\PagesController@show")->name("api.page.show");
    Route::get('chapiter','Api\ChapitersController@index')->name('api.chapiter');

});

Route::group(['prefix'=> 'lecture'], function () {
    Route::get('/list', 'LecturesController@index')->name('lecture.list');
});


/*****************************************************************************************/

Route::get('api/page/list', 'Api\PagesController@index')->name('api.page.list');

/***************************************************************************************/