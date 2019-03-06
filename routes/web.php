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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('schools', 'SchoolController');
Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostController');
Route::resource('pages', 'PagesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('terms', function(){
    return view('terms');
});
