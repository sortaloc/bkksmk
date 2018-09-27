<?php

namespace App\Http\Controllers\Admin;

use App\DaftarCP;
use App\Kontak;
use App\User;
use App\Lamaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class CPController extends Controller
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
        $cp = DaftarCP::all();

        return view('admin.cp.cp', compact('cp'));
    }

    protected function edit($id){
        $cp = DaftarCP::find(base64_decode($id));

        return view('admin.cp.editCP', compact('cp'));
    }

    protected function update(Request $request, $id){
        $cp = DaftarCP::find(base64_decode($id));
        $kontak = KontakCP::where('nis', $cp->nis)->get()->first();

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
            $kontak->no_hp = $request['hp'];
            $kontak->no_telepon = $request['telepon'];
            $kontak->id_line = $request['line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                return redirect('/admin/cp');
            }
        }
    }

    protected function updatePassword(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(base64_decode($id));

        $user->password = Hash::make($request['password']);

        if($user->save()){
            return redirect('/admin/cp');
        }
    }

    protected function add(){
        return view('admin.cp.addCP');
    }

    protected function store(Request $request){
        $user = new User;
        $user->username = $request['username'];
        $user->id_status = 3;
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        if($user->save()){
            $kontak = new Kontak;
            $kontak->no_hp = $request['hp'];
            $kontak->no_telepon = $request['telepon'];
            $kontak->id_line = $request['line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                $cp = new DaftarCP;
                $cp->nis = $request['nis'];
                $cp->id_user = $user->id_user;
                $cp->id_kontak = $kontak->id_kontak;
                $cp->nama = $request['nama'];
                $cp->jenis_kelamin = $request['jk'];
                $cp->alamat = $request['alamat'];
                $cp->ttl = $request['ttl'];

                if($request->file('foto')){
                    $nameToStore = $this->ambil('public/fotoCP', $request->file('foto'));
                }else{
                    $nameToStore = 'nophoto.jpg';
                }

                $cp->foto = $nameToStore;

                if($cp->save()){
                    return redirect('admin/cp');
                }
            }
        }
    }

    protected function destroy($id){
        $cp = DaftarCP::find(base64_decode($id));
        $user = User::find($cp->id_user);
        $kontak = KontakCP::find($cp->nis);
        $lamaran = Lamaran::where('nis', $cp->nis)->get();

        if(count($lamaran) > 0){
            return redirect('/admin/cp');
        }else{
            // foreach($lamaran as $la){
            //     if($la->cv !== 'nophoto.jpg'){
            //         unlink('storage/cv/'.$la->cv);
            //     }

            //     if($la->surat_lamaran !== 'nophoto.jpg'){
            //         unlink('storage/suratLamaran/'.$la->surat_lamaran);
            //     }
            // }

            // if(Lamaran::where('nis', $cp->nis)->delete()){
                if($kontak->delete()){
                    if($cp->foto !== 'nophoto.jpg'){
                        unlink('storage/fotoCP/'.$cp->foto);
                    }

                    if($user->delete()){
                        if($cp->delete()){
                            return redirect('/admin/cp');
                        }
                    }
                }
            // }
        }


        if($cp->delete() && $user->delete()){
            return redirect('/admin/cp');
        }
    }
}
