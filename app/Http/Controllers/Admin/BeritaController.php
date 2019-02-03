<?php

namespace App\Http\Controllers\Admin;

use App\Pengaturan;
use App\Berita;

use App\Http\Requests\AddBeritaRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    // Homemade Function
    protected function ambil($path, $file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs($path, $nameFinal);

        return $nameFinal;
    }

    protected function generateSlug($title){
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
        return time() . '-' . strtolower($slug);
    }

    // Prebuilt Function
    protected function index(){
        $pengaturan = Pengaturan::all()->first();
        $berita = Berita::orderBy('created_at', 'descending')->paginate(8);

        return view('admin.berita.berita', compact('berita', 'pengaturan'));
    }

    protected function add(){
        $pengaturan = Pengaturan::all()->first();

        return view('admin.berita.addBerita', compact('pengaturan'));
    }

    protected function store(AddBeritaRequest $request){
        $berita = new Berita;
        $berita->judul_berita = $request['judul_berita'];
        $berita->slug = $this->generateSlug($request['judul_berita']);
        $berita->isi_berita = $request['isi_berita'];

        if($request['penulis']){
            $berita->penulis = $request['penulis'];
        }else{
            $berita->penulis = "Admin";
        }

        if($request->file('foto_berita')){
            $nameToStore = $this->ambil('public/fotoBerita', $request->file('foto_berita'));
        }else{
            $nameToStore = 'nophoto.jpg';
        }
        $berita->foto_berita = $nameToStore;

        if($berita->save()){
            return redirect('admin/berita')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    protected function edit($slug){
        $pengaturan = Pengaturan::all()->first();
        $berita = Berita::where('slug', $slug)->first();

        return view('admin.berita.editBerita', compact('berita', 'pengaturan'));
    }

    protected function update(AddBeritaRequest $request, $id){
        $berita = Berita::find(base64_decode($id));

        $berita->judul_berita = $request['judul_berita'];
        $berita->slug = $this->generateSlug($request['judul_berita']);
        $berita->isi_berita = $request['isi_berita'];

        if($request['penulis']){
            $berita->penulis = $request['penulis'];
        }else{
            $berita->penulis = "Admin";
        }

        if($request->file('foto_berita')){
            if($berita->foto_berita !== 'nophoto.jpg'){
                unlink('storage/fotoBerita/'.$berita->foto_berita);
            }

            $nameToStore = $this->ambil('public/fotoBerita', $request->file('foto_berita'));
            $berita->foto_berita = $nameToStore;
        }

        if($berita->save()){
            return redirect('/admin/berita')->with('success', 'Data berhasil diubah!');
        }
    }

    protected function destroy($id){
        $berita = Berita::find(base64_decode($id));

        if($berita->delete()){
            return redirect('/admin/berita')->with('success', 'Data berhasil dihapus!');
        }
    }
}
