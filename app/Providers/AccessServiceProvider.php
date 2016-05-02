<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use App\Services\Access\Access;
=======
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8

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
<<<<<<< HEAD
        $this->registerAccess();
=======
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
    }
    
    
    public function registerBindings() {
    	
//     	$this->app->bind(
//     			\App\Repositories\Flash\AuthenticationContract::class,
//     			\App\Repositories\Frontend\Auth\EloquentAuthenticationRepository::class
//     	);
    }
<<<<<<< HEAD
    
    
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
=======
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
}
