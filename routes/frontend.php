<?php

/*
|--------------------------------------------------------------------------
| front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register front routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "front" middleware group. Now create something great!
|
*/

// front get
Route::get('/', 'Front\HomeController@index');
Route::get('/{slug}', 'Front\PagesController@getPage');

// front post
Route::post('subscribe','Front\SubscribersController@index');


// templates
View::composer(['*'], function($view){
    $urls = App\Pages::get()->where("status",1);
    $view->with("urls",$urls);
});

// settings
View::composer(['*'], function($view){
    $settings = App\Settings::get();
    $view->with("settings",$settings);
});