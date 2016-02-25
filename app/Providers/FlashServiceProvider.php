<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    	$this->loadViewsFrom(__DIR__ . '/../Repositories/Flash/view', 'flash');
    	
    	$this->publishes([
    			__DIR__ . '/../Repositories/Flash/view' => base_path('resources/views/vendor/flash')
    	]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind(
    			'App\Repositories\Flash\SessionStore',
    			'App\Repositories\Flash\LaravelSessionStore'
    	);
          
    	$this->app->bindShared('App\Repositories\Flash\sweetalert', function () {
            return $this->app->make('App\Repositories\Flash\sweetalertNotifier');
        });
    }
    
}
