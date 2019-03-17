<?php

namespace App\Http\Middleware;

use App\DaftarPerusahaan;

use Closure;
use Auth;

class CheckVerifikasiPerusahaan
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
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->first();
        if(!$perusahaan->terverifikasi){
            return redirect('/');
        }

        return $next($request);
    }
}
