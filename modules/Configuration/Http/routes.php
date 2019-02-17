<?php

Route::group(['prefix' => 'admin/configuration', 'middleware'=>'admin', 'namespace' => 'Modules\Configuration\Http\Controllers'], function()
{
	// module routes
	Route::get('modules', ['middleware'=>'access:modules,access_view', 'as'=>'admin.modules', 'uses'=>'ModuleController@index'] );
	Route::get('module/add', ['middleware'=>'access:modules,access_add', 'as'=>'admin.module.add', 'uses'=>'ModuleController@add'] );
	Route::post('module/add', ['as'=>'admin.module.addpost', 'uses'=>'ModuleController@create'] );

	Route::post('module/change-status', ['middleware'=>'access:modules,access_update', 'as'=>'admin.module.change_status', 'uses'=>'ModuleController@changeStatus'] );

	// user type route
	Route::get('usertypes', ['middleware'=>'access:user-type,access_view', 'as'=>'admin.usertypes', 'uses'=>'UserTypeController@index'] );
	Route::get('usertype/add', ['middleware'=>'access:user-type,access_add', 'as'=>'admin.usertype.add', 'uses'=>'UserTypeController@add'] );
	Route::post('usertype/add', ['as'=>'admin.usertype.addpost', 'uses'=>'UserTypeController@create'] );
	Route::get('usertype/edit/{id}', ['middleware'=>'access:user-type,access_update', 'as'=>'admin.usertype.edit', 'uses'=>'UserTypeController@edit'] );
	Route::post('usertype/edit/{id}', ['as'=>'admin.usertype.editpost', 'uses'=>'UserTypeController@update'] );
	Route::post('usertype/delete', ['middleware'=>'access:user-type,access_delete', 'as'=>'admin.usertype.delete', 'uses'=>'UserTypeController@delete'] );
	Route::post('usertype/change-status', ['middleware'=>'access:user-type,access_publish', 'as'=>'admin.usertype.publish', 'uses'=>'UserTypeController@changeStatus'] );
	
	Route::get('usertype/trashes', ['middleware'=>'access:user-type,access_trash', 'as'=>'admin.usertype.trashes', 'uses'=>'UserTypeController@trashes'] );
	Route::post('usertype/reterive', ['middleware'=>'access:user-type,access_reterive', 'as'=>'admin.usertype.reterive', 'uses'=>'UserTypeController@reterive'] );

	// access route
	Route::get('accesslist/{id}', ['as'=>'admin.accesslist', 'uses'=>'UserTypeController@accesslist'] );
	Route::post('change-access', ['as'=>'admin.change-access', 'uses'=>'UserTypeController@changeAccess'] );

});