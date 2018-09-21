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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//pages
Route::get('pages','Api\PagesController@index');
Route::get('pages/edit/{id}','Api\PagesController@edit');
Route::post('pages/edit/{id}','Api\PagesController@editPage');
//files
Route::get('files','Api\FilesController@index');
Route::post('files/add','Api\FilesController@add');
Route::post('files/delete/{id}','Api\FilesController@delete');