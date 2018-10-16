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

Auth::routes();

// back end
Route::group(['middleware' => ['auth']], function() {
    Route::prefix('admin')->group(function(){
        // STYLEGUIDE
        Route::get('/styleguide', function(){
            return view('admin.styleguide._index');
        });

        // HOME
        Route::get('/home', 'Admin\HomeController@index');
    
        // PAGES
        Route::get('/pages','Admin\PagesController@index');
        Route::get('/pages/new','Admin\PagesController@new')->name('page_new');
        Route::get('/pages/edit/{id}','Admin\PagesController@edit')->name('page_edit');
        Route::post('/pages/edit/{id}','Admin\PagesController@editPage');
    
        // FILES
        Route::get('/files','Admin\FilesController@index');

        // BLOG
        Route::get('/blog','Admin\BlogController@index');
        Route::get('/blog/new','Admin\BlogController@new')->name('blog_new');
        Route::get('/blog/edit/{id}','Admin\BlogController@edit')->name('blog_edit');
        Route::post('/blog/edit/{id}','Admin\BlogController@editBlog');

        // NAVIGATION
        Route::get('/navigation','Admin\NavigationController@index');
    });
});

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
