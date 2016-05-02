<?php
$router->group(['prefix' => 'element', 'namespace' => 'Element'], function () use ($router)
{

	Route::post('material/search', ['as' => 'admin.menu.material.search', 'uses' => 'MaterialController@search']);
	
	resource('material','MaterialController');
	
	resource('type', 'Material_typeController');
	
	resource('mgroup', 'MgroupController');

 	Route::post('material/uploadphoto','MaterialController@uploadphoto');

});

