<?php

namespace App\Http\Controllers;

use App\User;
use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Kontak;
use App\Pengaturan;

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
        $pengaturan = Pengaturan::all()->first();
        $akun = User::find(Auth::user()->id_user);

        return view('settings.password', compact('akun', 'pengaturan'));
    }

    protected function gantiPassword(GantiPasswordRequest $request){
        $akun = User::find(Auth::user()->id_user);

        if(Hash::check($request['passLama'], $akun->password)){
            $akun->password = Hash::make($request['password']);

            if($akun->save()){
                return redirect('/home')->with('success', 'Password berhasil diubah!');
            }
        }else{
            // Tambah notif password lama tidak valid / salah.
            return back()->with('error', 'Password lama salah');
        }
    }
}
