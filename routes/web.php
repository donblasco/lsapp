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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::resource('posts', 'PostsController');

/*
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'el id es '.$id .' y el nombre es ' .$name;
});

Route::get('/hola', function () {
    return 'hola';
});

*/
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
