@extends('layouts.app')

@section('title')
    Daftar Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-beritaLP.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-search.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                @include('layouts.perusahaanmenu')
                <div class="col-lg-9">
                    <div class="card btn-square box" style="background-color: rgba(255, 255, 255, 0.8)">
                        <div class="card-header text-center h3">Daftar Berita</div>

                        <div class="card-body">
                            <div class="searchBarContainer">
                                <form action="{{ url('perusahaan/berita') }}" method="GET">
                                    <input type="text" class="searchBar" name="search" @if($statusSearch) value="{{ $request->input('search') }}" @endif placeholder="Cari berita..."/>
                                    <button type="submit" class="btn btn-secondary btn-square submitBar">Cari</button>
                                </form>
                            </div>
                            @if($statusSearch)
                                <i><h1> Hasil pencarian "<b>{{ $request->input('search') }}</b>" ... </h1></i>
                            @endif
                            @if(count($berita) > 0)
                                <div id="beritaItemContainer" class="my-3">
                                    @foreach($berita as $b)
                                        <a href="{{ url('berita', $b->slug) }}">
                                            <div class="beritaItem box">
                                                <div class="leftSide">
                                                    <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                                                </div>
                                                <div class="rightSide p-3">
                                                    <h1 class="judulBerita2">{{ str_limit($b->judul_berita, 70) }}</h1>
                                                    <small class="text-muted"><i>{{ date_format($b->created_at, 'd F Y, H:i ') }}WIB</i></small>
                                                </div>
                                            </div>
                                        </a>
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
                                <p class="text-center">Maaf, berita yang anda cari tidak ditemukan.</p>
                            @else
                                <p class="text-center">Maaf, saat ini belum ada berita.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.perusahaanmenu_berita').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
