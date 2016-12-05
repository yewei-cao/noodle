<?php

namespace App\Http\Middleware\Shopping;

use Closure;
use App\Models\Shop\Blacklists;

class IPMiddleware
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
    	
    	if(Blacklists::checkip($request->ip())){
    		sweetalert_message()->n_overlay(trans("menus.invalidip"),'Invalid IP');
    		return redirect()->route('home.menu.index');
    	}
    	
        return $next($request);
    }
}
