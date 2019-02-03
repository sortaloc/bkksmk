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

    #isiBerita > .imgBerita {
        max-height: 250px;
        min-width: 100%;
        object-fit: cover;
    }

    #berita > #isiBerita {
        grid-column: 1 / 4;
        padding: 1em;
        background-color: rgba(255, 255, 255, 0.8);
        height: fit-content;
    }

    #beritaTerbaru > .beritaSisanyaItem {
        position: relative;
        overflow: hidden;
    }

    #beritaTerbaru > .beritaSisanyaItem:hover {
        opacity: 0.8;
    }

    #beritaTerbaru > .beritaSisanyaItem > .judulBerita {
        min-width: 100%;
    }

    #beritaTerbaru > .beritaSisanyaItem > a > .imgBeritaTerbaru {
        max-height: 200px;
        min-width: 100%;
        object-fit: cover;
    }

    @media only screen and (max-width: 1024px){
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

        #beritaTerbaru > .beritaSisanyaItem {
            max-height: 100px;
            overflow: hidden;
        }

        #headlineBerita {
            grid-column: 1 / 4;
        }
    }

    @media only screen and (max-width: 768px){
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

        #headlineBerita {
            grid-column: 1 / 2;
        }
    }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
@endsection

@section('content')
<div class="container" id="berita">
    <section id="isiBerita">
        <a
            @if(Auth::user())
                @if(Auth::user()->id_status === 2)
                    href="{{ url('perusahaan/berita') }}"
                @elseif(Auth::user()->id_status === 3)
                    href="{{ url('cp/berita') }}"
                @endif
            @else
                href="{{ url('/berita') }}"
            @endif
            class="backButton"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>

        @if($berita->foto_berita !== 'nophoto.jpg')
            <img src="{{ asset('storage/fotoBerita/'.$berita->foto_berita) }}" alt="{{ $berita->judul_berita }}" class="img-fluid imgZoom imgBerita my-2" />
        @endif
        <small><i>{{ date_format($berita->created_at, 'd M Y') }} · <b>{{ $berita->penulis }}<b/></i></small>
        <h1> {{ $berita->judul_berita }} </h1>
        <p class="text-justify"> {!! $berita->isi_berita !!} </p>
    </section>

    <section id="beritaTerbaru">
        <h3 style="border-bottom: 3px solid grey;width: fit-content" id="headlineBerita"> Berita Terbaru </h3>
        @foreach($beritaTerbaru as $bt)
            <div class="beritaSisanyaItem">
                <p class="judulBerita"> {{ $bt->judul_berita }} <br /> <small>{{ date_format($bt->created_at, 'd/m/Y H:i:s') }}</small></p>
                <a href="{{ url('berita', $bt->slug) }}">
                    <img @if($bt->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$bt->foto_berita) }}" alt="{{ $bt->judul_berita }}" @endif class="img-fluid imgBeritaTerbaru mb-2 box" />
                </a>
            </div>
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
