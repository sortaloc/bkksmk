<?php

namespace App\Http\Controllers;

use App\User;
use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Kontak;

use App\Http\Requests\GantiPasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class SettingController extends Controller
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
        $akun = User::find(Auth::user()->id_user);

        return view('settings.password', compact('akun'));
    }

    protected function gantiPassword(GantiPasswordRequest $request){
        $akun = User::find(Auth::user()->id_user);

        if(Hash::check($request['passLama'], $akun->password)){
            $akun->password = Hash::make($request['password']);

            if($akun->save()){
                return redirect('/home');
            }
        }
    }

    protected function dataDiriPerusahaan(){
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataPerusahaan', compact('perusahaan'));
    }

    protected function updateDataDiriPerusahaan(Request $request){
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        $perusahaan->nama = $request['nama_perusahaan'];
        $perusahaan->alamat = $request['alamat'];
        $perusahaan->bio = $request['bio'];

        if($request->file('foto')){
            if($perusahaan->foto !== 'nophoto.jpg'){
                unlink('storage/fotoPerusahaan/'.$perusahaan->foto);
            }

            $nameToStore = $this->ambil('public/fotoPerusahaan', $request->file('foto'));
            $perusahaan->foto = $nameToStore;
        }

        if($perusahaan->save()){
            return redirect('/home');
        }
    }

    protected function updateDataKontakPerusahaan(Request $request){
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($perusahaan->id_kontak);

        $kontak->no_hp = $request['hp'];
        $kontak->no_telepon = $request['telepon'];
        $kontak->id_line = $request['line'];
        $kontak->kontak_dll = $request['kontak'];

        if($kontak->save()){
            return redirect('/home');
        }
    }

    protected function dataDiriCP(){
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataCP', compact('cp'));
    }

    protected function updateDataDiriCP(Request $request){
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];
        $cp->jenis_kelamin = $request['jk'];
        $cp->ttl = $request['ttl'];

        if($request->file('foto')){
            if($cp->foto !== 'nophoto.jpg'){
                unlink('storage/fotoCP/'.$cp->foto);
            }

            $nameToStore = $this->ambil('public/fotoCP', $request->file('foto'));
            $cp->foto = $nameToStore;
        }

        if($cp->save()){
            return redirect('/home');
        }
    }

    protected function updateDataKontakCP(Request $request){
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($cp->id_kontak);

        $kontak->no_hp = $request['hp'];
        $kontak->no_telepon = $request['telepon'];
        $kontak->id_line = $request['line'];
        $kontak->kontak_dll = $request['kontak'];

        if($kontak->save()){
            return redirect('/home');
        }
    }
}
