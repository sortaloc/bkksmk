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

        if($request->file('cv')){
            $nameToStoreCV = $this->ambil('public/cv', $request->file('cv'));
        }else{
            $nameToStoreCV = 'nophoto.jpg';
        }

        if($request->file('surat_lamaran')){
            $nameToStoreSL = $this->ambil('public/suratLamaran', $request->file('surat_lamaran'));
        }else{
            $nameToStoreSL = 'nophoto.jpg';
        }

        $lamaran->cv = $nameToStoreCV;
        $lamaran->surat_lamaran = $nameToStoreSL;
        $lamaran->keterangan_lamaran = $request['keterangan'];
        $lamaran->status = 'pending';

        if($lamaran->save()){
            return redirect('/home');
        }
    }
}
