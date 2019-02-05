<?php

namespace App\Http\Controllers\CP;

use App\Pengaturan;
use App\Berita;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isCP');
    }

    public function index(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();
        $statusSearch = false;
        $berita = Berita::orderBy('created_at', 'descending');
        if($request->input('search')){
            $statusSearch = true;
            $berita = $berita->where('judul_berita', 'like', '%'.$request->input('search').'%');
        }
        $berita = $berita->paginate(4);

        return view('cp.daftarBerita', compact('pengaturan', 'berita', 'statusSearch', 'request'));
    }
}
