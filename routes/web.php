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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('/profile/{slug}', 'ProfileController@index')->name('profile');

	Route::get('/admin', 'Admin\AdminController@index')->name('admin');
});
