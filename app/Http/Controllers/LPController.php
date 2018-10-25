<?php

namespace App\Http\Controllers;

use App\Pengaturan;
use App\DaftarPerusahaan;
use App\Loker;
use App\BukuTamu;

use Illuminate\Http\Request;

use Auth;

class LPController extends Controller
{
    public function lp()
    {
        $pengaturan = Pengaturan::all()->first();
        $loker = Loker::where('status', 'Aktif')->paginate(6);

        if(Auth::user()){
            return redirect('/home');
        }

        return view('lp', compact('pengaturan', 'loker'));
    }

    public function mitra()
    {
        $pengaturan = Pengaturan::all()->first();
        $perusahaan = DaftarPerusahaan::paginate(6);
        $perusahaanAll = DaftarPerusahaan::all();

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
