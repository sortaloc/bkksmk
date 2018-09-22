<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\DaftarPerusahaan;
use App\DaftarCP;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCPRequest;
use App\Http\Requests\RegisterPerusahaanRequest;

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
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function register(RegisterPerusahaanRequest $request){
        $user = new User;
        $user->id_status = 2;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        if($user->save()){
            $perusahaan = new DaftarPerusahaan;
            $perusahaan->id_user = $user->id_user;
            $perusahaan->nama = $request['nama_perusahaan'];
            $perusahaan->foto = 'nophoto.jpg';

            if($perusahaan->save()){
                return redirect('/home');
            }
        }
    }

    protected function showRegisterCP(){
        return view('auth.registerCP');
    }

    protected function registerCP(RegisterCPRequest $request){
        $user = new User;
        $user->id_status = 3;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        if($user->save()){
            $cp = new DaftarCP;
            $cp->nis = $request['nis'];
            $cp->id_user = $user->id_user;
            $cp->nama = $request['nama'];
            $cp->jenis_kelamin = $request['jk'];

            if($cp->save()){
                return redirect('/home');
            }
        }
    }
}
