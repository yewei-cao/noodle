<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    	\App\Http\Middleware\langsMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    		
    	/*
    	 * Access Middleware for admin.
    	 */
    	'access.role'=> \App\Http\Middleware\RoleMiddleware::class,
    		
    	/*
    	 * check the session has user details
    	 */
    	'ordertypeMiddleware'=>\App\Http\Middleware\Shopping\OrderTypeSession::class,
    	'cartMiddleware'=>\App\Http\Middleware\Shopping\CartMiddleware::class,
    	'IPMiddleware'=>\App\Http\Middleware\Shopping\IPMiddleware::class,
    		
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    	$schedule->call(function () {
    		$orders = Orders::where('status','2')->get();
    		
    		foreach($orders as $order){
    			$order->update(['status'=>'3']);
    		}
    		
    	})->everyMinute()
    	->appendOutputTo('cook.txt')
    	->emailOutputTo('yeweicao@gmail.com');
    }
    
}
