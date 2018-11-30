@extends('layouts.app')

@section('title')
    Kegiatan -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modal.css') }}">
@endsection

@section('content')
<div class="container">
    <section class="modal" id="modalLoker">
        <span class="close">&times;</span>
        <div class="row justify-content-center">
            <div class="col-3" id="fotoModalContainer">
                <img id="fotoModal" class="img-fluid"><br />
                <small class="text-light">Klik gambar untuk memperbesar / memperkecil gambar!</small>
            </div>
            <div class="col-5" id="dataModalContainer">
                <div class="card box btn-square">
                    <div class="card-header text-center h3" id="judulModal"></div>
                    <div class="card-body">
                        <span class="text-muted small">Dipost pada: <span id="waktuModal"></span></span>
                        <h4> Deskripsi Kegiatan </h4>
                        <p id="deskripsiModal"></p>
                        <div class="btn-group">
                            <a class="btn btn-primary buttonEdit"><i class="far fa-edit"></i></a>
                            <a class="btn btn-primary text-left buttonEdit">Edit</a>
                        </div>
                        <div class="btn-group text-light">
                            <a class="btn btn-danger deleteButton buttonHapus"><i class="fas fa-trash"></i></a>
                            <a class="btn btn-danger deleteButton text-left buttonHapus">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        @include('layouts.adminmenu')
        <a href="{{ url('admin/kegiatan/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
        <section class="col-md-9" id="kegiatan">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Daftar Kegiatan</div>

                <div class="card-body" id="daftarKegiatan">
                    @if(count($kegiatan) < 1)
                        <p class="text-center">
                            Belum ada kegiatan. <br />
                            Silakan <a href="{{ url('admin/kegiatan/add') }}" class="altLink"> klik disini </a> atau klik tombol <i class="fas fa-plus"></i> di sebalah kanan bawah layar untuk membuat kegiatan.
                        </p>
                    @else
                        <div class="daftarItem">
                            @foreach($kegiatan as $k)
                            <div class="box item kegiatan" data-kegiatan="{{ $k }}" data-edit="{{ url('admin/kegiatan/edit', base64_encode($k->id_kegiatan)) }}" data-hapus="{{ url('admin/kegiatan', base64_encode($k->id_kegiatan)) }}">
                                <img @if($k->foto_kegiatan === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoKegiatan/'.$k->foto_kegiatan) }}" alt="{{ $k->judul_kegiatan }}" @endif class="img-fluid">
                                <p class="text-center m-0">{{ $k->judul_kegiatan }}</p>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                {{ $kegiatan->links() }}
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.adminmenu_kegiatan').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modalKegiatan.js') }}"></script>
@endsection
