<?php

namespace App\Http\Controllers\Perusahaan;

use App\DaftarPerusahaan;
use App\Loker;
use App\Lamaran;
use App\Pengaturan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddLokerRequest;

use Illuminate\Http\Request;

use Auth;

class LokerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isPerusahaan');
    }

    protected function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/brosur', $nameFinal);

        return $nameFinal;
    }

    protected function index(){
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        return view('perusahaan.addLoker', compact('perusahaan', 'pengaturan'));
    }

    protected function addLoker(AddLokerRequest $request){
        $loker = new Loker;
        $perusahaan = DaftarPerusahaan::where('id_user', Auth::user()->id_user)->get()->first();

        $loker->id_perusahaan = $perusahaan->id_perusahaan;
        $loker->judul = $request['judul'];
        $loker->bidang_pekerjaan = $request['bidang_pekerjaan'];
        $loker->persyaratan = $request['persyaratan'];
        $loker->jam_kerja = $request['jam_kerja'];
        $loker->status = 'Aktif';
        $loker->gaji = $request['gaji'];
        $loker->keterangan_loker = $request['keterangan'];
        $loker->jadwal_tes = $request['jadwal_tes'];
        $loker->waktu_tes = $request['waktu_tes_jam'] . ':'  . $request['waktu_tes_menit'];
        $loker->tempat_tes = $request['tempat_tes'];

        if($request->file('brosur')){
            $nameToStore = $this->ambil($request->file('brosur'));
        }else if($request['brosur']){
            $nameToStore = $this->ambil($request['brosur']);
        }else{
            $nameToStore = 'nophoto.jpg';
        }

        $loker->brosur = $nameToStore;

        if($loker->save()){
            return redirect('/home')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    protected function deleteLoker($id){
        $loker = Loker::find(base64_decode($id));

        if(count($loker->lamaran) > 0){
            return back()->with('error', 'Data tidak bisa dihapus karena sudah ada yang melamar.');
        }else{
            if($loker->brosur !== 'nophoto.jpg'){
                unlink('storage/brosur/'.$loker->brosur);
            }

            if($loker->delete()){
                return redirect('/home')->with('success', 'Data berhasil dihapus!');
            }
        }
    }

    protected function editLoker($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));

        return view('perusahaan.editLoker', compact('loker', 'pengaturan'));
    }

    protected function updateLoker(AddLokerRequest $request, $id){
        $loker = Loker::find(base64_decode($id));
        $loker->judul = $request['judul'];
        $loker->persyaratan = $request['persyaratan'];
        $loker->jam_kerja = $request['jam_kerja'];
        $loker->status = $request['status'];
        $loker->gaji = $request['gaji'];
        $loker->keterangan_loker = $request['keterangan'];
        $loker->jadwal_tes = $request['jadwal_tes'];
        $loker->waktu_tes = $request['waktu_tes_jam'] . ':'  . $request['waktu_tes_menit'];
        $loker->tempat_tes = $request['tempat_tes'];

        if($request->file('brosur')){
            if($loker->brosur !== 'nophoto.jpg'){
                unlink('storage/brosur/'.$loker->brosur);
            }

            $nameToStore = $this->ambil($request->file('brosur'));
            $loker->brosur = $nameToStore;
        }

        if($loker->save()){
            return redirect('/home')->with('success', 'Data berhasil diubah!');
        }
    }

    protected function daftarPelamar($id){
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::find(base64_decode($id));
        $lamaran = Lamaran::where('id_loker', $loker->id_loker)->paginate(6);

        return view('perusahaan.daftarPelamar', compact('loker', 'pengaturan', 'lamaran'));
    }

    protected function verifPelamar(Request $request, $id){
        $lamaran = Lamaran::find(base64_decode($id));
        $lamaran->status = "diterima";
        $lamaran->alasan = $request['alasan'];

        if($lamaran->save()){
            return redirect('/home')->with('success', 'Calon pegawai sudah diterima');
        }
    }

    protected function tolakPelamar(Request $request, $id){
        $lamaran = Lamaran::find(base64_decode($id));
        $lamaran->status = 'ditolak';
        $lamaran->alasan = $request['alasan'];

        if($lamaran->save()){
            return redirect('/home')->with('success', 'Calon pegawai ditolak');
        }
    }
}
