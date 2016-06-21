<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', ['as'=>'admin.login','uses'=>'Admin\UserController@getLogin']);
Route::post('admin/login', ['as'=>'check.admin.login','uses'=>'Admin\UserController@postLogin']);

Route::group(['prefix'=>'admin','middleware' => 'admin'], function () {
	Route::get('logout', ['as'=>'admin.logout', 'uses'=>'Admin\UserController@logout']);
	Route::get('dashboard', ['as'=>'admin.dashboard','uses'=>'Admin\AdminController@index']);
	
	Route::get('banners', ['as'=>'admin.banners', 'uses'=>'Admin\BannerController@index']);
	Route::get('banner/add', ['as'=>'admin.banner.add', 'uses'=>'Admin\BannerController@create']);
	Route::post('banner/add', ['as'=>'admin.banner.store', 'uses'=>'Admin\BannerController@store']);
	Route::get('banner/edit/{id}', ['as'=>'admin.banner.edit', 'uses'=>'Admin\BannerController@edit']);
	Route::post('banner/edit/{id}', ['as'=>'admin.banner.update', 'uses'=>'Admin\BannerController@update']);
	Route::post('banner/change/status', ['as'=>'admin.banner.changestatus', 'uses'=>'Admin\BannerController@changeStatus']);
	Route::post('banner/delete', ['as'=>'admin.banner.delete', 'uses'=>'Admin\BannerController@destroy']);
	Route::post('banner/sort/order', ['as'=>'admin.banner.sort.order', 'uses'=>'Admin\BannerController@sortOrder']);
	
	Route::get('contents', ['as'=>'admin.contents', 'uses'=>'Admin\ContentController@index']);
	Route::get('content/add', ['as'=>'admin.content.add', 'uses'=>'Admin\ContentController@create']);
	Route::post('content/add', ['as'=>'admin.content.store', 'uses'=>'Admin\ContentController@store']);
	Route::get('content/edit/{id}', ['as'=>'admin.content.edit', 'uses'=>'Admin\ContentController@edit']);
	Route::post('content/edit/{id}', ['as'=>'admin.content.update', 'uses'=>'Admin\ContentController@update']);
	Route::post('content/change/status', ['as'=>'admin.content.changestatus', 'uses'=>'Admin\ContentController@changeStatus']);
	Route::post('content/delete', ['as'=>'admin.content.delete', 'uses'=>'Admin\ContentController@destroy']);
	Route::post('content/delete/attachment', ['as'=>'admin.content.delete.attachment', 'uses'=>'Admin\ContentController@destroyAttachment']);
	Route::post('content/sort/order', ['as'=>'admin.content.sort.order', 'uses'=>'Admin\ContentController@sortOrder']);
	
	Route::get('destinations', ['as'=>'admin.destinations', 'uses'=>'Admin\DestinationController@index']);
	Route::get('destination/add', ['as'=>'admin.destination.add', 'uses'=>'Admin\DestinationController@create']);
	Route::post('destination/add', ['as'=>'admin.destination.store', 'uses'=>'Admin\DestinationController@store']);
	Route::get('destination/edit/{id}', ['as'=>'admin.destination.edit', 'uses'=>'Admin\DestinationController@edit']);
	Route::post('destination/edit/{id}', ['as'=>'admin.destination.update', 'uses'=>'Admin\DestinationController@update']);
	Route::post('destination/change-status', ['as'=>'admin.destination.changestatus', 'uses'=>'Admin\DestinationController@changeStatus']);
	Route::post('destination/delete', ['as'=>'admin.destination.delete', 'uses'=>'Admin\DestinationController@destroy']);
	Route::post('destination/delete/attachment', ['as'=>'admin.destination.delete.attachment', 'uses'=>'Admin\DestinationController@destroyAttachment']);
	Route::post('destination/sort/order', ['as'=>'admin.destination.sort.order', 'uses'=>'Admin\DestinationController@sortOrder']);
	
	Route::get('packages', ['as'=>'admin.packages', 'uses'=>'Admin\PackageController@index']);
	Route::get('package/add', ['as'=>'admin.package.add', 'uses'=>'Admin\PackageController@create']);
	Route::post('package/add', ['as'=>'admin.package.store', 'uses'=>'Admin\PackageController@store']);
	Route::get('package/edit/{id}', ['as'=>'admin.package.edit', 'uses'=>'Admin\PackageController@edit']);
	Route::post('package/edit/{id}', ['as'=>'admin.package.update', 'uses'=>'Admin\PackageController@update']);
	Route::post('package/change/status', ['as'=>'admin.package.changestatus', 'uses'=>'Admin\PackageController@changeStatus']);
	Route::post('package/make/special', ['as'=>'admin.package.make.special', 'uses'=>'Admin\PackageController@makeSpecial']);
	Route::post('package/delete', ['as'=>'admin.package.delete', 'uses'=>'Admin\PackageController@destroy']);
	Route::post('package/sort/order', ['as'=>'admin.package.sort.order', 'uses'=>'Admin\PackageController@sortOrder']);
	
	Route::get('package/galleries', ['as'=>'admin.galleries', 'uses'=>'Admin\GalleryController@all']);
	Route::get('package/{id}/galleries', ['as'=>'admin.package.galleries', 'uses'=>'Admin\GalleryController@index']);
	Route::get('package/{id}/gallery/add', ['as'=>'admin.package.gallery.add', 'uses'=>'Admin\GalleryController@create']);
	Route::post('package/{id}/gallery/add', ['as'=>'admin.package.gallery.store', 'uses'=>'Admin\GalleryController@store']);
	Route::get('package/gallery/edit/{id}', ['as'=>'admin.package.gallery.edit', 'uses'=>'Admin\GalleryController@edit']);
	Route::post('package/gallery/edit/{id}', ['as'=>'admin.package.gallery.update', 'uses'=>'Admin\GalleryController@update']);
	Route::post('gallery/change/status', ['as'=>'admin.package.gallery.changestatus', 'uses'=>'Admin\GalleryController@changeStatus']);
	Route::post('gallery/make/cover', ['as'=>'admin.package.gallery.makecover', 'uses'=>'Admin\GalleryController@makeCover']);
	Route::post('gallery/delete', ['as'=>'admin.package.gallery.delete', 'uses'=>'Admin\GalleryController@destroy']);
	Route::post('gallery/sort/order', ['as'=>'admin.package.gallery.sort.order', 'uses'=>'Admin\GalleryController@sortOrder']);
});
Route::get('/', ['as'=>'home', 'uses'=>'HomeController@getHomePage']);
Route::get('home', ['as'=>'home','uses'=>'HomeController@getHomePage']);
Route::get('contact', ['as'=>'contact','uses'=>'HomeController@getContactPage']);
Route::post('contact', ['as'=>'contact.submit','uses'=>'HomeController@submitContactPage']);
Route::get('page/{slug}', ['as'=>'content.detail','uses'=>'HomeController@content']);

