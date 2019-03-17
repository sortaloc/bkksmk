<?php

namespace App\Http\Controllers\Perusahaan;

use App\Pengaturan;
use App\DaftarCP;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

class CPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isPerusahaan');
        $this->middleware('isVerifiedPerusahaan');
    }

    protected function profile($id)
    {
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::find(base64_decode($id));

        return view('perusahaan.profilCP', compact('pengaturan', 'cp'));
    }
}
