<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// back end

Auth::routes();

Route::group(['middleware' => ['auth:backend']], function() {
    Route::prefix('admin')->group(function(){

        // set the default language to the BO
        App::setlocale('pt');

        // routes
        Route::get('/{any}', 'Admin\SpaController@index')->where('any', '.*');
    });
});