Route::get('packages', ['as'=>'packages','uses'=>'PackageController@index']);
Route::get('lastminutedeals', ['as'=>'last.minute.deals','uses'=>'PackageController@deals']);
Route::get('package/{slug}', ['as'=>'package.detail','uses'=>'PackageController@show']);
Route::get('package/{slug}/booking', ['as'=>'package.booking','uses'=>'PackageController@booking']);
Route::post('package/{slug}/booking', ['as'=>'package.booking','uses'=>'BookingController@getCheckout']);

Route::get('package/booking/{token}/success', ['as'=>'package.booking.success','uses'=>'BookingController@getSuccess']);
Route::post('package/booking/{token}/cancel', ['as'=>'package.booking.cancel','uses'=>'BookingController@getCancel']);

Route::get('destinations', ['as'=>'destinations','uses'=>'DestinationController@index']);
Route::get('destination/{slug}', ['as'=>'destination.detail','uses'=>'DestinationController@show']);

Route::get('login', ['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
Route::post('login', ['as'=>'check.login','uses'=>'Auth\AuthController@login']);
Route::get('logout', ['as'=>'logout','middleware' => 'customer','uses'=>'Auth\AuthController@logout']);

Route::get('register', ['as'=>'register','uses'=>'UserController@register']);
Route::post('register', ['as'=>'register','uses'=>'UserController@registration']);
Route::get('verify/{token}', ['as'=>'verify','uses'=>'UserController@verify']);
