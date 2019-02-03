@extends('layouts.app')

@section('title')
    Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
<style>
    #beritaItemContainer {
        width: 100%;
        padding: 1em 0;
        display: grid;
        grid-template-columns: repeat(2, auto);
        grid-gap: 1em;
    }

    .beritaItem {
        display: grid;
        grid-template-columns: 25% 75%;
        margin-bottom: 1em;
        background-color: #ddd;
    }

    .beritaItem > .leftSide > img {
        object-fit: cover;
        min-width: 100%;
        height: 100px;
    }

    .judulBerita2 {
        font-size: 20px;
    }

    /* --- */
    .fotoAtas{
        min-width: 100%;
        max-height: 120px;
        overflow: hidden;
    }

    .textBawah {
        padding: 10px;
    }

    .beritaSisanyaItem {
        background-color: #ccc;
    }

    .fotoAtas > img:hover {
        opacity: 0.75;
    }
    .beritaSisanyaItem:hover, .rightSide:hover {
        background-color: #888;
    }
    #beritaSisanya > a:hover, #beritaItemContainer > a:hover {
        color: rgba(230, 230, 230, 0.75);
    }

    @media only screen and (max-width: 1024px){
        #beritaItemContainer {
            grid-template-columns: auto;
            grid-gap: 0;
        }
        #beritaSisanya {
            height: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 style="border-bottom: 3px solid grey;width: fit-content;">Berita Terbaru</h1>
    <div id="beritaSisanya" class="my-3">
        @foreach($latestBerita as $lb)
            <a href="{{ url('berita', $lb->slug) }}">
                <div class="beritaSisanyaItem box">
                    <div class="fotoAtas">
                        <img @if($lb->foto_berita !== 'nophoto.jpg') src="{{ asset('storage/fotoBerita/'.$lb->foto_berita) }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" @endif alt="{{ $lb->judul_berita }}" class="img-fluid">
                    </div>
                    <div class="textBawah">
                        <small><i>{{ date_format($lb->created_at, 'd M Y') }} · <b>{{ $lb->penulis }}</b></i></small>
                        <h1 style="font-size: 20px">{{ $lb->judul_berita }}</h1>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <h1 style="border-bottom: 3px solid grey;width: fit-content;">Daftar Berita</h1>

    <div id="beritaItemContainer" class="my-3">
        @foreach($berita as $b)
            <a href="{{ url('berita', $b->slug) }}">
                <div class="beritaItem box">
                    <div class="leftSide">
                        <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" @endif alt="{{ $b->judul_berita }}" class="img-fluid imgBerita">
                    </div>
                    <div class="rightSide p-3">
                        <h1 class="judulBerita2">{{ $b->judul_berita }}</h1>
                        <small class="tanggalBerita"><i>{{ date_format($b->created_at, 'd M Y') }} · <b>{{ $b->penulis }}</b></i></small>
                        {{-- <p class="text-justify">{!! Str::words($b->isi_berita, 40, '...') !!}</p> --}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="my-3">
        {{ $berita->links() }}
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#menuBerita').addClass('active');
</script>
@endsection
