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




/**
 * Switch between the included languages
 */
require(__DIR__ . "/Routes/Global/Lang.php");


/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router)
{
	
	
// 	require(__DIR__ . "/Routes/Frontend/Frontend.php");
	require(__DIR__ . "/Routes/Frontend/Access.php");
});


/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend'], function ()
{
	Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function ()
	{
		/**
		 * These routes need the Administrator Role
		 * or the view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
		 *
		 * If you wanted to do this in the controller it would be:
		 * $this->middleware('access.routeNeedsRoleOrPermission:{role:Administrator,permission:view_backend,redirect:/,with:flash_danger|You do not have access to do that.}');
		 *
		 * You could also do the above in the Route::group below and remove the other parameters, but I think this is easier to read here.
		 * Note: If you have both, the controller will take precedence.
		 */
		Route::group([
			'middleware' => 'access.routeNeedsRoleOrPermission',
			'role'       => ['Administrator'],
			'permission' => ['view_backend'],
			'redirect'   => '/',
			'with'       => ['flash_danger', 'You do not have access to do that.']
		], function ()
		{
// 			require(__DIR__ . "/Routes/Backend/Dashboard.php");
// 			require(__DIR__ . "/Routes/Backend/Access.php");
		});
	});
});



Route::get('/', function () {
    return view('app');
});


Route::get('home',['as'=>'home', function () {
    return view('app');
}]);
//this is for the git hub test.
//for the remote github.
//this is the second test for github remote.
//I do not known how to use this.


	Route::get('admin', function () {
		return view('backend.admin_master');
	});
	
	Route::get('test', 'TestController@index');
		
	
	
	