<?php

$router->group(['prefix' => 'order','as'=>'admin.order.', 'namespace' => 'Order'], function () use ($router)
{
	
	Route::get('/','OrderController@index')->name('index');
	Route::get('test','OrderController@test')->name('test');
	
	Route::get('show/{id}', 'OrderController@show')->name('show');
	
	Route::get('create','OrderController@create')->name('create');
	
	Route::post('print','OrderController@printorder')->name('print');
	
	Route::post('cook','OrderController@cook')->name('cook');
	
	Route::post('finish','OrderController@finish')->name('finish');
	
	Route::get('edit','OrderController@edit')->name('edit');
	
	Route::get('destroy','OrderController@destroy')->name('destroy');
	
	Route::post('search','OrderController@search')->name('search');
	
	Route::post('orderprinter','OrderController@orderprinter')->name('orderprinter');
	
	Route::post('printmark','OrderController@printmark')->name('printmark');
	
	Route::get('/{tab}','OrderController@tab');
	
// 	Route::get('destroy','OrderController@destroy')->name('destroy');
});

