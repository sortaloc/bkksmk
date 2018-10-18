<?php

namespace App\Http\Controllers;

use App\Loker;
use App\DaftarPerusahaan;
use App\DaftarCP;
use App\Lamaran;
use App\Pengaturan;

use Illuminate\Http\Request;

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
    public function index()
    {
        $pengaturan = Pengaturan::all()->first();
        if (Auth::user()->id_status === 2) {
            $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();
            $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->orderBy('created_at', 'descending')->paginate(4);

            return view('home', compact('loker', 'perusahaan', 'pengaturan'));
        } else if (Auth::user()->id_status === 3) {
            $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
            $lamaran = Lamaran::where('nis', $cp->nis)->get();
            $loker = Loker::orderBy('created_at', 'descending')->paginate(4);

            $sudahDiLamar = [];
            $belumDiLamar = $loker;

            for ($i = count($loker) - 1; $i >= 0; $i--) {
                for ($j = count($lamaran) - 1; $j >= 0; $j--) {
                    if ($loker[$i]->id_loker === $lamaran[$j]->id_loker) {
                        array_push($sudahDiLamar, $loker[$i]);
                        if (isset($belumDiLamar[$i])) {
                            unset($belumDiLamar[$i]);
                            $i--;
                        }
                    }
                }
            }
            return view('home', compact('loker', 'sudahDiLamar', 'belumDiLamar', 'cp', 'pengaturan'));
        } else {
            $loker = Loker::orderBy('created_at', 'descending')->paginate(4);
            return view('home', compact('loker', 'pengaturan'));
        }
    }

    public function profilPerusahaan($id)
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::find(base64_decode($id));
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $lamaran = Lamaran::where('nis', $cp->nis)->get();
        $loker = Loker::where('id_perusahaan', $perusahaan->id_perusahaan)->orderBy('created_at', 'descending')->paginate(2     );

        $sudahDiLamar = [];
        $belumDiLamar = $loker;

        for ($i = count($loker) - 1; $i >= 0; $i--) {
            for ($j = count($lamaran) - 1; $j >= 0; $j--) {
                if ($loker[$i]->id_loker === $lamaran[$j]->id_loker) {
                    array_push($sudahDiLamar, $loker[$i]);
                    if (isset($belumDiLamar[$i])) {
                        unset($belumDiLamar[$i]);
                        $i--;
                    }
                }
            }
        }

        return view('cp.profilPerusahaan', compact('perusahaan', 'belumDiLamar', 'sudahDiLamar', 'cp', 'loker', 'pengaturan'));
    }

    public function tutorialUpload()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('cp.upload', compact('pengaturan'));
    }

    public function pengaturanIndex()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function ubahPengaturan(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();

        if($request->file('foto1')){
            if($pengaturan->foto1 !== 'nophoto.jpg'){
                unlink('storage/banner/'.$pengaturan->foto1);
            }

            $nameToStore = $this->ambil($request->file('foto1'));
            $pengaturan->foto1 = $nameToStore;
        }

        $pengaturan->banner1 = $request['banner1'];
        $pengaturan->fitur1 = $request['fitur1'];
        $pengaturan->fitur2 = $request['fitur2'];
        $pengaturan->fitur3 = $request['fitur3'];
        $pengaturan->alamat = $request['alamat'];
        $pengaturan->telp = $request['telp'];
        $pengaturan->fax = $request['fax'];
        $pengaturan->email = $request['email'];

        if($pengaturan->save()){
            return redirect('/home')->with('success', 'Data pengaturan berhasil diubah!');
        }
    }
}
