<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckCP
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
        if(Auth::user()->id_status !== 3){
            return redirect('/');
        }

        return $next($request);
    }
}
