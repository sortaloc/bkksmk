<?php

namespace App\Http\Controllers\Admin;

use App\Pengaturan;
use App\BukuTamu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::all()->first();
        $bukutamu = BukuTamu::paginate(10);

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
