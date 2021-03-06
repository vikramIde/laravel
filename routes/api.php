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

Route::get('get_product', 'ProductController@get_product');
Route::get('get_users', 'UserController@get_users');
Route::get('delete_users/{id}', 'UserController@delete_users');
Route::post('store_product', 'ProductController@store_product');