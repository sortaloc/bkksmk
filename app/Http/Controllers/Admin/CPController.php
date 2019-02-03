<?php

namespace App\Http\Controllers\Admin;

use App\DaftarCP;
use App\KegiatanCP;
use App\Kontak;
use App\User;
use App\Lamaran;
use App\Pengaturan;

use App\Http\Requests\RegisterCPRequest;
use App\Http\Requests\DataDiriCPRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Auth;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

class CPController extends Controller
{
    private $drive;
    public function __construct(Google_Client $client)
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware(function ($request, $next) use ($client) {
            $client->refreshToken(Auth::user()->refresh_token);
            $this->drive = new Google_Service_Drive($client);
            return $next($request);
        });
    }

    /*
        Upload to Google Drive using Google Drive API
        @return preview for embedding to iframe.
    */
    function createFile($file, $parent_id = null){
        // Opening the google client with existing refresh_token.
        // $client = new Google_Client;
        // $client->refreshToken(Auth::user()->refresh_token);

        // // // Opening the user drive using the google client.
        // $drive = new Google_Service_Drive($client);

        // Uploading file
        $name = gettype($file) === 'object' ? $file->getClientOriginalName() : $file;
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => time().'_'.$name,
            'parent' => $parent_id ? $parent_id : 'root'
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
        $cp = DaftarCP::orderBy('created_at', 'descending')->get();

        return view('admin.cp.cp', compact('cp', 'pengaturan'));
    }

    protected function edit($id){
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::find(base64_decode($id));

        return view('admin.cp.editCP', compact('cp', 'pengaturan'));
    }

    protected function update(DataDiriCPRequest $request, $id){
        $cp = DaftarCP::find(base64_decode($id));
        $kontak = Kontak::find($cp->id_kontak);

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];
        $cp->jenis_kelamin = $request['jk'];
        $cp->ttl = $request['ttl'];
        $cp->alumni = $request['alumni'];

        if($request['cv'] != null && $request['cv'] != $cp->cv){
            $cp->cv = $this->createFile($request['cv']);
            // if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
            //     return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
            // }else{
            //     $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
            // }
        }

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
                if($request['alumni'] === 'Y'){
                    if(KegiatanCP::find($cp->id_kegiatan_cp)){
                        $kegiatancp = KegiatanCP::find($cp->id_kegiatan_cp);
                    }else{
                        $kegiatancp = new KegiatanCP;
                    }

                    $kegiatancp->jenis_kegiatan = $request['jenis_kegiatan'];
                    $kegiatancp->tempat_kegiatan = $request['tempat_kegiatan'];
                    $kegiatancp->bidang_kegiatan = $request['bidang_kegiatan'];

                    if($request['jenis_kegiatan'] === 'Belum Bekerja/Kuliah' || $request['jenis_kegiatan'] === 'Lain-lain'){
                        $kegiatancp->tempat_kegiatan = null;
                        $kegiatancp->bidang_kegiatan = null;
                    }

                    $kegiatancp->save();

                    $cp->id_kegiatan_cp = $kegiatancp->id_kegiatan_cp;
                    $cp->save();
                }else{
                    if(KegiatanCP::find($cp->id_kegiatan_cp)){
                        $kegiatancp = KegiatanCP::find($cp->id_kegiatan_cp);
                        $kegiatancp->delete();
                        $cp->id_kegiatan_cp = null;
                        $cp->save();
                    }
                }

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

        // return dd(Auth::user());

        return view('admin.cp.addCP', compact('pengaturan'));
    }

    protected function store(RegisterCPRequest $request){
        $user = new User;
        $user->username = $request['usernameCP'];
        $user->id_status = 3;
        $user->email = $request['emailCP'];
        $user->password = Hash::make($request['passwordCP']);
        $user->refresh_token = Hash::make('asdasd');

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
                $cp->alumni = $request['alumni'];

                if($request['cv'] != null){
                    $cp->cv = $this->createFile($request['cv']);
                    // if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
                    //     return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
                    // }else{
                    //     $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
                    // }
                }

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

                if($request['alumni'] === 'Y'){
                    $kegiatan_cp = new KegiatanCP;
                    $kegiatan_cp->jenis_kegiatan = $request['jenis_kegiatan'];

                    if($request['jenis_kegiatan'] === 'Bekerja' || $request['jenis_kegiatan'] === 'Kuliah'){
                        $kegiatan_cp->tempat_kegiatan = $request['tempat_kegiatan'];
                        $kegiatan_cp->bidang_kegiatan = $request['bidang_kegiatan'];
                    }

                    $kegiatan_cp->save();
                    $cp->id_kegiatan_cp = $kegiatan_cp->id_kegiatan_cp;
                }

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
