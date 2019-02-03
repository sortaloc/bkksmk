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
    public function index(){
        $pengaturan = Pengaturan::all()->first();
        $latestBerita = Berita::orderBy('created_at', 'descending')->take(4)->get();
        $latestBeritaID = [];
        foreach($latestBerita as $lb){
            array_push($latestBeritaID, $lb->id_berita);
        }

        $berita = Berita::whereNotIn('id_berita', $latestBeritaID)->orderBy('created_at', 'descending')->paginate(8);

        return view('beritaLP', compact('berita', 'latestBerita', 'pengaturan'));
    }
}
