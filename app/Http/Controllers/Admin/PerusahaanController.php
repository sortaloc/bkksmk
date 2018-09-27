<?php

namespace App\Http\Controllers\Admin;

use App\DaftarPerusahaan;
use App\Loker;
use App\User;
use App\Kontak;

use App\Http\Requests\GantiPasswordRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class PerusahaanController extends Controller
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
        $perusahaan = DaftarPerusahaan::all();

        return view('admin.perusahaan.perusahaan', compact('perusahaan'));
    }

    protected function edit($id){
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));

        return view('admin.perusahaan.editPerusahaan', compact('perusahaan'));
    }

    protected function update(Request $request, $id){
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $kontak = Kontak::find($perusahaan->id_kontak);

        $perusahaan->nama = $request['nama'];
        $perusahaan->alamat = $request['alamat'];
        $perusahaan->bio = $request['bio'];

        $kontak->no_hp = $request['hp'];
        $kontak->no_telepon = $request['telepon'];
        $kontak->id_line = $request['line'];
        $kontak->kontak_dll = $request['kontak'];

        if($request->file('foto')){
            if($perusahaan->foto !== 'nophoto.jpg'){
                unlink('storage/fotoPerusahaan/'.$perusahaan->foto);
            }

            $nameToStore = $this->ambil('public/fotoPerusahaan', $request->file('foto'));
            $perusahaan->foto = $nameToStore;
        }

        if($perusahaan->save() && $kontak->save()){
            return redirect('/admin/perusahaan');
        }
    }

    protected function updatePassword(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(base64_decode($id));

        $user->password = Hash::make($request['password']);

        if($user->save()){
            return redirect('/admin/perusahaan');
        }
    }

    protected function add(){
        return view('admin.perusahaan.addPerusahaan');
    }

    protected function store(Request $request){
        $user = new User;
        $user->username = $request['username'];
        $user->id_status = 2;
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        if($user->save()){
            $kontak = new Kontak;
            $kontak->no_hp = $request['hp'];
            $kontak->no_telepon = $request['telepon'];
            $kontak->id_line = $request['line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                $perusahaan = new DaftarPerusahaan;
                $perusahaan->id_user = $user->id_user;
                $perusahaan->id_kontak = $kontak->id_kontak;
                $perusahaan->nama = $request['nama'];
                $perusahaan->alamat = $request['alamat'];
                $perusahaan->bio = $request['bio'];

                if($request->file('foto')){
                    $nameToStore = $this->ambil('public/fotoPerusahaan', $request->file('foto'));
                }else{
                    $nameToStore = 'nophoto.jpg';
                }

                $perusahaan->foto = $nameToStore;

                if($perusahaan->save()){
                    return redirect('/admin/perusahaan');
                }
            }
        }
    }

    protected function destroy($id){
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $kontak = Kontak::find($perusahaan->id_kontak);
        $user = User::find($perusahaan->id_user);
        $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->get();
        $lamaran = Lamaran::where('id_loker', $loker->id_loker)->get();

        if(count($loker) > 0){
            return redirect('/admin/perusahaan');
        }else{
            // foreach($lamaran as $la){
            //     if($la->cv !== 'nophoto.jpg'){
            //         unlink('storage/cv/'.$la->cv);
            //     }

            //     if($la->surat_lamaran !== 'nophoto.jpg'){
            //         unlink('storage/suratLamaran/'.$la->surat_lamaran);
            //     }
            // }

            // if(Lamaran::where('id_loker', $loker->id_loker)->delete()){
                if($kontak->delete()){
                    // foreach($loker as $l){
                    //     if($l->brosur !== 'nophoto.jpg'){
                    //         unlink('storage/brosur/'.$l->brosur);
                    //     }
                    // }

                    // if(Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->delete()){
                        if($perusahaan->foto !== 'nophoto.jpg'){
                            unlink('storage/foto/'.$perusahaan->foto);
                        }

                        if($user->delete()){
                            if($perusahaan->delete()){
                                return redirect('/admin/perusahaan');
                            }
                        }
                    // }
                }
            // }
        }
    }
}
