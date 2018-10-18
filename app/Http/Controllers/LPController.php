<?php

namespace App\Http\Controllers;

use App\Pengaturan;

use Illuminate\Http\Request;

use Auth;

class LPController extends Controller
{
    public function lp()
    {
        $pengaturan = Pengaturan::all()->first();

        if(Auth::user()){
            return redirect('/home');
        }

        return view('lp', compact('pengaturan'));
    }
}
