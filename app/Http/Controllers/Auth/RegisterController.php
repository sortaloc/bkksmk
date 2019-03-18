<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Kontak;
use App\KegiatanCP;
use App\Pengaturan;
use App\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCPRequest;
use App\Http\Requests\RegisterPerusahaanRequest;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Google_Client $client)
    {
        $this->middleware('guest');
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

    protected function index()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('auth.register', compact('pengaturan'));
    }

    protected function register(RegisterPerusahaanRequest $request){
        $user = new User;
        $user->id_status = 2;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        if($user->save()){
            $kontak = new Kontak;
            $kontak->no_hp = $request['no_hp'];

            if($kontak->save()){
                $perusahaan = new DaftarPerusahaan;
                $perusahaan->id_user = $user->id_user;
                $perusahaan->id_kontak = $kontak->id_kontak;
                $perusahaan->nama = $request['nama_perusahaan'];
                $perusahaan->foto = 'nophoto.jpg';
                $perusahaan->noSurat = $request['noSurat'];
                $perusahaan->suratKerjasama = $this->createFile($request->file('suratKerjasama'));

                if($perusahaan->save()){
                    return redirect('/login')->with('success', 'Pendaftaran berhasil, silahkan login');
                }
            }
        }
    }

    protected function showRegisterCP(){
        $pengaturan = Pengaturan::all()->first();

        return view('auth.registerCP', compact('pengaturan'));
    }

    protected function registerCP(RegisterCPRequest $request){
        $daftarAlumni = Alumni::all();
        $isValid = false;
        if($request['alumni'] === "Y"){
            foreach($daftarAlumni as $index => $da){
                if($da->nis == $request['nis']){
                   $isValid = true;
                   $indeks = $index;
                }
            }

            if($isValid){
                if(((int)date('Y') - substr($daftarAlumni[$indeks]->angkatan, 0, 4)) <= 5){
                    $user = new User;
                    $user->id_status = 3;
                    $user->username = $request['usernameCP'];
                    $user->email = $request['emailCP'];
                    $user->password = Hash::make($request['passwordCP']);
                    $user->refresh_token = Hash::make('asdasd');

                    if($user->save()){
                        $kontak = new Kontak;
                        $kontak->no_hp = $request['no_hp_cp'];

                        if($kontak->save()){
                            $cp = new DaftarCP;
                            $cp->nis = $request['nis'];
                            $cp->id_user = $user->id_user;
                            $cp->id_kontak = $kontak->id_kontak;
                            $cp->nama = $request['nama'];
                            $cp->jenis_kelamin = $request['jk'];
                            $cp->foto = 'nophoto.jpg';
                            $cp->alumni = $request['alumni'];

                            if($request['alumni'] === 'Y'){
                                $kegiatan_cp = new KegiatanCP;
                                $kegiatan_cp->jenis_kegiatan = 'Lain-lain';
                                $kegiatan_cp->save();
                                $cp->id_kegiatan_cp = $kegiatan_cp->id_kegiatan_cp;
                            }

                            if($cp->save()){
                                return redirect('/login')->with('success', 'Berhasil mendaftar, Silahkan login.');
                            }
                        }
                    }
                } else {
                    return redirect('/register')->with('warning', 'Alumni yang bisa mendaftar hanya lulusan 2 tahun terakhir.');
                }
            } else {
                return redirect('/register')->with('warning', 'NIS tidak terdaftar.');
            }
        } else {
            $user = new User;
            $user->id_status = 3;
            $user->username = $request['usernameCP'];
            $user->email = $request['emailCP'];
            $user->password = Hash::make($request['passwordCP']);
            $user->refresh_token = Hash::make('asdasd');

            if($user->save()){
                $kontak = new Kontak;
                $kontak->no_hp = $request['no_hp_cp'];

                if($kontak->save()){
                    $cp = new DaftarCP;
                    $cp->nis = $request['nis'];
                    $cp->id_user = $user->id_user;
                    $cp->id_kontak = $kontak->id_kontak;
                    $cp->nama = $request['nama'];
                    $cp->jenis_kelamin = $request['jk'];
                    $cp->foto = 'nophoto.jpg';
                    $cp->alumni = $request['alumni'];

                    if($request['alumni'] === 'Y'){
                        $kegiatan_cp = new KegiatanCP;
                        $kegiatan_cp->jenis_kegiatan = 'Lain-lain';
                        $kegiatan_cp->save();
                        $cp->id_kegiatan_cp = $kegiatan_cp->id_kegiatan_cp;
                    }

                    if($cp->save()){
                        return redirect('/login')->with('success', 'Berhasil mendaftar, Silahkan login.');
                    }
                }
            }
        }
    }
}
