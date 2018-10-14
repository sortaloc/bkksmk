<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;

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
        $loker = Loker::find(base64_decode($id));

        return view('cp.lamaran', compact('loker'));
    }

    protected function uploadLamaran(Request $request, $id){
        $lamaran = new Lamaran;
        $lamaran->nis = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first()->nis;
        $lamaran->id_loker = Loker::find(base64_decode($id))->id_loker;
        $lamaran->surat_lamaran = substr($request['surat_lamaran'], 0, 25) . 'file/d/' . substr($request['surat_lamaran'], 33) . '/preview';
        $lamaran->keterangan_lamaran = $request['keterangan'];
        $lamaran->status = 'pending';

        if($lamaran->save()){
            return redirect('/home');
        }
    }
}
