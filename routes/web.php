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
	Route::get('/profiles/{slug}', 'ProfileController@getWithSlug')->name('getWithSlug');
	Route::get('/profile/findFriends', 'ProfileController@findFriends')->name('findFriends');
	Route::resource('/profile', 'ProfileController');


	Route::get('/admin', 'Admin\AdminController@index')->name('admin');
});
