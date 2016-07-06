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

Route::group(['prefix'=>'admin','middleware' => 'admin','namespace' => 'Admin'], function () {
	Route::get('logout', ['as'=>'admin.logout', 'uses'=>'UserController@logout']);
	Route::get('dashboard', ['as'=>'admin.dashboard','uses'=>'AdminController@index']);
	
	Route::get('activities', ['as'=>'admin.activities', 'uses'=>'ActivityController@index']);
	Route::get('activity/add', ['as'=>'admin.activity.add', 'uses'=>'ActivityController@create']);
	Route::post('activity/add', ['as'=>'admin.activity.store', 'uses'=>'ActivityController@store']);
	Route::get('activity/edit/{id}', ['as'=>'admin.activity.edit', 'uses'=>'ActivityController@edit']);
	Route::post('activity/edit/{id}', ['as'=>'admin.activity.update', 'uses'=>'ActivityController@update']);
	Route::post('activity/change-status', ['as'=>'admin.activity.changestatus', 'uses'=>'ActivityController@changeStatus']);
	Route::post('activity/delete', ['as'=>'admin.activity.delete', 'uses'=>'ActivityController@destroy']);
	Route::post('activity/delete/attachment', ['as'=>'admin.activity.delete.attachment', 'uses'=>'ActivityController@destroyAttachment']);
	Route::post('activity/sort/order', ['as'=>'admin.activity.sort.order', 'uses'=>'ActivityController@sortOrder']);
	
	Route::get('banners', ['as'=>'admin.banners', 'uses'=>'BannerController@index']);
	Route::get('banner/add', ['as'=>'admin.banner.add', 'uses'=>'BannerController@create']);
	Route::post('banner/add', ['as'=>'admin.banner.store', 'uses'=>'BannerController@store']);
	Route::get('banner/edit/{id}', ['as'=>'admin.banner.edit', 'uses'=>'BannerController@edit']);
	Route::post('banner/edit/{id}', ['as'=>'admin.banner.update', 'uses'=>'BannerController@update']);
	Route::post('banner/change/status', ['as'=>'admin.banner.changestatus', 'uses'=>'BannerController@changeStatus']);
	Route::post('banner/delete', ['as'=>'admin.banner.delete', 'uses'=>'BannerController@destroy']);
	Route::post('banner/sort/order', ['as'=>'admin.banner.sort.order', 'uses'=>'BannerController@sortOrder']);
	
	Route::get('contents', ['as'=>'admin.contents', 'uses'=>'ContentController@index']);
	Route::get('content/add', ['as'=>'admin.content.add', 'uses'=>'ContentController@create']);
	Route::post('content/add', ['as'=>'admin.content.store', 'uses'=>'ContentController@store']);
	Route::get('content/edit/{id}', ['as'=>'admin.content.edit', 'uses'=>'ContentController@edit']);
	Route::post('content/edit/{id}', ['as'=>'admin.content.update', 'uses'=>'ContentController@update']);
	Route::post('content/change/status', ['as'=>'admin.content.changestatus', 'uses'=>'ContentController@changeStatus']);
	Route::post('content/delete', ['as'=>'admin.content.delete', 'uses'=>'ContentController@destroy']);
	Route::post('content/delete/attachment', ['as'=>'admin.content.delete.attachment', 'uses'=>'ContentController@destroyAttachment']);
	Route::post('content/sort/order', ['as'=>'admin.content.sort.order', 'uses'=>'ContentController@sortOrder']);
	
	Route::get('destinations', ['as'=>'admin.destinations', 'uses'=>'DestinationController@index']);
	Route::get('destination/add', ['as'=>'admin.destination.add', 'uses'=>'DestinationController@create']);
	Route::post('destination/add', ['as'=>'admin.destination.store', 'uses'=>'DestinationController@store']);
	Route::get('destination/edit/{id}', ['as'=>'admin.destination.edit', 'uses'=>'DestinationController@edit']);
	Route::post('destination/edit/{id}', ['as'=>'admin.destination.update', 'uses'=>'DestinationController@update']);
	Route::post('destination/change-status', ['as'=>'admin.destination.changestatus', 'uses'=>'DestinationController@changeStatus']);
	Route::post('destination/delete', ['as'=>'admin.destination.delete', 'uses'=>'DestinationController@destroy']);
	Route::post('destination/delete/attachment', ['as'=>'admin.destination.delete.attachment', 'uses'=>'DestinationController@destroyAttachment']);
	Route::post('destination/sort/order', ['as'=>'admin.destination.sort.order', 'uses'=>'DestinationController@sortOrder']);
	
	Route::get('packages', ['as'=>'admin.packages', 'uses'=>'PackageController@index']);
	Route::get('package/add', ['as'=>'admin.package.add', 'uses'=>'PackageController@create']);
	Route::post('package/add', ['as'=>'admin.package.store', 'uses'=>'PackageController@store']);
	Route::get('package/edit/{id}', ['as'=>'admin.package.edit', 'uses'=>'PackageController@edit']);
	Route::post('package/edit/{id}', ['as'=>'admin.package.update', 'uses'=>'PackageController@update']);
	Route::post('package/change/status', ['as'=>'admin.package.changestatus', 'uses'=>'PackageController@changeStatus']);
	Route::post('package/make/special', ['as'=>'admin.package.make.special', 'uses'=>'PackageController@makeSpecial']);
	Route::post('package/make/lastminutedeal', ['as'=>'admin.package.make.lastminutedeal', 'uses'=>'PackageController@makeLastMinuteDeal']);
	Route::post('package/delete', ['as'=>'admin.package.delete', 'uses'=>'PackageController@destroy']);
	Route::post('package/sort/order', ['as'=>'admin.package.sort.order', 'uses'=>'PackageController@sortOrder']);
	
	Route::get('package/galleries', ['as'=>'admin.galleries', 'uses'=>'GalleryController@all']);
	Route::get('package/{id}/galleries', ['as'=>'admin.package.galleries', 'uses'=>'GalleryController@index']);
	Route::get('package/{id}/gallery/add', ['as'=>'admin.package.gallery.add', 'uses'=>'GalleryController@create']);
	Route::post('package/{id}/gallery/add', ['as'=>'admin.package.gallery.store', 'uses'=>'GalleryController@store']);
	Route::get('package/gallery/edit/{id}', ['as'=>'admin.package.gallery.edit', 'uses'=>'GalleryController@edit']);
	Route::post('package/gallery/edit/{id}', ['as'=>'admin.package.gallery.update', 'uses'=>'GalleryController@update']);
	Route::post('gallery/change/status', ['as'=>'admin.package.gallery.changestatus', 'uses'=>'GalleryController@changeStatus']);
	Route::post('gallery/make/cover', ['as'=>'admin.package.gallery.makecover', 'uses'=>'GalleryController@makeCover']);
	Route::post('gallery/delete', ['as'=>'admin.package.gallery.delete', 'uses'=>'GalleryController@destroy']);
	Route::post('gallery/sort/order', ['as'=>'admin.package.gallery.sort.order', 'uses'=>'GalleryController@sortOrder']);

	Route::get('package/{id}/galleriestest', ['as'=>'admin.package.galleries.test', 'uses'=>'GalleryController@indextest']);
	Route::post('package/gallery/addtest', ['as'=>'admin.package.galleries.add', 'uses'=>'GalleryController@storeTest']);
	
	Route::get('bookings',['as'=>'admin.bookings','uses'=>'BookingController@index']);
	Route::get('booking/{id}',['as'=>'admin.booking.view','uses'=>'BookingController@detail']);

	Route::get('testimonials', ['as'=>'admin.testimonials', 'uses'=>'TestimonialController@index']);
	Route::get('testimonial/add', ['as'=>'admin.testimonial.add', 'uses'=>'TestimonialController@create']);
	Route::post('testimonial/add', ['as'=>'admin.testimonial.store', 'uses'=>'TestimonialController@store']);
	Route::get('testimonial/edit/{id}', ['as'=>'admin.testimonial.edit', 'uses'=>'TestimonialController@edit']);
	Route::post('testimonial/edit/{id}', ['as'=>'admin.testimonial.update', 'uses'=>'TestimonialController@update']);
	Route::post('testimonial/change/status', ['as'=>'admin.testimonial.changestatus', 'uses'=>'TestimonialController@changeStatus']);
	Route::post('testimonial/delete', ['as'=>'admin.testimonial.delete', 'uses'=>'TestimonialController@destroy']);
	Route::post('testimonial/sort/order', ['as'=>'admin.testimonial.sort.order', 'uses'=>'TestimonialController@sortOrder']);
	
});
Route::get('/', ['as'=>'home', 'uses'=>'HomeController@getHomePage']);
Route::get('home', ['as'=>'home','uses'=>'HomeController@getHomePage']);
Route::get('contact', ['as'=>'contact','uses'=>'HomeController@getContactPage']);
Route::post('contact', ['as'=>'contact.submit','uses'=>'HomeController@submitContactPage']);
Route::get('page/{slug}', ['as'=>'content.detail','uses'=>'HomeController@content']);

Route::post('search', ['as'=>'search.post','uses'=>'PackageController@search']);
Route::post('submit/hotel/inquiry', ['as'=>'submit.hotel.inquiry','uses'=>'HomeController@hotelInquiry']);
Route::post('submit/carRent/inquiry', ['as'=>'submit.carrent.inquiry','uses'=>'HomeController@carRentInquiry']);

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
Route::get('logout/hait', ['as'=>'logout','uses'=>'Auth\AuthController@logoutt']);

Route::get('register', ['as'=>'register','uses'=>'UserController@register']);
Route::post('register', ['as'=>'register','uses'=>'UserController@registration']);
Route::get('verify/{token}', ['as'=>'verify','uses'=>'UserController@verify']);


// Route::any('{query}',function() { 
// 	return redirect('/');
// })->where('query', '.*');