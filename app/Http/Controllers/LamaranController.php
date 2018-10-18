<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;

use Illuminate\Http\Request;

use Auth;

class LamaranController extends Controller
{
    protected function ambil($uploadPath, $file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs($uploadPath, $nameFinal);

        return $nameFinal;
    }

    protected function index($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));

        return view('cp.lamaran', compact('loker', 'pengaturan'));
    }

    protected function uploadLamaran(Request $request, $id){
        if(substr($request['surat_lamaran'], 0, 33) !== 'https://drive.google.com/open?id='){
            return back()->with('error', 'Surat lamaran tidak valid, silahkan ikut tata cara mengambil link google drive.');
        }
        // dd(DaftarCP::where('id_user', Auth::user()->id_user)->get()->first()->nis);
        $lamaran = new Lamaran;
        $lamaran->nis = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first()->nis;
        $lamaran->id_loker = Loker::find(base64_decode($id))->id_loker;
        $lamaran->surat_lamaran = substr($request['surat_lamaran'], 0, 25) . 'file/d/' . substr($request['surat_lamaran'], 33) . '/preview';
        $lamaran->keterangan_lamaran = $request['keterangan'];
        $lamaran->status = 'pending';

        if($lamaran->save()){
            return redirect('/home')->with('success', 'Data berhasil dikirim!');
        }
    }
}
