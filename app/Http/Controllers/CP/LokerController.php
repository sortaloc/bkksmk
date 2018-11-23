<?php

namespace App\Http\Controllers\CP;

use App\Loker;
use App\DaftarPerusahaan;
use App\Lamaran;
use App\DaftarCP;
use App\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class LokerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isCP');
    }

    public function daftarCPLoker(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        $lamaran = Lamaran::select('id_loker')->where('nis', $cp->nis)->get();
        $lokerFull = Loker::whereNotIn('id_loker', $lamaran)->orderBy('created_at', 'descending')->get();

        $bidangPekerjaan = Loker::whereNotIn('id_loker', $lamaran)->select('bidang_pekerjaan')->groupBy('bidang_pekerjaan')->get();
        $gaji = Loker::whereNotIn('id_loker', $lamaran)->select('gaji')->groupBy('gaji')->get();
        $perusahaanAll = DaftarPerusahaan::whereIn('id_perusahaan', $lokerFull)->get();

        $loker = Loker::whereNotIn('id_loker', $lamaran)->orderBy('created_at', 'descending');
        if($request->input('bp')){
            $loker = $loker->where('bidang_pekerjaan', $request->input('bp'));
        }

        if($request->input('gaji')){
            $loker = $loker->where('gaji', $request->input('gaji'));
        }

        if($request->input('np')){
            $loker = $loker->where('id_perusahaan', $request->input('np'));
        }

        $loker = $loker->paginate(8);

        return view('cp.loker', compact('loker', 'cp', 'pengaturan', 'perusahaanAll', 'bidangPekerjaan', 'gaji', 'request'));
    }

    public function daftarCPLamaran(Request $request)
    {
        $pengaturan = Pengaturan::all()->first();
        $cp = DaftarCP::where('id_user', Auth::user()->id_user)->get()->first();
        // $loker = Lamaran::join('loker', 'lamaran.id_loker', '=', 'loker.id_loker')
        // ->join('daftar_cp', 'lamaran.nis', '=', 'daftar_cp.nis')
        // ->selectRaw('loker.id_loker, loker.id_perusahaan, loker.judul, loker.bidang_pekerjaan, loker.persyaratan, loker.gaji, loker.jam_kerja, loker.keterangan_loker, loker.jadwal_tes, loker.waktu_tes, loker.tempat_tes, loker.status, loker.brosur, lamaran.status, loker.created_at, loker.updated_at')
        // ->whereRaw('lamaran.nis = '.$cp->nis)
        // ->paginate(2);

        $idLokerLamaran = Lamaran::select('id_loker')->where('nis', $cp->nis)->get();
        $lamaran = Lamaran::where('nis', $cp->nis)->orderBy('id_loker', 'descending')->get();

        $lokerFull = Loker::whereIn('id_loker', $idLokerLamaran)->orderBy('created_at', 'descending')->get();

        $bidangPekerjaan = Loker::whereIn('id_loker', $idLokerLamaran)->select('bidang_pekerjaan')->groupBy('bidang_pekerjaan')->get();
        $gaji = Loker::whereIn('id_loker', $idLokerLamaran)->select('gaji')->groupBy('gaji')->get();
        $perusahaanAll = DaftarPerusahaan::whereIn('id_perusahaan', $lokerFull)->get();

        $loker = Loker::whereIn('id_loker', $idLokerLamaran)->orderBy('id_loker', 'descending');
        if($request->input('bp')){
            $loker = $loker->where('bidang_pekerjaan', $request->input('bp'));
        }

        if($request->input('gaji')){
            $loker = $loker->where('gaji', $request->input('gaji'));
        }

        if($request->input('np')){
            $loker = $loker->where('id_perusahaan', $request->input('np'));
        }

        $loker = $loker->paginate(8);

        return view('cp.lokerSudah', compact('pengaturan', 'loker', 'lamaran', 'perusahaanAll', 'bidangPekerjaan', 'gaji', 'request'));
    }
}
