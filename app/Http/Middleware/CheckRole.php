<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::user()->ID_ROL != $role) {
            // Redirect...
            // return route('welcome');
            return redirect(route('login'));
        }
        return $next($request);
    }
}
