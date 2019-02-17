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

Route::get('/', ['as' => 'admin.login', 'uses' => 'Admin\UserController@getLogin']);
Route::post('/', ['as' => 'check.admin.login', 'uses' => 'Admin\UserController@postLogin']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    //////user

     Route::get('modules', ['middleware'=>'access:modules,access_view', 'as'=>'admin.modules', 'uses'=>'ModuleController@index'] );
    Route::get('module/add', ['middleware'=>'access:modules,access_add', 'as'=>'admin.module.add', 'uses'=>'ModuleController@add'] );
    Route::post('module/add', ['as'=>'admin.module.addpost', 'uses'=>'ModuleController@create'] );

    Route::post('module/change-status', ['middleware'=>'access:modules,access_update', 'as'=>'admin.module.change_status', 'uses'=>'ModuleController@changeStatus'] );

    // user type route
    Route::get('usertypes', ['middleware'=>'access:user-type,access_view', 'as'=>'admin.usertypes', 'uses'=>'UserTypeController@index'] );
    Route::get('usertype/add', ['middleware'=>'access:user-type,access_add', 'as'=>'admin.usertype.add', 'uses'=>'UserTypeController@add'] );
    Route::post('usertype/add', ['as'=>'admin.usertype.addpost', 'uses'=>'UserTypeController@create'] );
    Route::get('usertype/edit/{id}', ['middleware'=>'access:user-type,access_update', 'as'=>'admin.usertype.edit', 'uses'=>'UserTypeController@edit'] );
    Route::post('usertype/edit/{id}', ['middleware'=>'access:user-type,access_update','as'=>'admin.usertype.editpost', 'uses'=>'UserTypeController@update'] );
    Route::post('usertype/delete', ['middleware'=>'access:user-type,access_delete', 'as'=>'admin.usertype.delete', 'uses'=>'UserTypeController@destroy'] );
    Route::post('usertype/change-status', ['middleware'=>'access:user-type,access_publish', 'as'=>'admin.usertype.publish', 'uses'=>'UserTypeController@changeStatus'] );
    
    Route::get('usertype/trashes', ['middleware'=>'access:user-type,access_trash', 'as'=>'admin.usertype.trashes', 'uses'=>'UserTypeController@trashes'] );
    Route::post('usertype/reterive', ['middleware'=>'access:user-type,access_reterive', 'as'=>'admin.usertype.reterive', 'uses'=>'UserTypeController@reterive'] );

    // access route
    Route::get('accesslist/{id}', ['as'=>'admin.accesslist', 'uses'=>'UserTypeController@accesslist'] );
    Route::post('change-access', ['as'=>'admin.change-access', 'uses'=>'UserTypeController@changeAccess'] );

    //user...
     Route::get('/users', ['middleware' => 'access:users,access_view', 'as' => 'admin.users.index', 'uses' => 'UserController@index']);
      Route::get('/usertype/{id}', ['middleware' => 'access:users,access_view', 'as' => 'admin.users.type.index', 'uses' => 'UserController@userindex']);

      
    Route::get('add', ['middleware' => 'access:users,access_add', 'as' => 'admin.users.add', 'uses' => 'UserController@add']);
  
    Route::post('add',['middleware' =>'access:users,access_add','as' => 'admin.users.add', 'uses' => 'UserController@create']);
    Route::post('change-status', ['middleware' => 'access:users,access_publish', 'as' => 'admin.user.change_status', 'uses' => 'UserController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:users,access_delete', 'as' => 'admin.user.delete', 'uses' => 'UserController@delete']);
    Route::get('change-password', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.change_password', 'uses' => 'UserController@changePasswordRequest']);
    Route::post('change-password', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.change_password', 'uses' => 'UserController@changePassword']);
    Route::get('profile', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.profile', 'uses' => 'UserController@updateProfileRequest']);
    Route::post('profile', ['middleware' => 'access:users,access_update', 'as' => 'admin.users.profile', 'uses' => 'UserController@updateProfile']);




  Route::get('/test', ['middleware' => 'access:users,access_view', 'as' => 'admin.test.index', 'uses' => 'TestController@index']);
    

    //////
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'UserController@logout']);
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
    Route::get('logs', ['as' => 'admin.logs', 'uses' => 'LogController@index']);


});

// Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getHomePage']);
// Route::get('home', ['as' => 'home', 'uses' => 'HomeController@getHomePage']);



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


// Route::any('{query}',function() { 
// 	return redirect('/');
// })->where('query', '.*');