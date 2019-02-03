@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
<style>
    #beritaItemContainer {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, auto);
        grid-column-gap: 1em;
        margin: 0;
    }

    .beritaItem {
        display: grid;
        grid-template-columns: 25% 75%;
        margin-bottom: 1em;
        background-color: #ddd;
        height: 100px;
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
        max-height: 100px;
        overflow: hidden;
    }

    .fotoAtas > img {
        object-fit: cover;
    }

    .textBawah {
        padding: 10px;
        min-height: 100px;
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
            height: auto;
        }
        #beritaSisanya {
            height: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                @include('layouts.cpmenu')
                <div class="col-lg-9">
                    <div class="card btn-square box" style="background-color: rgba(255, 255, 255, 0.8)">
                        <div class="card-header text-center h3">Daftar Berita</div>

                        <div class="card-body">
                            @if(count($berita) > 0)
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
    $('.cpmenu_berita').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection

