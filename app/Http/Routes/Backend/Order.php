<?php

$router->group(['prefix' => 'order','as'=>'admin.order.', 'namespace' => 'Order'], function () use ($router)
{

	Route::get('/','OrderController@index')->name('index');
	
	Route::get('data','OrderController@data')->name('data');
// 	Route::get('test','OrderController@test')->name('test');

	Route::get('process','OrderController@process')->name('process');
	
	Route::post('orderprocess','OrderController@orderprocess');

	Route::get('data/{choice}','OrderController@datachoice');
	
	Route::get('show/{id}', 'OrderController@show')->name('show');
	
	Route::get('create','OrderController@create')->name('create');
	
	Route::post('print','OrderController@printorder')->name('print');
	
	Route::post('printreceipt','OrderController@printreceipt')->name('printreceipt');
	
	Route::post('cook','OrderController@cook')->name('cook');
	
	Route::post('finish','OrderController@finish')->name('finish');
	
	Route::post('edit','OrderController@edit')->name('edit');
	
	Route::delete('destroy/{id}','OrderController@destroy')->name('destroy');
	
// 	Route::get('destroy', function () {
// 		return "destroy";
// 	});
	
	Route::post('search','OrderController@search')->name('search');
	
	Route::post('orderprinter','OrderController@orderprinter')->name('orderprinter');
	
	Route::post('printmark','OrderController@printmark')->name('printmark');
	
	Route::get('/{tab}','OrderController@tab');
	
// 	Route::get('destroy','OrderController@destroy')->name('destroy');
});

