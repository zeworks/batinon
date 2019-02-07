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

// active user
Route::get('user','Api\UserController@index');

//pages
Route::get('pages','Api\PagesController@index');
Route::post('pages/add','Api\PagesController@add');
Route::get('pages/{id}','Api\PagesController@get');
Route::post('pages/edit/{id}','Api\PagesController@editPage');
Route::post('pages/delete','Api\PagesController@delete');

//files
Route::get('files','Api\FilesController@index');
Route::post('files/add','Api\FilesController@add');
Route::post('files/delete','Api\FilesController@delete');

//blogs
Route::get('blogs','Api\BlogController@index');
Route::post('blogs/add','Api\BlogController@add');
Route::get('blogs/{id}','Api\BlogController@get');
Route::post('blogs/edit/{id}','Api\BlogController@editBlog');
Route::post('blogs/delete','Api\BlogController@delete');

//banners
Route::get('banners','Api\BannersController@index');
Route::post('banners/add','Api\BannersController@add');
Route::get('banners/{id}','Api\BannersController@get');
Route::post('banners/edit/{id}','Api\BannersController@edit');
Route::post('banners/delete','Api\BannersController@delete');

//navigation
Route::get('navigation','Api\NavigationController@index');
Route::post('navigation/add','Api\NavigationController@add');
Route::get('navigation/edit/{id}','Api\NavigationController@get');
Route::post('navigation/delete','Api\NavigationController@delete');