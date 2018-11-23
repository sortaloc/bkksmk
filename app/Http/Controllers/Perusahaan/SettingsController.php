<?php

namespace App\Http\Controllers\Perusahaan;

use App\DaftarPerusahaan;
use App\Loker;
use App\Lamaran;
use App\Pengaturan;
use App\Kontak;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddLokerRequest;
use App\Http\Requests\DataDiriPerusahaanRequest;

use Illuminate\Http\Request;

use Auth;

class SettingsController extends Controller
{
    protected function dataDiriPerusahaan(){
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataPerusahaan', compact('perusahaan', 'pengaturan'));
    }

    protected function updateDataDiriPerusahaan(dataDiriPerusahaanRequest $request){
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($perusahaan->id_kontak);

        $perusahaan->nama = $request['nama_perusahaan'];
        $perusahaan->alamat = $request['alamat'];
        $perusahaan->bio = $request['bio'];

        $kontak->no_hp = $request['no_hp'];
        $kontak->no_telepon = $request['no_telepon'];
        $kontak->id_line = $request['id_line'];
        $kontak->kontak_dll = $request['kontak'];

        if($request->file('foto')){
            if($perusahaan->foto !== 'nophoto.jpg'){
                unlink('storage/fotoPerusahaan/'.$perusahaan->foto);
            }

            $nameToStore = $this->ambil('public/fotoPerusahaan', $request->file('foto'));
            $perusahaan->foto = $nameToStore;
        }

        if($perusahaan->save() && $kontak->save()){
            return redirect('/home')->with('success', 'Data berhasil diubah!');
        }
    }
}
