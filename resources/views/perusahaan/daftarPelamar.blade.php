@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">Daftar Pelamar Loker {{ $loker->judul }}</div>
                <div class="card-body">
                    <div class="row">
                    @foreach($loker->lamaran as $l)
                        <div class="col-md-3 border p-3 text-center">
                            <a @if($l->daftarcp->foto !== 'nophoto.jpg') href="{{ url('storage/fotoCP/'.$l->daftarcp->foto) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                                <img @if($l->daftarcp === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoCP/'.$l->daftarcp->foto) }}" alt="{{ $l->daftarcp->nama }}" @endif width="220px">
                            </a>

                            <p>
                                NIS: {{ $l->daftarcp->nis }}<br>
                                Nama: {{ $l->daftarcp->nama }}<br>
                                Jenis Kelamin: {{ $l->daftarcp->jenis_kelamin }}<br>
                                Alamat: {{ $l->daftarcp->alamat }}<br>
                                Tanggal Lahir: {{ $l->daftarcp->ttl }}</p>
                            <p>
                                No HP: {{ $l->daftarcp->kontak->no_hp }}<br>
                                No Telepon: {{ $l->daftarcp->kontak->no_telepon }}<br>
                                ID Line: {{ $l->daftarcp->kontak->id_line }}<br>
                            </p>
                            Kontak Lainnya:<br>
                            {{ $l->daftarcp->kontak->kontak_dll }}<br><br>
                            Status: {{ $l->status }}<br><br>

                            <a href="{{ url('perusahaan/loker/verif_pelamar', base64_encode($l->id_lamaran)) }}">
                                Terima orang ini
                            </a>
                            <br>
                            <a href="{{ url('perusahaan/loker/tolak_pelamar', base64_encode($l->id_lamaran)) }}">
                                Tolak orang ini
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
