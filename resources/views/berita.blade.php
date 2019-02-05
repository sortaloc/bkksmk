@extends('layouts.app')

@section('title')
    Detail Berita -
@endsection

@section('css')
<style>
    .backButton:hover {
        color: rgba(0, 0, 0, 0.8);
    }

    #berita {
        display: grid;
        grid-template-columns: repeat(4, 25%);
        grid-gap: 1em;
    }

    #berita > #isiBerita {
        grid-column: 1 / 4;
        padding: 1em;
        background-color: rgba(255, 255, 255, 0.8);
        height: fit-content;
    }

    #beritaTerbaru > a > .beritaSisanyaItem {
        position: relative;
        overflow: hidden;
    }

    #beritaTerbaru > a > .beritaSisanyaItem:hover {
        opacity: 0.8;
    }

    #beritaTerbaru > a > .beritaSisanyaItem > .judulBerita {
        min-width: 100%;
    }

    #beritaTerbaru > a > .beritaSisanyaItem > a > .imgBeritaTerbaru {
        max-height: 200px;
        min-width: 100%;
        object-fit: cover;
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px){
        #berita {
            grid-template-columns: auto;
        }

        #berita > #isiBerita {
            grid-column: 1;
            padding: 1em;
            background-color: rgba(255, 255, 255, 0.8);
            height: fit-content;
        }

        #beritaTerbaru {
            display: grid;
            grid-template-columns: repeat(3, auto);
            grid-gap: 1em;
        }

        #beritaTerbaru > a > .beritaSisanyaItem {
            max-height: 100px;
            overflow: hidden;
        }

        #headlineBerita {
            grid-column: 1 / 4;
        }
    }

    @media only screen and (min-width: 576px) and (max-width: 768px){
        #beritaTerbaru {
            grid-template-columns: repeat(2, auto);
        }

        #headlineBerita {
            grid-column: 1 / 3;
        }
    }

    @media only screen and (max-width: 576px){
        #beritaTerbaru {
            grid-template-columns: auto;
        }
        #berita {
            grid-template-columns: 100%;
        }

        #berita > #isiBerita {
            grid-column: 1 / 1;
        }
    }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
@endsection

@section('content')
<div class="container" id="berita">
    <section id="isiBerita">
        <small class="text-muted"><i>{{ date_format($berita->created_at, 'd F Y, H:i ') }}WIB</i></small>
        <h1 class="m-0"> {{ $berita->judul_berita }}</h1>
        <small class="text-muted" style="font-size: 12px;">Diposting oleh: <b>{{ $berita->penulis }}</b></small>

        @if($berita->foto_berita !== 'nophoto.jpg')
            <img src="{{ asset('storage/fotoBerita/'.$berita->foto_berita) }}" alt="{{ $berita->judul_berita }}" class="img-fluid imgZoom imgBerita my-2" style="width: 100%"/>
        @endif
        <p class="text-justify"> {!! $berita->isi_berita !!} </p>
    </section>

    <section id="beritaTerbaru">
        <h3 style="border-bottom: 3px solid grey;width: fit-content" id="headlineBerita"> Berita Terbaru </h3>
        @foreach($beritaTerbaru as $bt)
            <a href="{{ url('berita', $bt->slug) }}">
                <div class="beritaSisanyaItem">
                    <p class="judulBerita"> {{ str_limit($bt->judul_berita, 31) }} <br /> <small>{{ date_format($bt->created_at, 'd F Y, H:i ') }}WIB</small></p>
                    <img @if($bt->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$bt->foto_berita) }}" alt="{{ $bt->judul_berita }}" @endif class="img-fluid imgBeritaTerbaru mb-2 box" />
                </div>
            </a>
        @endforeach
    </section>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#menuBerita').addClass('active');
</script>
@include('layouts.modalGambar')
@endsection
