<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
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
        if(Auth::user()->type == "admin"){
            return $next($request);
        }
        else {
            return redirect('/blogs')->with('status','Fatal Error[69]:You are not allowed to admin dashboard');
        }
    }
}
