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


Route::get('/', 'HomeController@index')->name('home');

Route::get('registered/users', 'HomeController@users')->name('users');

Route::get('register/form/{token}', 'HomeController@register')->name('form');

Route::put('register/{token}/update', 'HomeController@update')->name('update');

Route::get('register/github', 'HomeController@redirectToProvider')->name('register');

Route::get('register/github/callback', 'HomeController@handleProviderCallback')->name('callback');

Route::post('contact/store', 'HomeController@contact')->name('contact');

Route::post('feedback/store', 'HomeController@feedback')->name('feedback');
