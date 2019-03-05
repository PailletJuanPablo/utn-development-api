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
Route::get('posts', 'ApiPagesAndPostsController@getPosts')->name('api.posts');
Route::post('auth/login', 'ApiLoginController@login')->name('api.posts');
Route::get('page/{id}', 'ApiPagesAndPostsController@getPageById')->name('api.page');
Route::get('pages', 'ApiPagesAndPostsController@getPages')->name('api.page');
Route::get('ingresantes', 'ApiPagesAndPostsController@getIngresantesZone')->name('api.posts');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
