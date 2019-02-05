<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Pengaturan;

use App\Http\Requests\GantiPasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class BeritaController extends Controller
{
    public function index(Request $request){
        $pengaturan = Pengaturan::all()->first();

        $latestBerita = Berita::orderBy('created_at', 'descending')->take(4)->get();
        $latestBeritaID = [];
        foreach($latestBerita as $lb){
            array_push($latestBeritaID, $lb->id_berita);
        }
        $berita = Berita::whereNotIn('id_berita', $latestBeritaID)->orderBy('created_at', 'descending')->paginate(4);
        $jumlahBerita = count(Berita::all());

        $statusSearch = false;
        $searchBerita = Berita::orderBy('created_at', 'descending');
        if($request->input('search')){
            $statusSearch = true;
            $searchBerita = $searchBerita->where('judul_berita', 'like', '%'.$request->input('search').'%');
        }
        $searchBerita = $searchBerita->paginate(4);

        return view('beritaLP', compact('berita', 'latestBerita', 'jumlahBerita', 'searchBerita', 'statusSearch', 'request', 'pengaturan'));
    }
}
