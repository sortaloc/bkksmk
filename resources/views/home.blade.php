@extends('layouts.app')

@section('css')
<style>
    .relative{
        position: relative;
    }
    .close-btn{
        color: red;
        position: absolute;
        top: 10px;
        right: 30px;
        transition: 0.5s;
        z-index: 999;
    }
    .close-btn:hover{
        color: rgba(255, 0, 0, 0.5);
        transition: 0.5s;
    }
    .bisaHover{
        cursor: pointer;
    }
</style>
@endsection

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
                        <hr>
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
                                <div class="col-md-9 text-center">
                                    <a href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}">
                                        <h1> {{ $l->judul }} </h1>
                                    </a>
                                    <p> {{ $l->persyaratan }} </p>
                                    <p> {{ $l->gaji }} </p>
                                    <p> {{ $l->jam_kerja }} </p>
                                    <p> {{ $l->keterangan_loker }} </p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(Auth::user()->id_status === 2)
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary">Buat Lowongan Kerja</a>
                        <hr>
                        @foreach($loker as $l)
                            <div class="relative row">
                                <div class="close-btn bisaHover">
                                    <span href="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" class="deleteButton"><i class="text-danger">&times</i></span>
                                </div>
                                <div class="col-md-3">
                                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif width="220px">
                                    </a>
                                </div>
                                <div class="col-md-9 text-center">
                                    <a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}">
                                        <h1> {{ $l->judul }} </h1>
                                    </a>
                                    <p> {{ $l->persyaratan }} </p>
                                    <p> {{ $l->gaji }} </p>
                                    <p> {{ $l->jam_kerja }} </p>
                                    <p> {{ $l->keterangan_loker }} </p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
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

                        <div class="row justify-content-center">
                            @foreach($loker as $l)
                            <div class="col-md-5 border m-1">
                                <h1> {{ $l->judul }} </h1>
                                <p> {{ $l->persyaratan }} </p>
                                <p> {{ $l->gaji }} </p>
                                <p> {{ $l->jam_kerja }} </p>
                                <p> {{ $l->keterangan_loker }} </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.deleteButton').on('click', function(){
        var $url = $(this).attr('href');
        swal({
            title: 'Hapus data ?',
            text: 'Jika data dihapus maka data yang bersangkutan akan ikut terhapus juga.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okelah, hapus aja!',
        }).then((result) =>{
            window.location.replace($url);
        });
    });
</script>
@endsection
