<?php

namespace App\Http\Controllers\Admin;

use App\Pengaturan;
use App\Alumni;

use App\Http\Requests\AddAlumniRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaturan = Pengaturan::all()->first();
        $alumni = Alumni::orderBy('created_at', 'descending')->get();

        return view('admin.alumni.alumni', compact('pengaturan', 'alumni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengaturan = Pengaturan::all()->first();

        return view('admin.alumni.addAlumni', compact('pengaturan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAlumniRequest $request)
    {
        $alumni = new Alumni;
        $alumni->nis = $request['nis'];
        $alumni->nama = $request['nama'];
        $alumni->angkatan = $request['angkatanAwal'] . ' / ' . $request['angkatanAkhir'];

        if($alumni->save()){
            return redirect('/admin/alumni')->with('success', 'Data alumni berhasil ditambahkan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengaturan = Pengaturan::all()->first();
        $alumni = Alumni::find(base64_decode($id));

        return view('admin.alumni.editAlumni', compact('pengaturan', 'alumni'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alumni = Alumni::find(base64_decode($id));
        $alumni->nama = $request['nama'];
        $alumni->angkatan = $request['angkatanAwal'] . ' / ' . $request['angkatanAkhir'];

        if($alumni->save()){
            return redirect('/admin/alumni')->with('success', 'Data alumni berhasil diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumni = Alumni::find(base64_decode($id));

        if($alumni->delete()){
            return redirect('/admin/alumni')->with('success', 'Data alumni berhasil dihapus!');
        }
    }
}
