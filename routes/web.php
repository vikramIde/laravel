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
    return view('home');
})->middleware('auth');

Route::get('/customer', function () {
    return view('home');
})->middleware('auth');

Route::get('/admin', function () {
    return view('home');
})->middleware('auth');

Route::get('/form', function () {
    return view('form');
})->middleware('auth','customer');

Route::get('/user-list', function () {
    return view('user-details');
})->middleware('auth','admin');

Route::get('/form', function () {
    return view('form');
})->middleware('auth','customer');

Route::get('auth/logout', 'Auth\AuthController@logout')->name('getlogout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
