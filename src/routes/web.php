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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/today', 'DailyZodiacController@today');
Route::get('/yesterday', 'DailyZodiacController@yesterday');


//google auth login
Route::get('/auth/google', 'Auth\LoginController@googleAuthenticate')->name('auth.google');
Route::get('/auth/google/callback', 'Auth\LoginController@googleAccountCallback');
