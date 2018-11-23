<?php

namespace App\Http\Controllers\CP;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isCP');
    }

    public function profilPerusahaan($id)
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $lamaran = Lamaran::where('nis', $cp->nis)->get();
        $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->orderBy('created_at', 'descending')->paginate(6);

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

        return view('cp.profilPerusahaan', compact('perusahaan', 'belumDiLamar', 'sudahDiLamar', 'cp', 'loker', 'pengaturan'));
    }
}
