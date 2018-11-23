<?php

namespace App\Http\Controllers;

use App\Pengaturan;
use App\DaftarPerusahaan;
use App\Loker;
use App\BukuTamu;
use App\Kegiatan;

use Illuminate\Http\Request;

use Auth;

class LPController extends Controller
{
    public function lp(Request $request)
    {
        if(Auth::user()){
            return redirect('/home');
        }

        $pengaturan = Pengaturan::all()->first();
        $perusahaanAll = DaftarPerusahaan::all();
        $kegiatan = Kegiatan::all();
        $bidangPekerjaan = Loker::select('bidang_pekerjaan')->groupBy('bidang_pekerjaan')->get();
        $gaji = Loker::select('gaji')->groupBy('gaji')->get();
        // ->orderBy('created_at', 'descending')->paginate(8)
        $loker = Loker::where('status', 'Aktif');

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

        return view('lp', compact('pengaturan', 'loker', 'perusahaanAll', 'kegiatan', 'bidangPekerjaan', 'gaji', 'request'));
    }

    public function mitra()
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::paginate(6);

        return view('mitra', compact('pengaturan', 'perusahaan', 'perusahaanAll'));
    }

    public function tentang()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('tentang', compact('pengaturan'));
    }

    public function kontak()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('kontak', compact('pengaturan'));
    }

    public function kirimPesan(Request $request)
    {
        $bukutamu = new BukuTamu;
        $bukutamu->nama_pengirim = $request['nama_pengirim'];
        $bukutamu->asal_pengirim = $request['asal_pengirim'];
        $bukutamu->email_pengirim = $request['email_pengirim'];
        $bukutamu->judul_pesan = $request['judul_pesan'];
        $bukutamu->isi_pesan = $request['isi_pesan'];

        if($bukutamu->save()){
            return back()->with('success', 'Terima kasih telah mengirim pesan kepada kami.');
        }
    }
}
