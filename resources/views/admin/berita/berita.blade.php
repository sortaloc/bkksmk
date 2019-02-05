@extends('layouts.app')

@section('title')
    Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-beritaLP.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-search.css') }}">
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
                    <div class="searchBarContainer">
                        <form action="{{ url('admin/berita') }}" method="GET">
                            <input type="text" class="searchBar" name="search" @if($statusSearch) value="{{ $request->input('search') }}" @endif placeholder="Cari berita..."/>
                            <button type="submit" class="btn btn-secondary btn-square submitBar">Cari</button>
                        </form>
                    </div>
                    @if($statusSearch)
                    <i><h1> Hasil pencarian "<b>{{ $request->input('search') }}</b>" ... </h1></i>
                    @endif
                    @if(count($berita) > 0)
                        {{-- <div class="daftarItem">
                            @foreach($berita as $b)
                                <div class="box item berita" data-berita="{{ $b }}" data-edit="{{ url('admin/berita/edit', $b->slug) }}" data-hapus="{{ url('admin/berita', base64_encode($b->id_berita)) }}">
                                    <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" alt="{{ $b->judul_berita }}" @endif class="img-fluid">
                                    <p class="text-center m-0">{{ $b->judul_berita }}</p>
                                </div>
                            @endforeach
                        </div> --}}
                        <div id="beritaItemContainer" class="my-3">
                            @foreach($berita as $b)
                                <div class="box beritaItem berita" data-berita="{{ $b }}" data-edit="{{ url('admin/berita/edit', $b->slug) }}" data-hapus="{{ url('admin/berita', base64_encode($b->id_berita)) }}">
                                    <div class="leftSide">
                                        <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                                    </div>
                                    <div class="rightSide p-3">
                                        <h1 class="judulBerita2">{{ str_limit($b->judul_berita, 70) }}</h1>
                                        <small class="text-muted"><i>{{ date_format($b->created_at, 'd F Y, H:i ') }}WIB</i></small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="my-3">
                            @if($statusSearch)
                                {{ $berita->appends(['search' => $request->input('search')])->links() }}
                            @else
                                {{ $berita->links() }}
                            @endif
                        </div>
                    @elseif($statusSearch && count($berita) <= 0)
                        <p class="text-center">
                            Maaf, berita yang anda cari tidak ditemukan. <br/>
                            Silakan <a href="{{ url('admin/berita/add') }}"> <b>klik disini</b> </a> atau klik tombol <i class="fas fa-plus"></i> di sebelah kanan bawah layar untuk membuat berita.
                        </p>
                    @else
                        <p class="text-center">
                            Belum ada berita. <br />
                            Silakan <a href="{{ url('admin/berita/add') }}"> <b>klik disini</b> </a> atau klik tombol <i class="fas fa-plus"></i> di sebelah kanan bawah layar untuk membuat berita.
                        </p>
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
