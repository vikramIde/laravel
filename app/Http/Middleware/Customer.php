<?php

namespace App\Http\Middleware;

use Closure;
use Auth; //at the top
class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function handle($request, Closure $next)
    {

        if (Auth::check() && Auth::user()->role == 'customer') {
            return $next($request);
        }
        else {
            return redirect('/404');
        }
    }
}
