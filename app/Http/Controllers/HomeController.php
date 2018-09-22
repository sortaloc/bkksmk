<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->id_status === 2){
            $loker = Loker::where('id_perusahaan', DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first()->id_perusahaan)->get();
        }else{
            $loker = Loker::all();
        }
        return view('home', compact('loker'));
    }
}
