<?php

$router->group(['prefix' => 'menu', 'namespace' => 'Menu'], function () use ($router)
{
	
// 	get('type', ['as' => 'backend.dish.type', 'uses' => 'TypeController@index']);
	
	/*
	 * Dish manage controller
	 */
	resource('dish', 'DishController');
	
	Route::post('dish/search', ['as' => 'admin.menu.dish.search', 'uses' => 'DishController@search']);
	
	resource('type', 'TypeController');
	
	resource('catalogue', 'CataloguesController');
	
// 	resource('material','MaterialController');
	
	Route::post('dish/uploadphoto','DishController@uploadphoto');
	
});




