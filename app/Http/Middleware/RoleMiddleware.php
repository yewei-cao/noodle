<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
use App\Models\Access\User\User;

class RoleMiddleware
{
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {	
		if (! $request->user()->hasRole($role)) {
			return redirect('/')->withFlashDanger("You do not have access to do that.");
		}

		return $next($request);
    }
}
