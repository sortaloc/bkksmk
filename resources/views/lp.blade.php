@extends('layouts.app')

@section('css')
<style>
    /* Section 1 - Gambar LP */
    .img-hero {
        width: 100%;
        height: 91.3vh;
    }
    .img-hero-full {
        width: 100%;
        height: 100vh;
    }
    .hero-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #444;
        background-color: rgba(235, 235, 235, 0.6);
        padding: 10px;
        width: 75%;
        height: auto;
        max-height: 50%;
        overflow-y: hidden;
    }
    .hero-text h1{
        font-size: 8vw;
    }
    .hero-text p {
        font-size: 2vw;
    }
    .responsiveArrow {
        font-size: 3vw;
    }

    /* Daftar Mitra Slide */
    .img-custom {
        width: 100%;
        max-height: 200px;
        margin: 0 1em;
    }
    .slick-arrow:hover {
        cursor: pointer;
        color: #aaa;
        transition: 0.5s ease-in-out;
        z-index: 2;
    }
    .prevArrow {
        position: absolute;
        top: 0;
        left: -2%;
        transform: translate(50%, 50%);
    }
    .nextArrow {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(50%, 50%);
    }

    /* Kegiatan Slider */
    .slide {
        display: none;
    }
    .isiContainer{
        display: grid;
        grid-template-columns: 25% 70%;
        grid-gap: 1em;
    }
    .leftArrow, .rightArrow {
        position: absolute;
        z-index: 9999;
        transform: translate(-50%, -50%);
        background-color: #ddd;
        border-radius: 4em;
        padding: 5px;
    }
    .leftArrow:hover, .rightArrow:hover {
        cursor: pointer;
        opacity: 0.7;
    }
    .leftArrow {
        top: 50%;
        left: 11.75%;
    }
    .rightArrow {
        top: 50%;
        right: 8.25%;
    }

    @media only screen and (min-width: 401px) and (max-width: 768px) {
        /* Kegiatan Slider */
        .isiContainer {
            grid-template-columns: auto;
            grid-template-rows: auto auto;
        }
        .isiContainer img {
            width: 50%;
            justify-self: center;
        }
    }

    @media only screen and (max-width: 400px) {
        /* Section 1 - Gambar LP */
        .img-hero {
            height: auto;
        }
        .img-hero-full {
            height: 40vh;
        }

        /* Kegiatan Slider */
        .textKegiatan {
            display: none;
        }
        .isiContainer {
            grid-template-columns: auto;
        }
        .isiContainer img {
            height: 75%;
            justify-self: center;
        }
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modalLoker.css') }}">
@endsection

@section('lp')
<main class="bg-1">
    <section class="modal" id="modalLoker">
        <span class="close">&times;</span>
        <div class="row justify-content-center">
            <div class="col-3" id="brosurModalContainer">
                <img id="brosurModal" class="img-fluid">
                <small class="text-light">Klik gambar untuk memperbesar / memperkecil gambar!</small>
            </div>
            <div class="col-5" id="dataModalContainer">
                <div class="card box btn-square">
                    <div class="card-header text-center h3" id="judulModal"></div>
                    <div class="card-body">
                        Sebagai <span id="bidangModal"></span><br />
                        <span class="text-muted small" id="postModal">Dipost oleh: <span id="siapaModal"></span> pada <span id="waktuModal"></span> | <span id="keaktifanModal"></span></span>
                        <h4 class="mt-2"> Persyaratan </h4>
                        <span id="persyaratanModal"></span>
                        <h4> Gaji </h4>
                        <p id="gajiModal"></p>
                        <h4> Jam Kerja </h4>
                        <p id="jamKerjaModal"></p>
                        <h4> Keterangan Lainnya </h4>
                        <p id="keteranganModal"></p>
                        <h4> Jadwal Tes </h4>
                        <p id="jadwalModal"></p>
                        <div class="btn-group">
                            <a class="btn btn-primary text-light"><span id="jumlahPelamar"></span></a>
                            <a class="btn btn-primary text-left text-light">Daftar Pelamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gambar-lp" class="position-relative">
        <img @if($pengaturan->foto1 !== 'nophoto.jpg') src="{{ asset('storage/banner/'.$pengaturan->foto1) }}" alt="{{ $pengaturan->foto1 }}" @else src="{{ asset('assets/images/unsplash1.jpg') }}" alt="banner1" @endif class="img-hero-full">
        <div id="lpContentContainer">
            <i class="fas fa-arrow-left h2 leftArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}"></i>
            <div class="hero-text slide" id="slide_0">
                {!! $pengaturan->banner1 !!}
            </div>
            @foreach($kegiatan as $index => $k)
                <div class="hero-text slide" id="slide_{{ $index + 1 }}">
                    <div class="isiContainer">
                        <img @if($k->foto_kegiatan === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoKegiatan/'.$k->foto_kegiatan) }}" alt="{{ $k->judul_kegiatan }}" @endif class="img-fluid imgZoom">
                        <div class="textKegiatan">
                            <h4>{{ $k->judul_kegiatan }}</h4>
                            <small>{{ $k->created_at }}</small><br />
                            {!! $k->deskripsi_kegiatan !!}
                        </div>
                    </div>
                </div>
            @endforeach
            <i class="fas fa-arrow-right h2 rightArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}"></i>
        </div>
    </section>

    <section id="fitur" class="text-center p-3">
        <h1>Features</h1>
        <div class="row justify-content-center m-0">
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-briefcase h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur1 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-user-check h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur2 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-search h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur3 }}</p>
            </div>
        </div>
    </section>

    <section id="daftar-loker" class="col-md-10 offset-md-1">
        <div class="card box btn-square">
            <div class="card-header text-center h3">Daftar Loker</div>

            <div class="card-body justify-content-center" id="daftarLoker">
                @foreach($loker as $l)
                <div class="box loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
                    <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid">
                    <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                </div>
                @endforeach
            </div>
            {{ $loker->links() }}
        </div>
    </section>

    <section id="daftarMitra" class="col-md-10 offset-md-1">
        @if(count($perusahaanAll) > 0)
        <div class="card box btn-square mt-3">
            <div class="card-body" id="daftarMitraSlide">
                @foreach($perusahaanAll as $p)
                    <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-custom border imgZoom">
                @endforeach
            </div>
        </div>
        @endif
    </section>

    <section id="footer" class="bg-2 p-3 mt-3">
        <div class="row m-0 p-0">
            <div class="col-md-4 text-center">
                <h4>Lokasi</h4>
                <hr>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.002612100019!2d107.55619391442444!3d-6.8902891950211185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK+11+Bandung!5e0!3m2!1sen!2sid!4v1517989587366" frameborder="0" class="box" style="width:100%"></iframe>
            </div>
            <div class="col-md-4">
                <h4 class="text-center">Kontak</h4>
                <hr>
                <p>{{ $pengaturan->alamat }}</p>
                <p>
                    <b>Telp</b> : {{ $pengaturan->telp }}<br>
                    <b>Fax</b> : {{ $pengaturan->fax }}<br>
                    <b>E-Mail</b> : {{ $pengaturan->email }}
                </p>
            </div>
            <div class="col-md-4">
                <h4 class="text-center">Link</h4>
                <hr>
                <a class="text-white" href="http://www.smkn11bdg.sch.id/"><img class="img-fluid" src="{{ asset('assets/images/smk11.png') }}" alt="Website SMKN 11 Bandung"/></a>
            </div>
        </div>
        <p class="text-center m-0"><i class="small">©Copyright 2018. Yanuar Wanda Putra</i></p>
    </section>
