<?php

namespace App\Http\Controllers;

use App\User;
use App\Loker;
use App\DaftarPerusahaan;

use App\Http\Requests\GantiPasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class SettingController extends Controller
{
    protected function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/fotoPerusahaan', $nameFinal);

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

        $perusahaan->nama_perusahaan = $request['nama_perusahaan'];
        $perusahaan->alamat = $request['alamat'];
        $perusahaan->bio = $request['bio'];

        if($request->file('foto')){
            if($perusahaan->foto !== 'nophoto.jpg'){
                unlink('storage/fotoPerusahaan/'.$perusahaan->foto);
            }

            $nameToStore = $this->ambil($request->file('foto'));
            $perusahaan->foto = $nameToStore;
        }

        if($perusahaan->save()){
            return redirect('/home');
        }
    }
}
