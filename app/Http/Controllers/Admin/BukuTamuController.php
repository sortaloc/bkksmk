<?php

namespace App\Http\Controllers\Admin;

use App\Pengaturan;
use App\BukuTamu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class BukuTamuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $pengaturan = Pengaturan::all()->first();
        $bukutamu = BukuTamu::orderBy('created_at', 'descending')->get();

        return view('admin.bukutamu.bukutamu', compact('pengaturan', 'bukutamu'));
    }

    public function lihat($id)
    {
        $pengaturan = Pengaturan::all()->first();
        $bukutamu = BukuTamu::find(base64_decode($id));

        return view('admin.bukutamu.detailBukuTamu', compact('pengaturan', 'bukutamu'));
    }

    public function hapus($id)
    {
        $bukutamu = BukuTamu::find(base64_decode($id));

        if($bukutamu->delete()){
            return back()->with('success', 'Data telah berhasil dihapus!');
        }
    }
}
