<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        
        if(Auth::check()){
            if($request->is('administration') && (Auth::user()->privilege != 1 && Auth::user()->privilege != 2)){
                return redirect('/home');
            }
            return $next($request);    
        }

        else {
            return redirect('/login');
        }
        
    }
}
