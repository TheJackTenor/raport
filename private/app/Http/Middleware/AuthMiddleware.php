<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthMiddleware
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
    	if (Auth::check() and Auth::user()->hak_akses == "1") {
    		 return $next($request);
    	} 
    	else{
            return redirect('/home');
        }
       
    }
}
