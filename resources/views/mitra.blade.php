@extends('layouts.app')

@section('css')
<style>
    .slick-arrow {
        background-color: #555;
        padding: 2em !important;
    }
    .img-fluid-custom {
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-height: 120px;
        max-width: 80px;
    }
    #mitraContainer {
        display: grid;
        grid-template-columns: repeat(3, 32.5%);
        grid-gap: 1em;
        align-content: center;
    }
    #bawahSlide {
        display: grid;
        grid-template-columns: repeat(4, auto);
        grid-gap: 1em;
        align-content: center;
    }
    .img-custom {
        width: 100%;
        max-height: 200px;
        margin: 0 1em;
    }
    .mitra {
        margin: 0 0 1em 0;
        padding: 1em 0;
    }
    @media only screen and (max-width: 845px) {
        .img-center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        #mitraContainer {
            grid-template-columns: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card box btn-square">
        <div class="card-header text-center h3">Daftar Mitra Perusahaan</div>
        <div class="card-body">
            <div id="mitraContainer">
            @foreach($perusahaan as $p)
                <div class="mitra row box">
                    <div class="col-md-3">
                        <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-fluid-custom img-thumbnail imgZoom img-center">
                    </div>
                    <div class="col-md-9">
                        <p class="text-center">
                            <strong>
                                {{ $p->nama }}
                            </strong>
                            <br />
                            {!! str_limit($p->bio, 56) !!}
                        </p>
                    </div>
                </div>
                {{-- <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Alamat</h4>
                            <hr>
                            <p>{!! $p->alamat !!}</p>
                            <h4>Biografi</h4>
                            <hr>
                            <p>{!! $p->bio !!}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Kontak</h4>
                            <hr>
                            <p><b>No HP</b> <br> {{ $p->kontak->no_hp }}</p>
                            @if($p->kontak->no_telepon) <p><b>No Telepon</b> <br> {{ $p->kontak->no_telepon }}</p> @endif
                            @if($p->kontak->id_line) <p><b>ID Line</b> <br> {{ $p->kontak->id_line }}</p> @endif
                        </div>
                    </div>
                    <hr>
                </div> --}}
            @endforeach
            </div>
            <div>{{ $perusahaan->links() }}</div>
        </div>
    </div>
    {{-- <div class="row m-0">
        <div class="card btn-square box mt-3 col-md-6">
            <section class="card-body mx-auto">
                <h4>
                    Jumlah Mitra Perusahaan =
                    <b>{{ count($perusahaan) }}</b>
                </h4>
            </section>
        </div>
    </div> --}}
    <div class="card box btn-square mt-3">
        <section class="card-body" id="bawahSlide">
            @foreach($perusahaanAll as $p)
                <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-custom border imgZoom">
            @endforeach
        </section>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#mitra').addClass('active');
    $('#bawahSlide').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 845,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
@endsection
