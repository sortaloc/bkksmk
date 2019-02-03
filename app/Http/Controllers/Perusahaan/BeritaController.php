<?php

namespace App\Http\Controllers\Perusahaan;

use App\Pengaturan;
use App\Berita;
use App\DaftarPerusahaan;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isPerusahaan');
    }

    protected function index()
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();
        $berita = Berita::orderBy('created_at', 'descending')->paginate(8);

        return view('perusahaan.daftarBerita', compact('pengaturan', 'berita', 'perusahaan'));
    }
}
