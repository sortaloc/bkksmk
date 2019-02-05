@extends('layouts.app')

@section('title')
    Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-beritaLP.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-search.css') }}">
@endsection

@section('content')
<div class="container">
    @if(($jumlahBerita > 0 && $jumlahBerita <= 4) || ($statusSearch))
        <h1 style="border-bottom: 3px solid grey">Daftar Berita</h1>
        <div class="searchBarContainer">
            <form action="{{ url('berita') }}" method="GET">
                <input type="text" class="searchBar" name="search" @if($statusSearch) value="{{ $request->input('search') }}" @endif placeholder="Cari berita..."/>
                <button type="submit" class="btn btn-secondary btn-square submitBar">Cari</button>
            </form>
        </div>
        @if($statusSearch)
            <i><h1> Hasil pencarian "<b>{{ $request->input('search') }}</b>" ... </h1></i>
        @endif
        <div id="beritaItemContainer" class="my-3">
            @if($statusSearch)
                @if(count($searchBerita) > 0)
                    @foreach($searchBerita as $b)
                        <a href="{{ url('berita', $b->slug) }}">
                            <div class="beritaItem box">
                                <div class="leftSide">
                                    <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                                </div>
                                <div class="rightSide p-3">
                                    <h1 class="judulBerita2">{{ $b->judul_berita }}</h1>
                                    <small class="text-muted"><i>{{ date_format($b->created_at, 'd F Y, H:i ') }}WIB</b></i></small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>Maaf, berita yang anda cari tidak ditemukan.</p>
                @endif
            @else
                @foreach($latestBerita as $b)
                    <a href="{{ url('berita', $b->slug) }}">
                        <div class="beritaItem box">
                            <div class="leftSide">
                                <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                            </div>
                            <div class="rightSide p-3">
                                <h1 class="judulBerita2">{{ $b->judul_berita }}</h1>
                                <small class="text-muted"><i>{{ date_format($b->created_at, 'd F Y, H:i ') }}WIB</b></i></small>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        @if($statusSearch)
            <div class="my-3">
                {{ $searchBerita->appends(['search' => $request->input('search')])->links() }}
            </div>
        @endif
    @elseif($jumlahBerita > 4 && !$statusSearch)
        <h1 style="border-bottom: 3px solid grey;width: fit-content;">Berita Terbaru</h1>
        <div id="beritaSisanya" class="my-3">
            @foreach($latestBerita as $lb)
                <a href="{{ url('berita', $lb->slug) }}" class="beritaSisanyaItem box">
                    <div class="fotoAtas">
                        <img @if($lb->foto_berita !== 'nophoto.jpg') src="{{ asset('storage/fotoBerita/'.$lb->foto_berita) }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" @endif alt="{{ $lb->judul_berita }}" class="img-fluid">
                    </div>
                    <div class="textBawah">
                        <small class="text-muted"><i>{{ date_format($lb->created_at, 'd F Y, H:i ') }}WIB</i></small>
                        <h1 style="font-size: 20px">{{ $lb->judul_berita }}</h1>
                    </div>
                </a>
            @endforeach
        </div>

        <h1 style="border-bottom: 3px solid grey;width: fit-content;">Daftar Berita</h1>
        <div class="searchBarContainer">
            <form action="{{ url('berita') }}" method="GET">
                <input type="text" class="searchBar" name="search" placeholder="Cari berita..." />
                <button type="submit" class="btn btn-secondary btn-square submitBar">Cari</button>
            </form>
        </div>
        <div id="beritaItemContainer">
            @foreach($berita as $b)
                <a href="{{ url('berita', $b->slug) }}" class="beritaItem box">
                    <div class="leftSide">
                        <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                    </div>
                    <div class="rightSide p-3">
                        <small class="text-muted"><i>{{ date_format($b->created_at, 'd F Y, H:i ') }}WIB</i></small>
                        <h1 class="judulBerita2">{{ $b->judul_berita }}</h1>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="my-3">
            {{ $berita->links() }}
        </div>
    @else
        <h1 style="border-bottom: 3px solid grey;width: fit-content;">Daftar Berita</h1>
        <p class="text-center">Maaf, saat ini belum ada berita.</p>
    @endif
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#menuBerita').addClass('active');
</script>
@endsection
