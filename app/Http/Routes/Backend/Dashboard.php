<?php

get('dashboard', ['as' => 'backend.dashboard', 'uses' => 'DashboardController@index']);

$router->group(['prefix' => 'manage', 'namespace' => 'Manage'], function () use ($router)
{
	
	Route::get('/','ManageController@index')->name('admin.manage.index');
	
	Route::get('printer','PrinterController@index')->name('admin.manage.printer');
	
	Route::patch('update/{id}','ManageController@update')->name('admin.manage.update');
	
// 	Route::get('create','OrderController@create')->name('create');
	
	resource('blacklist','BlacklistController');
	/*
	 * example
	 */
// 	Route::post('print','OrderController@printorder')->name('print');
	
});