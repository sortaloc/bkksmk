<?php

namespace App\Http\Controllers\CP;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;
use App\Kontak;

use App\Http\Requests\DataDiriCPRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use Auth;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

class SettingsController extends Controller
{
    private $drive;

    public function __construct(Google_Client $client)
    {
        $this->middleware('auth');
        $this->middleware('isCP');
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

    protected function dataDiriCP(){
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();

        return view('settings.dataCP', compact('cp', 'pengaturan'));
    }

    protected function updateDataDiriCP(DataDiriCPRequest $request){
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $kontak = Kontak::find($cp->id_kontak);

        $cp->nama = $request['nama'];
        $cp->alamat = $request['alamat'];

        if($request['cv'] != null && $request['cv'] != $cp->cv){
            $cp->cv = $this->createFile($request['cv']);
            // if(substr($request['cv'], 0, 33) !== 'https://drive.google.com/open?id='){
            //     return back()->with('error', 'CV tidak valid, silahkan ikut tata cara mengambil link google drive.');
            // }else{
            //     $cp->cv = substr($request['cv'], 0, 25) . 'file/d/' . substr($request['cv'], 33) . '/preview';
            // }
        }

        $cp->jenis_kelamin = $request['jk'];
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
