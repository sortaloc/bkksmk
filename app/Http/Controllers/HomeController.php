<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Lamaran;
use App\Pengaturan;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Socialite;
use Auth;

class HomeController extends Controller
{
    protected function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/banner', $nameFinal);

        return $nameFinal;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();
        if (Auth::user()->id_status === 2) {
            $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

            $bidangPekerjaan = Loker::select('bidang_pekerjaan')->where('id_perusahaan', $perusahaan->id_perusahaan)->groupBy('bidang_pekerjaan')->get();
            $gaji = Loker::select('gaji')->where('id_perusahaan', $perusahaan->id_perusahaan)->groupBy('gaji')->get();

            $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->orderBy('created_at', 'descending');
            if($request->input('bp')){
                $loker = $loker->where('bidang_pekerjaan', $request->input('bp'));
            }
            if($request->input('gaji')){
                $loker = $loker->where('gaji', $request->input('gaji'));
            }
            $loker = $loker->paginate(8);

            return view('home', compact('loker', 'perusahaan', 'pengaturan', 'bidangPekerjaan', 'gaji', 'request'));
        } else if (Auth::user()->id_status === 3) {
            $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
            // return dd(Auth::user());
            return view('home', compact('cp', 'pengaturan'));
        } else {
            $loker = Loker::orderBy('created_at', 'descending')->paginate(6);
            $cpKeterima = count(Lamaran::where('status', 'diterima')->get());
            $cpKetolak = count(Lamaran::where('status', 'ditolak')->get());
            $cpPending = count(Lamaran::where('status', 'pending')->get());
            $dataCP = [$cpKeterima, $cpKetolak, $cpPending];

            return view('home', compact('loker', 'pengaturan', 'dataCP'));
        }
    }

    public function tutorialUpload()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('cp.upload', compact('pengaturan'));
    }

    public function redirectToGoogleProvider()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }

    public function handleProviderGoogleCallback()
    {
        $auth_user = Socialite::driver('google')->stateless()->user();
        // return dd($auth_user);
        $user = User::find(Auth::user()->id_user);
        $user->refresh_token = $auth_user->token;
        $user->save();
        // $user = User::updateOrCreate(
        //     ['email' => $auth_user->email],
        //     ['refresh_token' => $auth_user->token]
        // );

        // Auth::login($user, true);
        return redirect()->to('/home'); // Redirect to a secure page
    }
}
