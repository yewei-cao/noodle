<?php

namespace App\Http\Middleware\Shopping;

use Closure;


class OrderTypeSession
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
    	/* if session expired, then route to home page. */
//     	if((!$request->session()->has('pickup_deatils'))||(!$request->session()->has('ordertime'))){
    	if((!$request->session()->has('ordertype'))||(!$request->session()->has('ordertime'))){
    		sweetalert_message()->n_overlay(trans("menus.session.expire"),'Session Expire');
    		return redirect()->route('home');
    	}
//     	/* if cart is empty, route to menu page */
//     	if(!Cart::count()){
//     		sweetalert_message()->n_overlay(trans("menus.empty_order"),'Invalid Order');
//     		return redirect()->route('home.menu.index');
//     	}
    	
        return $next($request);
    }
}
