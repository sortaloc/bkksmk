<?php

namespace App\Http\Controllers\CP;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use Auth;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

class LamaranController extends Controller
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

    protected function ambil($uploadPath, $file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs($uploadPath, $nameFinal);

        return $nameFinal;
    }

    protected function index($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));

        return view('cp.lamaran', compact('loker', 'pengaturan'));
    }

    protected function uploadLamaran(Request $request, $id){
        $lamaran = new Lamaran;
        $lamaran->nis = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first()->nis;
        $lamaran->id_loker = Loker::find(base64_decode($id))->id_loker;

        if($request['surat_lamaran'] != null){
            $lamaran->surat_lamaran = $this->createFile($request['surat_lamaran']);
            // if(substr($request['surat_lamaran'], 0, 33) !== 'https://drive.google.com/open?id='){
            //     return back()->with('error', 'Surat lamaran tidak valid, silahkan ikut tata cara mengambil link google drive.');
            // }else{
            //     $lamaran->surat_lamaran = substr($request['surat_lamaran'], 0, 25) . 'file/d/' . substr($request['surat_lamaran'], 33) . '/preview';
            // }
        }

        $lamaran->keterangan_lamaran = $request['keterangan'];
        $lamaran->status = 'pending';

        if($lamaran->save()){
            return redirect('/home')->with('success', 'Data berhasil dikirim!');
        }
    }
}
