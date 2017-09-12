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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('register/form/{token}', 'HomeController@register')->name('form');
Route::post('register/update', 'HomeController@update')->name('update');
Route::get('register/github', 'HomeController@redirectToProvider')->name('register');
Route::get('register/github/callback', 'HomeController@handleProviderCallback')->name('callback');