</main>
@endsection

@section('js')
<script type="text/javascript">
    document.getElementById('mainapp').remove();
    $('#beranda').addClass('active');

    let $slideActive = 0;
    let $leftArrow = $('.leftArrow');
    let $rightArrow = $('.rightArrow');

    $(document).ready(function(){
        $('#slide_' + $slideActive).fadeIn(0);
    });

    $leftArrow.on('click', function(){
        console.log('slideActive sebelum diklik : ' + $slideActive);
        $('#slide_' + $slideActive).fadeOut(500);
        if($slideActive === 0){
            $slideActive = $(this).attr('data-jumlahKegiatan');
            $('#slide_' + $slideActive).fadeIn(500);
        }else{
            $slideActive--;
            $('#slide_' + $slideActive).fadeIn(500);
        }
        console.log('Setelah nge-klik leftArrow : ' + $slideActive);
    });

    $rightArrow.on('click', function(){
        console.log('slideActive sebelum diklik : ' + $slideActive);
        console.log('jumlah kegiatan : ' + $(this).attr('data-jumlahKegiatan'))
        $('#slide_' + $slideActive).fadeOut(500);
        if($slideActive == $(this).attr('data-jumlahKegiatan')){
            $slideActive = 0;
            $('#slide_' + $slideActive).fadeIn(500);
        }else{
            $slideActive++;
            $('#slide_' + $slideActive).fadeIn(500);
        }
        console.log('Setelah nge-klik rightArrow : ' + $slideActive);
    });

    $('#daftarMitraSlide').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-caret-left display-3 prevArrow"></i>',
        nextArrow: '<i class="fas fa-caret-right display-3 nextArrow"></i>',
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
@include('layouts.modalGambar');
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
