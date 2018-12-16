<?php

namespace App\Http\Controllers\Admin;

use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Lamaran;
use App\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    protected function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/banner', $nameFinal);

        return $nameFinal;
    }

    public function pengaturanIndex()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function ubahPengaturan(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();

        if($request->file('foto1')){
            if($pengaturan->foto1 !== 'nophoto.jpg'){
                unlink('storage/banner/'.$pengaturan->foto1);
            }

            $nameToStore = $this->ambil($request->file('foto1'));
            $pengaturan->foto1 = $nameToStore;
        }

        $pengaturan->banner1 = $request['banner1'];
        $pengaturan->fitur1 = $request['fitur1'];
        $pengaturan->fitur2 = $request['fitur2'];
        $pengaturan->fitur3 = $request['fitur3'];
        $pengaturan->tentang1 = $request['tentang1'];
        $pengaturan->tujuan1 = $request['tujuan1'];
        $pengaturan->alamat = $request['alamat'];
        $pengaturan->telp = $request['telp'];
        $pengaturan->fax = $request['fax'];
        $pengaturan->email = $request['email'];

        if($pengaturan->save()){
            return redirect('/admin/pengaturan')->with('success', 'Data pengaturan berhasil diubah!');
        }
    }
}
