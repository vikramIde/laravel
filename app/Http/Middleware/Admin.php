<?php

namespace App\Http\Middleware;

use Closure;
use Auth; //at the top
class Admin
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
        // dd(Auth::check());
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }
        else {
            return redirect('/404');
        }
    }
}
