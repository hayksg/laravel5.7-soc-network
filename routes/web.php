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
Route::get('/locale/{name}', 'LocaleController@index')->name('locale');

Route::get('/search', 'SearchController@index')->name('search');

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('/friend',                 'FriendController@index')->name('friends');
	Route::get('/find-friends',           'FriendController@findFriends')->name('findFriends');
	Route::get('/friend-requests',        'FriendController@requests')->name('requests');
	Route::get('/friends/add/{user}',     'FriendController@add')->name('friends.add');
	Route::get('/friends/accept/{user}',  'FriendController@accept')->name('friends.accept');
	Route::post('/friends/delete/{user}', 'FriendController@delete')->name('friends.delete');
	
	Route::resource('/profile',        'ProfileController');
	Route::get('/profile/{id}/{slug}', 'ProfileController@getWithSlug')->name('getWithSlug');

	Route::get('/gallery/{id}/{slug}', 'GalleryController@index')->name('gallery');
	Route::get('/gallery/get/all/{id}',    'GalleryController@all')->name('gallery.all');
	Route::post('/gallery/add',        'GalleryController@add')->name('gallery.add');
	Route::post('/gallery/delete',     'GalleryController@delete')->name('gallery.delete');

    Route::get('/statuses', 'StatusController@index')->name('statuses');
	Route::post('/statuses', 'StatusController@postStatus')->name('post.status');
	Route::get('/statuses/{id}/{slug}', 'StatusController@getStatus')->name('get.status');

	Route::get('/search/{id}/{slug}', 'SearchController@selectedUser');
});

Route::group(['middleware' => ['auth', 'admin', 'web']], function () {
	Route::get('/admin', 'Admin\AdminController@index')->name('admin');

	Route::get('/admin/favicon',        'Admin\FaviconController@index')->name('admin.favicon');
	Route::post('/admin/favicon/store', 'Admin\FaviconController@store')->name('admin.favicon.store');

	Route::get('/admin/role-user',  'Admin\PeopleController@users')->name('admin.role.user');
	Route::get('/admin/role-admin', 'Admin\PeopleController@admins')->name('admin.role.admin');
});
