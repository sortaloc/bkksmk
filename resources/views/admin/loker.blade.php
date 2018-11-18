@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modalLoker.css') }}">
@endsection

@section('content')
<div class="container">
    <section class="modal" id="modalLoker">
        <span class="close">&times;</span>
        <div class="row justify-content-center">
            <div class="col-3" id="brosurModalContainer">
                <img id="brosurModal" class="img-fluid">
                <small class="text-light">Klik gambar untuk memperbesar / memperkecil gambar!</small>
            </div>
            <div class="col-5" id="dataModalContainer">
                <div class="card box btn-square">
                    <div class="card-header text-center h3" id="judulModal"></div>
                    <div class="card-body">
                        Sebagai <span id="bidangModal"></span><br />
                        <span class="text-muted small" id="postModal">Dipost oleh: <span id="siapaModal"></span> pada <span id="waktuModal"></span> | <span id="keaktifanModal"></span></span>
                        <h4 class="mt-2"> Persyaratan </h4>
                        <span id="persyaratanModal"></span>
                        <h4> Gaji </h4>
                        <p id="gajiModal"></p>
                        <h4> Jam Kerja </h4>
                        <p id="jamKerjaModal"></p>
                        <h4> Keterangan Lainnya </h4>
                        <p id="keteranganModal"></p>
                        <h4> Jadwal Tes </h4>
                        <p id="jadwalModal"></p>
                        <div class="btn-group">
                            <a class="btn btn-primary buttonEdit"><i class="far fa-edit"></i></a>
                            <a class="btn btn-primary text-left buttonEdit">Edit</a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-danger deleteButton buttonDelete"><i class="fas fa-trash"></i></a>
                            <a class="btn btn-danger deleteButton text-left buttonDelete">Hapus</a>
                        </div>
                        <div class="btn-group float-right">
                            <a class="btn btn-primary buttonPelamar"><span id="jumlahPelamar"></span></a>
                            <a class="btn btn-primary text-left buttonPelamar">Daftar Pelamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        @include('layouts.adminmenu')
        <a href="{{ url('admin/loker/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
        <section class="col-md-9" id="dashboard">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Daftar Loker</div>

                <div class="card-body justify-content-center" id="daftarLoker">
                    @foreach($loker as $l)
                    <div class="box loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid">
                        <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                    </div>
                    @endforeach
                </div>
                {{ $loker->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('.adminmenu_loker').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
