<?php

namespace App\Http\Middleware\Shopping;

use Closure;
use Cart;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	/* if cart is empty, route to menu page */
    	if(!Cart::count()){
    		sweetalert_message()->n_overlay(trans("menus.empty_order"),'Invalid Order');
    		return redirect()->route('home.menu.index');
    	}
    	
        return $next($request);
    }
}
