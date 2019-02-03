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

    public function index()
    {
        $pengaturan = Pengaturan::all()->first();
        $berita = Berita::orderBy('created_at', 'descending')->paginate(8);

        return view('cp.daftarBerita', compact('pengaturan', 'berita'));
    }
}
