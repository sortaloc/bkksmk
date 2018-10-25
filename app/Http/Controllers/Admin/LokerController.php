<?php

namespace App\Http\Controllers\Admin;

use App\DaftarPerusahaan;
use App\Loker;
use App\Pengaturan;

use App\Http\Controllers\Controller;
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

    protected function indexLoker(){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::orderBy('created_at', 'descending')->paginate(6);

        return view('admin.loker', compact('loker', 'pengaturan'));
    }

    protected function index(){
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        return view('perusahaan.addLoker', compact('perusahaan', 'pengaturan'));
    }

    protected function addLoker(Request $request){
        $loker = new Loker;
        $loker->judul = $request['judul'];
        $loker->status = 'Aktif';
        $loker->persyaratan = $request['persyaratan'];
        $loker->jam_kerja = $request['jam_kerja'];
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
            return redirect('/home')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    protected function deleteLoker($id){
        $loker = Loker::find(base64_decode($id));

        if($loker->brosur !== 'nophoto.jpg'){
            unlink('storage/brosur/'.$loker->brosur);
        }

        if($loker->delete()){
            return redirect('/home')->with('success', 'Data berhasil dihapus!');
        }
    }

    protected function editLoker($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));

        return view('perusahaan.editLoker', compact('loker', 'pengaturan'));
    }

    protected function updateLoker(Request $request, $id){
        $loker = Loker::find(base64_decode($id));
        $loker->judul = $request['judul'];
        $loker->persyaratan = $request['persyaratan'];
        $loker->status = $request['status'];
        $loker->jam_kerja = $request['jam_kerja'];
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
            return redirect('/home')->with('success', 'Data berhasil diubah!');
        }
    }

    protected function daftarPelamar($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));

        return view('perusahaan.daftarPelamar', compact('loker', 'pengaturan'));
    }
}
