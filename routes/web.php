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

	Route::resource('/friend', 'FriendController', [
		'names' => [
			'index' => 'friends',
		]
	]);
	
	Route::get('/find-friends',        'FriendshipController@findFriends')->name('findFriends');
	Route::get('/friend-requests',     'FriendshipController@requests')->name('requests');
	Route::resource('/friendship',     'FriendshipController');
	
	Route::resource('/profile',        'ProfileController');
	Route::get('/profile/{id}/{slug}', 'ProfileController@getWithSlug')->name('getWithSlug');

	Route::get('/admin', 'Admin\AdminController@index')->name('admin');

	Route::get('/admin/favicon',        'Admin\FaviconController@index')->name('admin.favicon');
	Route::post('/admin/favicon/store', 'Admin\FaviconController@store')->name('admin.favicon.store');
	
});
