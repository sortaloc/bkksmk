<?php

namespace App\Http\Controllers\Admin;

use App\Pengaturan;
use App\Kegiatan;

use App\Http\Requests\AddKegiatanRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class KegiatanController extends Controller
{
    protected function ambil($path, $file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs($path, $nameFinal);

        return $nameFinal;
    }

    protected function index(){
        $pengaturan = Pengaturan::all()->first();
        $kegiatan = Kegiatan::paginate(6);

        return view('admin.kegiatan.kegiatan', compact('kegiatan', 'pengaturan'));
    }

    protected function edit($id){
        $pengaturan = Pengaturan::all()->first();
        $kegiatan = Kegiatan::find(base64_decode($id));

        return view('admin.kegiatan.editKegiatan', compact('kegiatan', 'pengaturan'));
    }

    protected function update(AddKegiatanRequest $request, $id){
        $kegiatan = Kegiatan::find(base64_decode($id));

        $kegiatan->judul_kegiatan = $request['judul_kegiatan'];
        $kegiatan->deskripsi_kegiatan = $request['deskripsi_kegiatan'];

        if($request->file('foto_kegiatan')){
            if($kegiatan->foto_kegiatan !== 'nophoto.jpg'){
                unlink('storage/fotoKegiatan/'.$kegiatan->foto_kegiatan);
            }

            $nameToStore = $this->ambil('public/fotoKegiatan', $request->file('foto_kegiatan'));
            $kegiatan->foto_kegiatan = $nameToStore;
        }

        if($kegiatan->save()){
            return redirect('/admin/kegiatan')->with('success', 'Data berhasil diubah!');
        }
    }

    protected function add(){
        $pengaturan = Pengaturan::all()->first();

        return view('admin.kegiatan.addKegiatan', compact('pengaturan'));
    }

    protected function store(AddKegiatanRequest $request){
        $kegiatan = new Kegiatan;
        $kegiatan->judul_kegiatan = $request['judul_kegiatan'];
        $kegiatan->deskripsi_kegiatan = $request['deskripsi_kegiatan'];
        if($request->file('foto_kegiatan')){
            $nameToStore = $this->ambil('public/fotoKegiatan', $request->file('foto_kegiatan'));
        }else{
            $nameToStore = 'nophoto.jpg';
        }
        $kegiatan->foto_kegiatan = $nameToStore;

        if($kegiatan->save()){
            return redirect('admin/kegiatan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    protected function destroy($id){
        $kegiatan = Kegiatan::find(base64_decode($id));

        if($kegiatan->delete()){
            return redirect('/admin/kegiatan')->with('success', 'Data berhasil dihapus!');
        }
    }
}
