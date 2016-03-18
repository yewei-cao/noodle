<?php
/**
 * Frontend Controllers
 */
// get('/', 'FrontendController@index')->name('home');

Route::get('/', function () {
	return view('frontend.home.index');
});


$router->group(['prefix' => 'home', 'namespace' => 'Home'], function () use ($router)
{
	Route::get('/', ['as' => 'home',function () {
		return view('frontend.home.index');
	}]);
	
	/*
	 * Product Menu Page
	 * 
	 */
	
	$router->group(['prefix' => 'menu', 'as'=>'home.menu.'],function () use ($router){
		Route::get('/', 'menuController@index')->name('index');
		Route::post('addtoorder','menuController@addtoorder');
		Route::post('removetoorder','menuController@removetoorder');
		
	});
	
	
	$router->group(['prefix' => 'pickup', 'namespace' => 'Pickup'], function () use ($router)
	{
// 		Route::get('/', ['as' => 'pickup',function () {
// 			return view('frontend.home.pickup');
// 		}]);
		
		
		Route::get('details','pickupController@details')->name('home.pick.details');

		Route::get('/','pickupController@index')->name('home.pick.info');
		
		Route::get('pickup_details','pickupController@pickup_details');
		
// 		Route::get('pickup_details', ['as' => 'pickup',function () {
// 			return 'something';
// 		}]);
		
// 		get('users/banned', 'UserController@banned')->name('admin.access.users.banned');
		
		Route::get('saveordertime','pickupController@saveordertime');
		
		Route::post('ordertime', ['as' => 'home.pickup.ordertime', 'uses' => 'pickupController@ordertime']);
	
		Route::post('save_asap','pickupController@save_asap');
		
	});
// 	Route::get('pickup',['as'=>'Pickup', function () {
	
// 		return view('frontend.home.pickup');
// 	}]);
	
});

// Route::post('material/search', ['as' => 'admin.menu.material.search', 'uses' => 'MaterialController@search']);

/**
 * These frontend controllers require the user to be logged in
*/
$router->group(['middleware' => 'auth'], function ()
{
// 	get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
// 	get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
// 	patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');
});
