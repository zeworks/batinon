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

// front post
Route::post('subscribe','Front\SubscribersController@index');


// templates
View::composer(['*'], function($view){
    $urls = App\Templates::get()->where("status",'on');
    $view->with("urls",$urls);
});
// settings
View::composer(['*'], function($view){
    $settings = App\admin_settings::get();
    $view->with("settings",$settings);
});
