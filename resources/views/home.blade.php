@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @if(Auth::user()->id_status === 1)
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ url('admin/loker/add') }}" class="btn btn-primary">Buat Lowongan Kerja</a>
                        <a href="{{ url('admin/perusahaan') }}" class="btn btn-primary">Daftar Perusahaan</a>
                        <a href="{{ url('admin/cp') }}" class="btn btn-primary">Daftar Calon Pegawai</a>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Daftar Loker</div>

                    <div class="card-body">
                        @foreach($loker as $l)
                            <div class="relative row">
                                <div class="close-btn bisaHover">
                                    <span href="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" class="deleteButton"><i class="text-danger">&times</i></span>
                                </div>
                                <div class="col-md-3">
                                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ 'assets/images/nophoto.jpg' }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif width="220px">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <a class="text-center" href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}">
                                        <h1> {{ $l->judul }} </h1>
                                    </a>
                                    @if(isset($l->id_perusahaan))
                                        <p> Nama Perusahaan : {{ $l->perusahaan->nama }} </p>
                                    @else
                                        <p> Nama Perusahaan : Admin </p>
                                    @endif
                                    <p> Persyaratan : {{ $l->persyaratan }} </p>
                                    <p> Gaji : {{ $l->gaji }} </p>
                                    <p> Jam Kerja : {{ $l->jam_kerja }} </p>
                                    <p> Keterangan : {{ $l->keterangan_loker }} </p>
                                    <a href="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}"> Jumlah Pelamar : {{ count($l->lamaran) }} </a>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(Auth::user()->id_status === 2)
            <div class="row">
                <div class="col-md-3">
                    <img class="img-fluid fotoProfil box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
                    <div class="menu mt-3 mb-3 box p-3">
                        <div class="menuTitle text-center h4">Main Menu</div>
                        <hr>
                        <a href="{{ url('perusahaan/loker/add') }}" class="text-white btn btn-primary btn-block" >Buat Loker</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card box btn-square">
                        <div class="card-header text-center h3">Daftar Loker Saya</div>

                        <div class="card-body">
                            <div class="row justify-content-center">
                                @foreach($loker as $l)
                                    <a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" class="relative d-inline-block col-md-4 col-sm-5 mr-3 mb-3 p-0" id="boxLoker">
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box brosur">
                                        <span href="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" class="close-btn deleteButton bisaHover"><i class="fas fa-times text-danger"></i></span>
                                        <span href="{{ url('perusahaan/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" class="jumlahPelamar btn-square badge badge-primary">{{ count($l->lamaran) }}</span>
                                        <span class="judulBrosur"> {{ $l->judul }} </span>
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{ $loker->links()  }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::user()->id_status === 3)
                <div class="card">
                    <div class="card-header">Daftar Loker</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($belumDiLamar as $l)
                            <div class="relative row">
                                <div class="col-md-3">
                                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif width="220px">
                                    </a>
                                </div>

                                <div class="col-md-8">
                                    <h1 class="text-center"> {{ $l->judul }} </h1>
                                    @if(isset($l->id_perusahaan))
                                        <p> Nama Perusahaan : {{ $l->perusahaan->nama }} </p>
                                    @else
                                        <p> Nama Perusahaan : Admin </p>
                                    @endif
                                    <p> Persyaratan: {!! $l->persyaratan !!} </p>
                                    <p> Gaji: {{ $l->gaji }} </p>
                                    <p> Jam Kerja: {{ $l->jam_kerja }} </p>
                                    <p> Keterangan: {{ $l->keterangan_loker }} </p>
                                    <a href="{{ url('cp/lamaran', base64_encode($l->id_loker)) }}">
                                        Lamar pekerjaan ini
                                    </a>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        @foreach($sudahDiLamar as $l)
                            <div class="relative row">
                                <div class="col-md-3">
                                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif width="220px">
                                    </a>
                                </div>

                                <div class="col-md-8">
                                    <h1 class="text-center"> {{ $l->judul }} </h1>
                                    @if(isset($l->id_perusahaan))
                                        <p> Nama Perusahaan : {{ $l->perusahaan->nama }} </p>
                                    @else
                                        <p> Nama Perusahaan : Admin </p>
                                    @endif
                                    <p> Persyaratan: {{ $l->persyaratan }} </p>
                                    <p> Gaji: {{ $l->gaji }} </p>
                                    <p> Jam Kerja: {{ $l->jam_kerja }} </p>
                                    <p> Keterangan: {{ $l->keterangan_loker }} </p>
                                    @foreach($l->lamaran as $la)
                                        @if($la->nis == $cp->nis)
                                            <p> Anda sudah melamar kesini dengan status '{{ $la->status }}'</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
