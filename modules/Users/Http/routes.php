<?php

/*
 * Users Modules routes
 */

Route::group(['prefix' => 'admin/users', 'middleware' => 'admin', 'namespace' => 'Modules\Users\Http\Controllers\Admin'], function () {
    Route::get('/users', ['middleware' => 'access:users,access_view', 'as' => 'admin.users.index', 'uses' => 'UsersController@index']);
    Route::get('add', ['middleware' => 'access:users,access_add', 'as' => 'admin.users.add', 'uses' => 'UsersController@add']);
    Route::post('add',['middleware' =>'access:users,access_add','as' => 'admin.users.add', 'uses' => 'UsersController@create']);
    Route::post('change-status', ['middleware' => 'access:users,access_publish', 'as' => 'admin.user.change_status', 'uses' => 'UsersController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:users,access_delete', 'as' => 'admin.user.delete', 'uses' => 'UsersController@delete']);
    Route::get('change-password', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.change_password', 'uses' => 'UsersController@changePasswordRequest']);
    Route::post('change-password', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.change_password', 'uses' => 'UsersController@changePassword']);
    Route::get('profile', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.profile', 'uses' => 'UsersController@updateProfileRequest']);
    Route::post('profile', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.profile', 'uses' => 'UsersController@updateProfile']);
});