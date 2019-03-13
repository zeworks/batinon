<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//user
Route::get('user/{id}','Api\UserController@index');
Route::put('user','Api\UserController@update');
Route::post('user/password','Api\UserController@validatePassword');
Route::put('user/password','Api\UserController@updatePassword');

//pages
Route::get('pages','Api\PagesController@index');
Route::post('pages/add','Api\PagesController@add');
Route::get('pages/{id}','Api\PagesController@get');
Route::put('pages/edit/{id}','Api\PagesController@editPage');
Route::delete('pages/delete/{id}','Api\PagesController@delete');

//files
Route::get('files','Api\FilesController@index');
Route::post('files/add','Api\FilesController@add');
Route::delete('files/delete/{id}','Api\FilesController@delete');

//blogs
Route::get('blogs','Api\BlogController@index');
Route::post('blogs/add','Api\BlogController@add');
Route::get('blogs/{id}','Api\BlogController@get');
Route::put('blogs/edit/{id}','Api\BlogController@editBlog');
Route::delete('blogs/delete/{id}','Api\BlogController@delete');

//banners
Route::get('banners','Api\BannersController@index');
Route::post('banners/add','Api\BannersController@add');
Route::get('banners/{id}','Api\BannersController@get');
Route::put('banners/edit/{id}','Api\BannersController@edit');
Route::delete('banners/delete/{id}','Api\BannersController@delete');

//navigation
Route::get('navigation','Api\NavigationController@indexAction');
Route::post('navigation/add','Api\NavigationController@addAction');
Route::get('navigation/{id}','Api\NavigationController@getAction');
Route::put('navigation/edit','Api\NavigationController@editAction');

//products
Route::get('products','Api\ProductsController@indexAction');
Route::post('products/add','Api\ProductsController@addAction');
Route::get('products/{id}','Api\ProductsController@getAction');
Route::put('products/edit/{id}','Api\ProductsController@editAction');
Route::delete('products/delete/{id}','Api\ProductsController@deleteAction');

//settings
Route::get('settings','Api\SettingsController@indexAction');
Route::put('settings','Api\SettingsController@updateAction');