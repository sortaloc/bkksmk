<?php

namespace App\Http\Controllers;

use App\User;
use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Kontak;
use App\Pengaturan;

use App\Http\Requests\GantiPasswordRequest;
use App\Http\Requests\DataDiriPerusahaanRequest;
use App\Http\Requests\DataDiriCPRequest;

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

    protected function dataDiriCP(){
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataCP', compact('cp', 'pengaturan'));
    }

    protected function updateDataDiriCP(DataDiriCPRequest $request){
        if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
            return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
        }

        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($cp->id_kontak);

        // https://drive.google.com/open?id=1B813HfAypuzExfg-nZ0XlEAt81DDHn7a
        // https://drive.google.com/open?id=0B3cZyBMnU_jNUm9adjh2WUxuYjA
        // https://drive.google.com/file/d/1B813HfAypuzExfg-nZ0XlEAt81DDHn7a/preview
        // https://drive.google.com/file/d/0B3cZyBMnU_jNUm9adjh2WUxuYjA/preview

        // substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview'

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];
        $cp->jenis_kelamin = $request['jk'];
        $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
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
