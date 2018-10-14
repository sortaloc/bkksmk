<?php

namespace App\Http\Controllers\Perusahaan;

use App\DaftarPerusahaan;
use App\Loker;
use App\Lamaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddLokerRequest;

use Illuminate\Http\Request;

use Auth;

class LokerController extends Controller
{
    protected function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/brosur', $nameFinal);

        return $nameFinal;
    }

    protected function index(){
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        return view('perusahaan.addLoker', compact('perusahaan'));
    }

    protected function addLoker(AddLokerRequest $request){
        $loker = new Loker;
        $loker->id_perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first()->id_perusahaan;
        $loker->judul = $request['judul'];
        $loker->persyaratan = $request['persyaratan'];
        $loker->jam_kerja = $request['jam_kerja'];
        $loker->status = 'Aktif';
        $loker->gaji = $request['gaji'];
        $loker->keterangan_loker = $request['keterangan'];

        if($request->file('brosur')){
            $nameToStore = $this->ambil($request->file('brosur'));
        }else if($request['brosur']){
            $nameToStore = $this->ambil($request['brosur']);
        }else{
            $nameToStore = 'nophoto.jpg';
        }

        $loker->brosur = $nameToStore;

        if($loker->save()){
            return redirect('/home');
        }
    }

    protected function deleteLoker($id){
        $loker = Loker::find(base64_decode($id));

        if($loker->brosur !== 'nophoto.jpg'){
            unlink('storage/brosur/'.$loker->brosur);
        }

        if($loker->delete()){
            return redirect('/home');
        }
    }

    protected function editLoker($id){
        $loker = Loker::find(base64_decode($id));
        // return $loker;
        return view('perusahaan.editLoker', compact('loker'));
    }

    protected function updateLoker(AddLokerRequest $request, $id){
        $loker = Loker::find(base64_decode($id));
        $loker->judul = $request['judul'];
        $loker->persyaratan = $request['persyaratan'];
        $loker->jam_kerja = $request['jam_kerja'];
        $loker->status = $request['status'];
        $loker->gaji = $request['gaji'];
        $loker->keterangan_loker = $request['keterangan'];

        if($request->file('brosur')){
            if($loker->brosur !== 'nophoto.jpg'){
                unlink('storage/brosur/'.$loker->brosur);
            }

            $nameToStore = $this->ambil($request->file('brosur'));
            $loker->brosur = $nameToStore;
        }

        if($loker->save()){
            return redirect('/home');
        }
    }

    protected function daftarPelamar($id){
        $loker = Loker::find(base64_decode($id));

        return view('perusahaan.daftarPelamar', compact('loker'));
    }

    protected function verifPelamar($id){
        $lamaran = Lamaran::find(base64_decode($id));
        $lamaran->status = "diterima";

        if($lamaran->save()){
            return redirect('/home');
        }
    }

    protected function tolakPelamar($id){
        $lamaran = Lamaran::find(base64_decode($id));
        $lamaran->status = 'ditolak';

        if($lamaran->save()){
            return redirect('/home');
        }
    }
}
