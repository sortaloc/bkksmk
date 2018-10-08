<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Lamaran;

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
        if (Auth::user()->id_status === 2) {
            $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();
            $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->paginate(4);

            return view('home', compact('loker', 'perusahaan'));
        } else if (Auth::user()->id_status === 3) {
            $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
            $lamaran = Lamaran::where('nis', $cp->nis)->get();
            $loker = Loker::paginate(4);

            $sudahDiLamar = [];
            $belumDiLamar = $loker;

            for ($i = count($loker) - 1; $i >= 0; $i--) {
                for ($j = count($lamaran) - 1; $j >= 0; $j--) {
                    if ($loker[$i]->id_loker === $lamaran[$j]->id_loker) {
                        array_push($sudahDiLamar, $loker[$i]);
                        if (isset($belumDiLamar[$i])) {
                            unset($belumDiLamar[$i]);
                            $i--;
                        }
                    }
                }
            }
            return view('home', compact('loker', 'sudahDiLamar', 'belumDiLamar', 'cp'));
        } else {
            $loker = Loker::paginate(4);
            return view('home', compact('loker'));
        }
    }
}
