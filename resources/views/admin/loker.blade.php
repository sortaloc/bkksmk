@extends('layouts.app')

@section('css')
<style type="text/css">
    .tambah {
        position: fixed;
        z-index: 999;
        bottom: 0;
        right: 15px;
    }
    .tambah:hover{
        background-color: black;
        color: white;
        transition: 0.5s;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.adminmenu')
        <a href="{{ url('admin/loker/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
        <section class="col-md-9" id="dashboard">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Daftar Loker</div>

                <div class="card-body row justify-content-center">
                    @foreach($loker as $l)
                        <div class="col-md-3 mb-3 brosur">
                            <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid imgZoom">
                        </div>
                        <div class="col-md-9">
                            <h1 class="judulLoker"><a href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}">{{$l->judul}}</a></h1>
                            @if(isset($l->id_perusahaan))
                                <span class="text-muted small">Dipost oleh: <a href="{{ url('admin/perusahaan/edit', base64_encode($l->id_perusahaan)) }}" class="a-normal">{{ $l->perusahaan->nama }}</a> pada {{$l->created_at}} | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif </span>
                            @else
                                <span class="text-muted small">Dipost oleh: Admin pada {{$l->created_at}} | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif <span>
                            @endif
                            <h4 class="mt-2"> Persyaratan </h4>
                            {!! $l->persyaratan !!}
                            <h4> Gaji </h4>
                            <p>{{ $l->gaji }}</p>
                            <h4> Jam Kerja </h4>
                            <p>{{ $l->jam_kerja }}</p>
                            <a href="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" class="jumlahPelamar btn-square badge badge-primary">{{ count($l->lamaran) }}</a>
                            <div class="btn-group">
                                <a href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                <a href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" class="btn btn-primary text-left">Edit</a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                <a href="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" class="btn btn-danger deleteButton text-left">Hapus</a>
                            </div>
                            <hr />
                        </div>
                    @endforeach
                    {{ $loker->links() }}
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('.adminmenu_loker').addClass('active');
</script>
@endsection

