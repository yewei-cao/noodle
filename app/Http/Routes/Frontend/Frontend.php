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
	
	
	$router->group(['prefix' => 'pickup', 'namespace' => 'Pickup','as' => 'home.'], function () use ($router)
	{
		Route::get('/', ['as' => 'pickup',function () {
			return view('frontend.home.pickup');
		}]);
		
		Route::post('pickup_details','pickupController@pickup_details');
		
		Route::get('details','pickupController@details');
		
		Route::post('ordertime', ['as' => 'home.pickup.ordertime', 'uses' => 'pickupController@ordertime']);
	
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
