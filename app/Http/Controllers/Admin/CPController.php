<?php

namespace App\Http\Controllers\Admin;

use App\DaftarCP;
use App\Kontak;
use App\User;
use App\Lamaran;
use App\Pengaturan;

use App\Http\Requests\RegisterCPRequest;
use App\Http\Requests\DataDiriCPRequest;

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
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::all();

        return view('admin.cp.cp', compact('cp', 'pengaturan'));
    }

    protected function edit($id){
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::find(base64_decode($id));

        return view('admin.cp.editCP', compact('cp', 'pengaturan'));
    }

    protected function update(DataDiriCPRequest $request, $id){
        if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
            return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
        }

        $cp = DaftarCP::find(base64_decode($id));
        $kontak = Kontak::find($cp->id_kontak);

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];
        $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';;
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
            $kontak->no_hp = $request['no_hp'];
            $kontak->no_telepon = $request['no_telepon'];
            $kontak->id_line = $request['id_line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                return redirect('/admin/cp')->with('success', 'Data berhasil diubah!');
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
            return redirect('/admin/cp')->with('success', 'Password berhasil diubah!');
        }
    }

    protected function add(){
        $pengaturan = Pengaturan::all()->first();

        return view('admin.cp.addCP', compact('pengaturan'));
    }

    protected function store(RegisterCPRequest $request){
        if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
            return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
        }

        $user = new User;
        $user->username = $request['usernameCP'];
        $user->id_status = 3;
        $user->email = $request['emailCP'];
        $user->password = Hash::make($request['passwordCP']);

        if($user->save()){
            $kontak = new Kontak;
            $kontak->no_hp = $request['no_hp_cp'];
            $kontak->no_telepon = $request['no_telepon'];
            $kontak->id_line = $request['id_line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                $cp = new DaftarCP;
                $cp->nis = $request['nis'];
                $cp->id_user = $user->id_user;
                $cp->id_kontak = $kontak->id_kontak;
                $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
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
                    return redirect('admin/cp')->with('success', 'Data berhasil ditambahkan!');
                }
            }
        }
    }

    protected function destroy($id){
        $cp = DaftarCP::find(base64_decode($id));
        $user = User::find($cp->id_user);
        $kontak = Kontak::find($cp->id_kontak);
        $lamaran = Lamaran::where('nis', $cp->nis)->get();

        if(count($lamaran) > 0){
            return redirect('/admin/cp')->with('error', 'Data tidak bisa dihapus, karena calon pegawai sudah pernah mendaftar di salah satu lowongan pekerjaan!');
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
                            return redirect('/admin/cp')->with('success', 'Data berhasil dihapus!');
                        }
                    }
                }
            // }
        }
    }
}
