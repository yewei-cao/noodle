<?php
/**
 * Frontend Controllers
 */
$router->group([
    'namespace' => 'Home'
], function () use ($router) {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('menu', 'HomeController@menu')->name('menu');
    Route::get('privacy-policy', 'HomeController@policy')->name('policy');
});

$router->group([
    'prefix' => 'menu',
    'namespace' => 'Home',
    'as' => 'menu.'
], function () use ($router) {
    Route::get('/', 'HomeController@menu')->name('index');
    Route::get('/dish/{dish}', 'HomeController@dish')->name('dish');
    Route::post('search', 'HomeController@search');
    Route::get('/{types}', 'HomeController@types')->name('types');
});

$router->group([
    'prefix' => 'home',
    'namespace' => 'Home'
], function () use ($router) {
    Route::get('/', 'HomeController@index')->name('home');
    /*
     * Product Menu Page
     */
    $router->group([
        'prefix' => 'menu',
        'as' => 'home.menu.'
    ], function () use ($router) {
        Route::get('/', 'menuController@index')->name('index');
        Route::post('addtoorder', 'menuController@addtoorder');
        Route::post('search', 'menuController@search');
        Route::get('/mobilecsrf', function () {
            return csrf_token();
        });
        Route::get('/{types}', 'menuController@types')->name('types');
        Route::post('voucherapply', 'menuController@voucherapply');
        Route::post('usevoucher', 'menuController@usevoucher');
        Route::post('removevoucher', 'menuController@removevoucher');
        Route::post('removetoorder', 'menuController@removetoorder');
    });
    
    $router->group([
        'prefix' => 'dish',
        'as' => 'home.dish.'
    ], function () use ($router) {
        Route::get('/{dish}', 'menuController@dish')->name('index');
        Route::post('adddish', 'menuController@adddish')->name('adddish');
    });
    
//     $router->group([
//         'prefix' => 'quickorder',
//         'namespace' => 'Quickorder',
//         'middleware' => 'auth'
//     ], function () use ($router) {
//         Route::get('/', 'quickorderController@index')->name('home.quickorder');
//         Route::get('create', 'quickorderController@create')->name('home.quickorder.create');
//         Route::get('cloneorder', 'quickorderController@cloneorder')->name('home.quickorder.cloneorder');
//     });
    
//     $router->group([
//         'prefix' => 'delivery',
//         'namespace' => 'Delivery'
//     ], function () use ($router) {
//         Route::get('/', 'deliveryController@index')->name('home.delivery.info');
//         Route::get('delivery_details', 'deliveryController@delivery_details');
//         /* temporary stop the delivery and quickorder */
//         Route::get('confirm', 'deliveryController@confirm')->name('home.delivery.confirm');
//         Route::get('address', 'deliveryController@address_confirm')->name('home.delivery.address');
//         Route::get('saveordertime', 'deliveryController@saveordertime');
//     });
    
    $router->group([
        'prefix' => 'ordertime',
        'namespace' => 'Ordertime'
    ], function () use ($router) {
        Route::get('/', 'ordertimeController@details')->name('home.ordertime');
        Route::get('save', 'ordertimeController@save')->name('home.ordertime.save');
        Route::post('gettime', [
            'as' => 'home.ordertime.gettime',
            'uses' => 'ordertimeController@gettime'
        ]);
        Route::post('save_asap', 'ordertimeController@save_asap');
    });
    
    $router->group([
        'prefix' => 'pickup',
        'namespace' => 'Pickup'
    ], function () use ($router) {
        Route::get('details', 'pickupController@details')->name('home.pickup.details');
        Route::get('/', 'pickupController@index')->name('home.pickup.info');
        Route::get('pickup_details', 'pickupController@pickup_details');
        // Route::get('pickup_details', ['as' => 'pickup',function () {
        // return 'something';
        // }]);
        // get('users/banned', 'UserController@banned')->name('admin.access.users.banned');
        Route::get('saveordertime', 'pickupController@saveordertime');
        Route::post('ordertime', [
            'as' => 'home.pickup.ordertime',
            'uses' => 'pickupController@ordertime'
        ]);
        Route::post('save_asap', 'pickupController@save_asap');
    });
    
    $router->group([
        'prefix' => 'payment',
        'namespace' => 'Payment',
        'as' => 'home.payment'
    ], function () use ($router) {
        Route::get('paymentmethod', 'paymentcontroller@paymentmethod')->name('.paymentmethod');
        Route::get('policonfirm', 'poliController@policonfirm')->name('.policonfirm');
        Route::get('cash', 'paymentcontroller@cash')->name('.cash');
        Route::get('credit', 'paymentcontroller@credit')->name('.credit');
        Route::post('poli', 'poliController@poli')->name('.poli')->middleware(['CartMiddleware']);
        Route::get('polisuccess', 'poliController@polisuccess')->name('.polisuccess');
        Route::get('polifail', 'poliController@polifail')->name('.polifail');
        Route::get('policancel', 'poliController@policancel')->name('.policancel');
        Route::post('polinudge', 'poliController@polinudge')->name('.polinudge');
        Route::post('placeorder', 'paymentcontroller@placeorder')->name('.placeorder');
        Route::post('credittaken', 'paymentcontroller@credittaken')->name('.credittaken');
    });
});

// Route::post('material/search', ['as' => 'admin.menu.material.search', 'uses' => 'MaterialController@search']);

/**
 * These frontend controllers require the user to be logged in
 */
$router->group([
    'middleware' => 'auth'
], function () {
// 	get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
// 	get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
// 	patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');
});
