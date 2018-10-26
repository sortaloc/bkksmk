@extends('layouts.app')

@section('css')
<style>
    #daftarMitraSlide {
        display: flex;
    }
    .slick-arrow:hover {
        cursor: pointer;
        color: #aaa;
        transition: 0.5s ease-in-out;
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
        #daftarMitraSlide {
            display: flex;
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
                    <div class="col-lg-3">
                        <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-fluid-custom img-thumbnail imgZoom img-center">
                    </div>
                    <div class="col-lg-8 ml-2">
                        <p class="text-center">
                            <strong>
                                {{ $p->nama }}
                            </strong>
                            <br />
                            {!! str_limit($p->bio, 56) !!}
                        </p>
                    </div>
                </div>
            @endforeach
            </div>
            <div>{{ $perusahaan->links() }}</div>
        </div>
    </div>
    @if(count($perusahaanAll) > 0)
    <div class="card box btn-square mt-3">
        <section class="card-body" id="daftarMitraSlide">
            @foreach($perusahaanAll as $p)
                <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-custom border imgZoom">
            @endforeach
        </section>
    </div>
    @endif
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#mitra').addClass('active');
</script>

@if(count($perusahaanAll) >=7)
<script type="text/javascript">
    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 my-auto"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 my-auto"></i>',
        responsive: [
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
@elseif((count($perusahaanAll) < 7) && (count($perusahaanAll) >= 5))
<script type="text/javascript">
    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 my-auto"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 my-auto"></i>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
@elseif((count($perusahaanAll) < 5) && (count($perusahaanAll) >= 3))
<script type="text/javascript">
    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 my-auto"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 my-auto"></i>',
        responsive: [
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
@elseif((count($perusahaanAll) < 3) && (count($perusahaanAll) > 1))
<script type="text/javascript">
    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 my-auto"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 my-auto"></i>',
        responsive: [
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
</script>
@else
<script type="text/javascript">
    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 my-auto"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 my-auto"></i>',
    });
</script>
@endif
@endsection
