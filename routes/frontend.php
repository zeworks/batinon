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
Route::get('/produtos', 'Front\ProductsController@index');
Route::get('/blog', 'Front\BlogController@index');
Route::get('/blog/{slug}', 'Front\BlogController@getBlog');
Route::get('/404','Front\PagesController@errorAction');
Route::get('/{slug}', 'Front\PagesController@getPage');

// front post
Route::post('subscribe','Front\SubscribersController@index');


// menus
View::composer(['*'], function($view){
    $menus = App\Navigation::where("status",1)->get();

    $view->with("menus", $menus);
});

// pages
View::composer(['*'], function($view){
    $urls = App\Pages::where("status",1)->orderBy('order', 'ASC')->get();

    $view->with("urls",$urls);
});

// settings
View::composer(['*'], function($view){
    $settings = App\Settings::get();

    $view->with("settings",$settings);
});