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
    public function handle($request, Closure $next, ... $roles)
    {
        // dd($roles);
        $permitido = false; 
        foreach ($roles as $key => $rol) {
            if (Auth::user()->ID_ROL == $rol) {
                $permitido = true;
            }
        }
        if($permitido){
            return $next($request);
        }else{
            return redirect(route('error1'));
        }
    }
}
