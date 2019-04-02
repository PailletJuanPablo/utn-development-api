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
Route::get('pages', 'ApiPagesAndPostsController@getPages')->name('api.pages');

Route::get('posts', 'ApiPagesAndPostsController@getPosts')->name('api.posts');
Route::get('posts/{id}', 'ApiPagesAndPostsController@getPostById')->name('api.posts');

Route::post('auth/login', 'ApiLoginController@login')->name('api.login');
Route::get('page/{id}', 'ApiPagesAndPostsController@getPageById')->name('api.page');
Route::get('pages', 'ApiPagesAndPostsController@getPages')->name('api.pages');
Route::get('ingresantes', 'ApiPagesAndPostsController@getIngresantesZone')->name('api.ingresantes');
Route::get('featured', 'ApiPagesAndPostsController@getFeatured')->name('api.featured');
Route::post('auth/me', 'ApiLoginController@login')->name('api.login');
Route::get('schools', 'ApiPagesAndPostsController@getSchools')->name('api.schools');
Route::post('set_subscriptions', 'NotificationsController@setSubscriptions')->name('api.set_subscriptions');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('pages', 'ApiPagesAndPostsController@getPages')->name('api.pages');
