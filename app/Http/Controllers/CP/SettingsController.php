<?php

namespace App\Http\Controllers\CP;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;
use App\Kontak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DataDiriCPRequest;

use Auth;

class SettingsController extends Controller
{
    protected function dataDiriCP(){
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataCP', compact('cp', 'pengaturan'));
    }

    protected function updateDataDiriCP(DataDiriCPRequest $request){
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($cp->id_kontak);

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];

        if($request['cv'] != null && $request['cv'] != $cp->cv){
            if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
                return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
            }else{
                $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
            }
        }

        $cp->jenis_kelamin = $request['jk'];
        $cp->ttl = $request['ttl'];

        $kontak->no_hp = $request['no_hp'];
        $kontak->no_telepon = $request['no_telepon'];
        $kontak->id_line = $request['id_line'];
        $kontak->kontak_dll = $request['kontak'];

        if($request->file('foto')){
            if($cp->foto !== 'nophoto.jpg'){
                unlink('storage/fotoCP/'.$cp->foto);
            }

            $nameToStore = $this->ambil('public/fotoCP', $request->file('foto'));
            $cp->foto = $nameToStore;
        }

        if($cp->save() && $kontak->save()){
            return redirect('/home')->with('success', 'Data berhasil diubah!');
        }
    }
}
