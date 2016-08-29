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

Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\UserController@getLogin']);
Route::post('admin/login', ['as' => 'check.admin.login', 'uses' => 'Admin\UserController@postLogin']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'UserController@logout']);
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
    Route::get('logs', ['as' => 'admin.logs', 'uses' => 'LogController@index']);

    Route::get('activities', ['middleware' => 'access:activities', 'as' => 'admin.activities', 'uses' => 'ActivityController@index']);
    Route::get('activity/add', ['middleware' => 'access:activities', 'as' => 'admin.activity.add', 'uses' => 'ActivityController@create']);
    Route::post('activity/add', ['middleware' => 'access:activities', 'as' => 'admin.activity.store', 'uses' => 'ActivityController@store']);
    Route::get('activity/edit/{id}', ['middleware' => 'access:activities', 'as' => 'admin.activity.edit', 'uses' => 'ActivityController@edit']);
    Route::post('activity/edit/{id}', ['middleware' => 'access:activities', 'as' => 'admin.activity.update', 'uses' => 'ActivityController@update']);
    Route::post('activity/change-status', ['middleware' => 'access:activities', 'as' => 'admin.activity.changestatus', 'uses' => 'ActivityController@changeStatus']);
    Route::post('activity/delete', ['middleware' => 'access:activities', 'as' => 'admin.activity.delete', 'uses' => 'ActivityController@destroy']);
    Route::post('activity/delete/attachment', ['middleware' => 'access:activities', 'as' => 'admin.activity.delete.attachment', 'uses' => 'ActivityController@destroyAttachment']);
    Route::post('activity/sort/order', ['middleware' => 'access:activities', 'as' => 'admin.activity.sort.order', 'uses' => 'ActivityController@sortOrder']);

    Route::get('albums/{id?}', ['middleware' => 'access:albums', 'as' => 'admin.albums', 'uses' => 'AlbumController@index']);
    Route::get('album/add', ['middleware' => 'access:albums', 'as' => 'admin.album.add', 'uses' => 'AlbumController@create']);
    Route::post('album/add', ['middleware' => 'access:albums', 'as' => 'admin.album.store', 'uses' => 'AlbumController@store']);
    Route::get('album/edit/{id}', ['middleware' => 'access:albums', 'as' => 'admin.album.edit', 'uses' => 'AlbumController@edit']);
    Route::post('album/edit/{id}', ['middleware' => 'access:albums', 'as' => 'admin.album.update', 'uses' => 'AlbumController@update']);
    Route::post('album/change/status', ['middleware' => 'access:albums', 'as' => 'admin.album.changestatus', 'uses' => 'AlbumController@changeStatus']);
    Route::post('album/delete', ['middleware' => 'access:albums', 'as' => 'admin.album.delete', 'uses' => 'AlbumController@destroy']);
    Route::post('album/sort/order', ['middleware' => 'access:albums', 'as' => 'admin.album.sort.order', 'uses' => 'AlbumController@sortOrder']);

    Route::get('album/{id}/galleries', ['middleware' => 'access:albums', 'as' => 'admin.album.galleries', 'uses' => 'AlbumGalleryController@index']);
    Route::get('album/{id}/gallery/add', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.add', 'uses' => 'AlbumGalleryController@create']);
    Route::post('album/{id}/gallery/add', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.store', 'uses' => 'AlbumGalleryController@store']);
    Route::get('album/gallery/edit/{id}', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.edit', 'uses' => 'AlbumGalleryController@edit']);
    Route::post('album/gallery/edit/{id}', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.update', 'uses' => 'AlbumGalleryController@update']);
    Route::post('album/gallery/change/status', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.changestatus', 'uses' => 'AlbumGalleryController@changeStatus']);
    Route::post('album/gallery/delete', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.delete', 'uses' => 'AlbumGalleryController@destroy']);
    Route::post('album/gallery/sort/order', ['middleware' => 'access:albums', 'as' => 'admin.album.gallery.sort.order', 'uses' => 'AlbumGalleryController@sortOrder']);

    Route::get('banners', ['middleware' => 'access:banners', 'as' => 'admin.banners', 'uses' => 'BannerController@index']);
    Route::get('banner/add', ['middleware' => 'access:banners', 'as' => 'admin.banner.add', 'uses' => 'BannerController@create']);
    Route::post('banner/add', ['middleware' => 'access:banners', 'as' => 'admin.banner.store', 'uses' => 'BannerController@store']);
    Route::get('banner/edit/{id}', ['middleware' => 'access:banners', 'as' => 'admin.banner.edit', 'uses' => 'BannerController@edit']);
    Route::post('banner/edit/{id}', ['middleware' => 'access:banners', 'as' => 'admin.banner.update', 'uses' => 'BannerController@update']);
    Route::post('banner/change/status', ['middleware' => 'access:banners', 'as' => 'admin.banner.changestatus', 'uses' => 'BannerController@changeStatus']);
    Route::post('banner/delete', ['middleware' => 'access:banners', 'as' => 'admin.banner.delete', 'uses' => 'BannerController@destroy']);
    Route::post('banner/sort/order', ['middleware' => 'access:banners', 'as' => 'admin.banner.sort.order', 'uses' => 'BannerController@sortOrder']);

    Route::get('contents', ['middleware' => 'access:contents', 'as' => 'admin.contents', 'uses' => 'ContentController@index']);
    Route::get('content/add', ['middleware' => 'access:contents', 'as' => 'admin.content.add', 'uses' => 'ContentController@create']);
    Route::post('content/add', ['middleware' => 'access:contents', 'as' => 'admin.content.store', 'uses' => 'ContentController@store']);
    Route::get('content/edit/{id}', ['middleware' => 'access:contents', 'as' => 'admin.content.edit', 'uses' => 'ContentController@edit']);
    Route::post('content/edit/{id}', ['middleware' => 'access:contents', 'as' => 'admin.content.update', 'uses' => 'ContentController@update']);
    Route::post('content/change/status', ['middleware' => 'access:contents', 'as' => 'admin.content.changestatus', 'uses' => 'ContentController@changeStatus']);
    Route::post('content/delete', ['middleware' => 'access:contents', 'as' => 'admin.content.delete', 'uses' => 'ContentController@destroy']);
    Route::post('content/delete/attachment', ['middleware' => 'access:contents', 'as' => 'admin.content.delete.attachment', 'uses' => 'ContentController@destroyAttachment']);
    Route::post('content/sort/order', ['middleware' => 'access:contents', 'as' => 'admin.content.sort.order', 'uses' => 'ContentController@sortOrder']);

    Route::get('destinations', ['middleware' => 'access:destinations', 'as' => 'admin.destinations', 'uses' => 'DestinationController@index']);
    Route::get('destination/add', ['middleware' => 'access:destinations', 'as' => 'admin.destination.add', 'uses' => 'DestinationController@create']);
    Route::post('destination/add', ['middleware' => 'access:destinations', 'as' => 'admin.destination.store', 'uses' => 'DestinationController@store']);
    Route::get('destination/edit/{id}', ['middleware' => 'access:destinations', 'as' => 'admin.destination.edit', 'uses' => 'DestinationController@edit']);
    Route::post('destination/edit/{id}', ['middleware' => 'access:destinations', 'as' => 'admin.destination.update', 'uses' => 'DestinationController@update']);
    Route::post('destination/change-status', ['middleware' => 'access:destinations', 'as' => 'admin.destination.changestatus', 'uses' => 'DestinationController@changeStatus']);
    Route::post('destination/delete', ['middleware' => 'access:destinations', 'as' => 'admin.destination.delete', 'uses' => 'DestinationController@destroy']);
    Route::post('destination/delete/attachment', ['middleware' => 'access:destinations', 'as' => 'admin.destination.delete.attachment', 'uses' => 'DestinationController@destroyAttachment']);
    Route::post('destination/sort/order', ['middleware' => 'access:destinations', 'as' => 'admin.destination.sort.order', 'uses' => 'DestinationController@sortOrder']);

    Route::get('news', ['middleware' => 'access:news', 'as' => 'admin.news', 'uses' => 'NewsController@index']);
    Route::get('news/add', ['middleware' => 'access:news', 'as' => 'admin.news.add', 'uses' => 'NewsController@create']);
    Route::post('news/add', ['middleware' => 'access:news', 'as' => 'admin.news.store', 'uses' => 'NewsController@store']);
    Route::get('news/edit/{id}', ['middleware' => 'access:news', 'as' => 'admin.news.edit', 'uses' => 'NewsController@edit']);
    Route::post('news/edit/{id}', ['middleware' => 'access:news', 'as' => 'admin.news.update', 'uses' => 'NewsController@update']);
    Route::post('news/change/status', ['middleware' => 'access:news', 'as' => 'admin.news.changestatus', 'uses' => 'NewsController@changeStatus']);
    Route::post('news/delete', ['middleware' => 'access:news', 'as' => 'admin.news.delete', 'uses' => 'NewsController@destroy']);
    Route::post('news/delete/attachment', ['middleware' => 'access:news', 'as' => 'admin.news.delete.attachment', 'uses' => 'NewsController@destroyAttachment']);

    Route::get('packages/{id?}', ['middleware' => 'access:packages', 'as' => 'admin.packages', 'uses' => 'PackageController@index']);
    Route::get('package/add', ['middleware' => 'access:packages', 'as' => 'admin.package.add', 'uses' => 'PackageController@create']);
    Route::post('package/add', ['middleware' => 'access:packages', 'as' => 'admin.package.store', 'uses' => 'PackageController@store']);
    Route::get('package/edit/{id}', ['middleware' => 'access:packages', 'as' => 'admin.package.edit', 'uses' => 'PackageController@edit']);
    Route::post('package/edit/{id}', ['middleware' => 'access:packages', 'as' => 'admin.package.update', 'uses' => 'PackageController@update']);
    Route::post('package/change/status', ['middleware' => 'access:packages', 'as' => 'admin.package.changestatus', 'uses' => 'PackageController@changeStatus']);
    Route::post('package/make/special', ['middleware' => 'access:packages', 'as' => 'admin.package.make.special', 'uses' => 'PackageController@makeSpecial']);
    Route::post('package/make/lastminutedeal', ['middleware' => 'access:packages', 'as' => 'admin.package.make.lastminutedeal', 'uses' => 'PackageController@makeLastMinuteDeal']);
    Route::post('package/delete', ['middleware' => 'access:packages', 'as' => 'admin.package.delete', 'uses' => 'PackageController@destroy']);
    Route::post('package/sort/order', ['middleware' => 'access:packages', 'as' => 'admin.package.sort.order', 'uses' => 'PackageController@sortOrder']);

    Route::get('package/galleries', ['middleware' => 'access:packages', 'as' => 'admin.galleries', 'uses' => 'GalleryController@all']);
    Route::get('package/{id}/galleries', ['middleware' => 'access:packages', 'as' => 'admin.package.galleries', 'uses' => 'GalleryController@index']);
    Route::get('package/{id}/gallery/add', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.add', 'uses' => 'GalleryController@create']);
    Route::post('package/{id}/gallery/add', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.store', 'uses' => 'GalleryController@store']);
    Route::get('package/gallery/edit/{id}', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.edit', 'uses' => 'GalleryController@edit']);
    Route::post('package/gallery/edit/{id}', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.update', 'uses' => 'GalleryController@update']);
    Route::post('gallery/change/status', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.changestatus', 'uses' => 'GalleryController@changeStatus']);
    Route::post('gallery/make/cover', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.makecover', 'uses' => 'GalleryController@makeCover']);
    Route::post('gallery/delete', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.delete', 'uses' => 'GalleryController@destroy']);
    Route::post('gallery/sort/order', ['middleware' => 'access:packages', 'as' => 'admin.package.gallery.sort.order', 'uses' => 'GalleryController@sortOrder']);

    Route::get('bookings', ['middleware' => 'access:bookings', 'as' => 'admin.bookings', 'uses' => 'BookingController@index']);
    Route::get('booking/{id}', ['middleware' => 'access:bookings', 'as' => 'admin.booking.view', 'uses' => 'BookingController@detail']);

    Route::get('pages', ['as' => 'admin.pages', 'uses' => 'PageController@index']);
    Route::get('page/add', ['as' => 'admin.page.add', 'uses' => 'PageController@create']);
    Route::post('page/add', ['as' => 'admin.page.store', 'uses' => 'PageController@store']);
    Route::get('page/edit/{id}', ['as' => 'admin.page.edit', 'uses' => 'PageController@edit']);
    Route::post('page/edit/{id}', ['as' => 'admin.page.update', 'uses' => 'PageController@update']);
    Route::post('page/delete', ['as' => 'admin.page.delete', 'uses' => 'PageController@destroy']);

    Route::get('roles', ['as' => 'admin.roles', 'uses' => 'RoleController@index']);
    Route::get('role/add', ['as' => 'admin.role.add', 'uses' => 'RoleController@create']);
    Route::post('role/add', ['as' => 'admin.role.store', 'uses' => 'RoleController@store']);
    Route::get('role/edit/{id}', ['as' => 'admin.role.edit', 'uses' => 'RoleController@edit']);
    Route::post('role/edit/{id}', ['as' => 'admin.role.update', 'uses' => 'RoleController@update']);
    Route::post('role/delete', ['as' => 'admin.role.delete', 'uses' => 'RoleController@destroy']);
    Route::get('role/accesslists/{id}', ['as' => 'admin.role.modules', 'uses' => 'RoleController@accessModules']);
    Route::post('role/change/access', ['as' => 'admin.role.change.access', 'uses' => 'RoleController@changeAccess']);

    Route::get('testimonials', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonials', 'uses' => 'TestimonialController@index']);
    Route::get('testimonial/add', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.add', 'uses' => 'TestimonialController@create']);
    Route::post('testimonial/add', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.store', 'uses' => 'TestimonialController@store']);
    Route::get('testimonial/edit/{id}', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.edit', 'uses' => 'TestimonialController@edit']);
    Route::post('testimonial/edit/{id}', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.update', 'uses' => 'TestimonialController@update']);
    Route::post('testimonial/change/status', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.changestatus', 'uses' => 'TestimonialController@changeStatus']);
    Route::post('testimonial/delete', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.delete', 'uses' => 'TestimonialController@destroy']);
    Route::post('testimonial/sort/order', ['middleware' => 'access:testimonials', 'as' => 'admin.testimonial.sort.order', 'uses' => 'TestimonialController@sortOrder']);

});

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getHomePage']);
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@getHomePage']);
Route::get('contact', ['as' => 'contact', 'uses' => 'HomeController@getContactPage']);
Route::post('contact', ['as' => 'contact.submit', 'uses' => 'HomeController@submitContactPage']);
Route::get('page/{slug}', ['as' => 'content.detail', 'uses' => 'HomeController@content']);

Route::get('inquiry/avia-club', ['as' => 'home.avia.inquiry', 'uses' => 'HomeController@getAviaInquiry']);
Route::post('inquiry/avia-club', ['as' => 'home.avia.inquiry', 'uses' => 'HomeController@postAviaInquiry']);

Route::get('inquiry/hotel', ['as' => 'home.hotel.inquiry', 'uses' => 'HomeController@getHotelInquiry']);
Route::post('inquiry/hotel', ['as' => 'home.hotel.inquiry', 'uses' => 'HomeController@postHotelInquiry']);


Route::get('search', ['as' => 'search', 'uses' => 'PackageController@search']);
Route::post('submit/hotel/inquiry', ['as' => 'submit.hotel.inquiry', 'uses' => 'HomeController@hotelInquiry']);
Route::post('submit/carRent/inquiry', ['as' => 'submit.carrent.inquiry', 'uses' => 'HomeController@carRentInquiry']);

Route::get('packages', ['as' => 'packages', 'uses' => 'PackageController@index']);
Route::get('lastminutedeals', ['as' => 'last.minute.deals', 'uses' => 'PackageController@deals']);
Route::get('fixed-departures', ['as' => 'fixed.departure', 'uses' => 'PackageController@fixedDepartures']);
Route::get('package/{slug}', ['as' => 'package.detail', 'uses' => 'PackageController@show']);
Route::get('package/{slug}/booking', ['as' => 'package.booking', 'uses' => 'PackageController@booking']);
Route::post('package/{slug}/booking', ['as' => 'package.booking', 'uses' => 'BookingController@postBooking']);

Route::get('package/{slug}/booking/{id}', ['as' => 'package.booking.checkout', 'uses' => 'BookingController@getCheckout']);

Route::get('package/{slug}/inquiry', ['as' => 'package.inquiry', 'uses' => 'PackageController@inquiry']);
Route::post('package/{slug}/inquiry', ['as' => 'package.inquiry', 'uses' => 'PackageController@postInquiry']);

Route::get('package/booking/{token}/success', ['as' => 'package.booking.success', 'uses' => 'BookingController@getSuccess']);
Route::get('package/booking/{token}/cancel', ['as' => 'package.booking.cancel', 'uses' => 'BookingController@getCancel']);

Route::get('destinations', ['as' => 'destinations', 'uses' => 'DestinationController@index']);
Route::get('destination/{slug}', ['as' => 'destination.detail', 'uses' => 'DestinationController@show']);

Route::get('testimonials', ['as' => 'testimonials', 'uses' => 'TestimonialsController@index']);

Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'check.login', 'uses' => 'Auth\AuthController@login']);
Route::get('forget-password', ['as' => 'user.forget.password', 'uses' => 'UserController@getForgetPasswordRequest']);
Route::post('forget-password', ['as' => 'user.forget.password','uses' => 'UserController@forgetPasswordRequest']);

Route::get('reset/{token}', array('as' => 'user.password_reset', 'uses' => 'UserController@getReset'));
Route::post('reset/{token}', array('as' => 'user.password_reset', 'uses' => 'UserController@postReset'));

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('register', ['as' => 'register', 'uses' => 'UserController@register']);
Route::post('register', ['as' => 'register', 'uses' => 'UserController@registration']);
Route::get('verify/{token}', ['as' => 'verify', 'uses' => 'UserController@verify']);
