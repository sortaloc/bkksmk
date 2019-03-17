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
        $this->middleware('isVerifiedPerusahaan');
    }

    protected function index(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        $statusSearch = false;
        $berita = Berita::orderBy('created_at', 'descending');
        if($request->input('search')){
            $statusSearch = true;
            $berita = $berita->where('judul_berita', 'like', '%'.$request->input('search').'%');
        }
        $berita = $berita->paginate(4);

        return view('perusahaan.daftarBerita', compact('pengaturan', 'berita', 'statusSearch', 'request', 'perusahaan'));
    }
}
