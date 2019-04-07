<?php

namespace App\Http\Controllers\Admin;

use App\DaftarPerusahaan;
use App\Loker;
use App\User;
use App\Kontak;
use App\Lamaran;
use App\Pengaturan;

use App\Http\Requests\GantiPasswordRequest;
use App\Http\Requests\RegisterPerusahaanRequest;
use App\Http\Requests\DataDiriPerusahaanRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;
use Auth;

class PerusahaanController extends Controller
{
    public function __construct(Google_Client $client)
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware(function ($request, $next) use ($client) {
            session('refreshToken') ? $client->refreshToken(session('refreshToken')) : $client->refreshToken(bcrypt(rand(0, 200)));
            $this->drive = new Google_Service_Drive($client);
            return $next($request);
        });
    }

    protected function ambil($path, $file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs($path, $nameFinal);

        return $nameFinal;
    }
    protected function createFile($file, $parent_id = null) {
        // Creating a folder
        // $folderMetadata = new Google_Service_Drive_DriveFile([
        //     'name' => 'BKKSMK',
        //     'mimeType' => 'application/vnd.google-apps.folder'
        // ]);
        // $folder = $this->drive->files->create($folderMetadata, ['fields' => 'id']);

        // Creating a file
        $name = gettype($file) === 'object' ? $file->getClientOriginalName() : $file;
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => time().'_'.$name,
            'parent' => $parent_id ? $parent_id : 'root'
            // 'parent' => $parent_id ? $parent_id : 'array($folder->id)
        ]);

        $content = gettype($file) === 'object' ?  File::get($file) : Storage::get($file);
        $mimeType = gettype($file) === 'object' ? File::mimeType($file) : Storage::mimeType($file);

        $file = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);

        // Changing file permission.
        $userPermission = new Google_Service_Drive_Permission(array(
            'type' => 'anyone',
            'role' => 'reader'
        ));

        $request = $this->drive->permissions->create($file->id, $userPermission, array('fields' => 'id'));
        if($request){
            return "https://drive.google.com/file/d/".$file->id."/preview";
        }
    }

    protected function index(){
        $pengaturan = Pengaturan::all()->first();
        $perusahaanVerified = DaftarPerusahaan::orderBy('created_at', 'descending')->where('terverifikasi', true)->get();
        $perusahaanUnverified = DaftarPerusahaan::orderBy('created_at', 'descending')->where('terverifikasi', false)->get();

        return view('admin.perusahaan.perusahaan', compact('perusahaanVerified', 'perusahaanUnverified', 'pengaturan'));
    }

    protected function edit($id){
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));

        return view('admin.perusahaan.editPerusahaan', compact('perusahaan', 'pengaturan'));
    }

    protected function update(DataDiriPerusahaanRequest $request, $id){
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $kontak = Kontak::find($perusahaan->id_kontak);

        $perusahaan->nama = $request['nama_perusahaan'];
        $perusahaan->alamat = $request['alamat'];
        $perusahaan->bio = $request['bio'];
        $perusahaan->noSurat = $request['noSurat'];
        if($request['suratKerjasama'] != null && $request['suratKerjasama'] != $perusahaan->suratKerjasama){
            $perusahaan->suratKerjasama = $this->createFile($request['suratKerjasama']);
        }

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
            return redirect('/admin/perusahaan')->with('success', 'Data berhasil diubah!');
        }
    }

    protected function updatePassword(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(base64_decode($id));

        $user->password = Hash::make($request['password']);

        if($user->save()){
            return redirect('/admin/perusahaan')->with('success', 'Password berhasil diubah!');
        }
    }

    protected function add(){
        $pengaturan = Pengaturan::all()->first();

        return view('admin.perusahaan.addPerusahaan', compact('pengaturan'));
    }

    protected function store(RegisterPerusahaanRequest $request){
        $user = new User;
        $user->username = $request['username'];
        $user->id_status = 2;
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        if($user->save()){
            $kontak = new Kontak;
            $kontak->no_hp = $request['no_hp'];
            $kontak->no_telepon = $request['no_telepon'];
            $kontak->id_line = $request['id_line'];
            $kontak->kontak_dll = $request['kontak'];

            if($kontak->save()){
                $perusahaan = new DaftarPerusahaan;
                $perusahaan->id_user = $user->id_user;
                $perusahaan->id_kontak = $kontak->id_kontak;
                $perusahaan->nama = $request['nama_perusahaan'];
                $perusahaan->alamat = $request['alamat'];
                $perusahaan->bio = $request['bio'];
                $perusahaan->noSurat = $request['noSurat'];
                if($request['suratKerjasama'] != null && $request['suratKerjasama'] != $perusahaan->suratKerjasama){
                    $perusahaan->suratKerjasama = $this->createFile($request['suratKerjasama']);
                }

                if($request->file('foto')){
                    $nameToStore = $this->ambil('public/fotoPerusahaan', $request->file('foto'));
                }else{
                    $nameToStore = 'nophoto.jpg';
                }

                $perusahaan->foto = $nameToStore;

                if($perusahaan->save()){
                    return redirect('/admin/perusahaan')->with('success', 'Data berhasil ditambahkan!');
                }
            }
        }
    }

    protected function destroy($id){
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $kontak = Kontak::find($perusahaan->id_kontak);
        $user = User::find($perusahaan->id_user);
        $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->get();
        // if(count($loker) > 0){
        //     $lamaran = Lamaran::where('id_loker', $loker->id_loker)->get();
        // }

        if(count($loker) > 0){
            return redirect('/admin/perusahaan')->with('error', 'Data tidak bisa dihapus, karena perusahaan sudah mempunyai lowongan pekerjaan!');
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
                            unlink('storage/fotoPerusahaan/'.$perusahaan->foto);
                        }

                        if($user->delete()){
                            if($perusahaan->delete()){
                                return redirect('/admin/perusahaan')->with('success', 'Data berhasil dihapus!');
                            }
                        }
                    // }
                }
            // }
        }
    }

    protected function verifikasiAkun(Request $request, $id) {
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $perusahaan->terverifikasi = true;

        if($perusahaan->save()){
            return redirect()->back()->with('success', 'Akun berhasil diverifikasi!');
        }
    }
}
