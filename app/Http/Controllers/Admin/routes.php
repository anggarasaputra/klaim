<?php

// ------------------------------------------------------------------------
// ROUTES FOR ADMIN
// ------------------------------------------------------------------------
Route::group(['prefix' => 'admin', 'before' => 'csrf'], function() {

	$namespace = '\App\Http\Controllers\Admin\\';

	Route::get('/', ['as' => 'admin.login', 'uses' => $namespace . 'LoginController@getLogin']);
	Route::post('/', ['as' => 'admin.login.post', 'uses' => $namespace . 'LoginController@postLogin']);
	Route::get('/logout', ['as' => 'admin.logout', 'uses' => $namespace . 'LoginController@getLogout']);

	Route::group([], function() use ($namespace) {

		Route::controller('dashboard', $namespace . 'DashboardController', [
											'getOverview' => 'admin.dashboard.overview'
						]);

		$controllers = [
							'vendor'	=> 'VendorController',
					   ];
		foreach ($controllers as $k => $controller)
		{
		Route::controller($k, $namespace . $controller, [
												'getIndex' 		=> 'admin.'.$k.'.index',
												'getCreate' 	=> 'admin.'.$k.'.create',
												'postStore' 	=> 'admin.'.$k.'.store',
												'getShow' 		=> 'admin.'.$k.'.show',
												'getDelete' 	=> 'admin.'.$k.'.delete'
								]);
		}
	});
});