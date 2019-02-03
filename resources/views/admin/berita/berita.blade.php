@extends('layouts.app')

@section('title')
    Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modal.css') }}">
@endsection

@section('content')
<div class="container">
    <section class="modal" id="modalLoker">
        <span class="close">&times;</span>
        <div class="row justify-content-center">
            <div class="col-8" id="dataModalContainer">
                <div class="card box btn-square">
                    <div class="card-header text-center h3" id="judulModal"></div>
                    <div class="card-body text-center   ">
                        <span class="text-muted small">Dipost pada: <span id="waktuModal"></span>, oleh: <span id="penulisModal"></span></span>
                        <div id="fotoModalContainer">
                            <img id="fotoModal" class="img-fluid"><br />
                            <small class="text-dark">Klik gambar untuk memperbesar / memperkecil gambar!</small>
                        </div>
                        <p id="isiBerita" class="text-justify"></p>
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
        <a href="{{ url('admin/berita/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
        <section class="col-md-9" id="berita">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Daftar Berita</div>

                <div class="card-body" id="daftarBerita">
                    @if(count($berita) < 1)
                        <p class="text-center">
                            Belum ada berita. <br />
                            Silakan <a href="{{ url('admin/berita/add') }}"> <b>klik disini</b> </a> atau klik tombol <i class="fas fa-plus"></i> di sebelah kanan bawah layar untuk membuat berita.
                        </p>
                    @else
                        <div class="daftarItem">
                            @foreach($berita as $b)
                                <div class="box item berita" data-berita="{{ $b }}" data-edit="{{ url('admin/berita/edit', $b->slug) }}" data-hapus="{{ url('admin/berita', base64_encode($b->id_berita)) }}">
                                    <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" alt="{{ $b->judul_berita }}" @endif class="img-fluid">
                                    <p class="text-center m-0">{{ $b->judul_berita }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.adminmenu_berita').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modalBerita.js') }}"></script>
@endsection
