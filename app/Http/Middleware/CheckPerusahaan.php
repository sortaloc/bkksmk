<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPerusahaan
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
        if(Auth::user()->id_status !== 2){
            return redirect('/');
        }

        return $next($request);
    }
}
