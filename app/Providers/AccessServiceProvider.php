<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Access\Access;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerBindings();
        $this->registerAccess();
    }
    
    
    public function registerBindings() {
    	
//     	$this->app->bind(
//     			\App\Repositories\Flash\AuthenticationContract::class,
//     			\App\Repositories\Frontend\Auth\EloquentAuthenticationRepository::class
//     	);
    }
    
    
    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAccess()
    {
    	$this->app->bind('access', function ($app) {
    		return new Access($app);
    	});
    }
}
