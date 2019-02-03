@extends('layouts.app')

@section('css')
<style>
    #daftarLoker, #daftarMitra, #berita {
        animation: fadeInFromUp 1s forwards 0s ease;
    }

    select.form-control {
        margin-bottom: 8px;
    }
    select.form-control:nth-last-child(){
        margin-bottom: 0;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-daftarBerita.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-lp.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modal.css') }}">
@endsection

@section('lp')
<main class="bg-1">
    <section id="modalLoker" class="modal">
        <span class="close">&times;</span>
        <div class="row justify-content-center" id="contentModal">
            <div class="col-3" id="fotoModalContainer">
                <img id="fotoModal" class="img-fluid"><br />
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

    <section id="gambar-lp" class="position-relative mb-3">
        <img @if($pengaturan->foto1 !== 'nophoto.jpg') src="{{ asset('storage/banner/'.$pengaturan->foto1) }}" alt="{{ $pengaturan->foto1 }}" @else src="{{ asset('assets/images/unsplash1.jpg') }}" alt="banner1" @endif class="img-hero-full">
        <div id="lpContentContainer">
            <i class="fas fa-arrow-left h2 leftArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}" data-arah="left"></i>
            <div class="hero-text slide" id="slide_0">
                {!! $pengaturan->banner1 !!}
            </div>
            @foreach($kegiatan as $index => $k)
                <div class="hero-text slide" id="slide_{{ $index + 1 }}">
                    <div class="isiContainer">
                        <img @if($k->foto_kegiatan === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoKegiatan/'.$k->foto_kegiatan) }}" alt="{{ $k->judul_kegiatan }}" @endif class="img-fluid imgZoom imgKegiatan">
                        <div class="textKegiatan">
                            <h4>{{ $k->judul_kegiatan }}</h4>
                            <small>{{ $k->created_at }}</small><br />
                            {!! $k->deskripsi_kegiatan !!}
                        </div>
                    </div>
                </div>
            @endforeach
            <i class="fas fa-arrow-right h2 rightArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}" data-arah="right"></i>
        </div>
    </section>

    @if(count($berita) > 0)
        @include('daftarBerita')
        <div class="my-3 text-center">
            <a href="{{ url('berita') }}" class="btn btn-primary btn-square">Lihat Semua Berita</a>
        </div>
    @else
        <section id="berita" class="col-md-10 offset-md-1 my-3">
            <h1 style="border-bottom: 3px solid grey;width: fit-content;">Daftar Berita</h1>
            <p class="text-center">Maaf, saat ini belum ada berita.</p>
        </section>
    @endif

    @include('daftarLoker')

    <section id="chart" class="my-3 col-md-10 offset-md-1">
        <div class="row">
            <div class="col-lg-6">
                <div class="card box btn-square">
                    <div class="card-header h3 text-center">Status Alumni</div>
                    <div class="card-body">
                        <canvas id="chartKegiatan" class="responsiveChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card box btn-square">
                    <div class="card-header h3 text-center">Chart Bidang Pekerjaan/Kuliah</div>
                    <div class="card-body">
                        <canvas id="chartBidang" class="responsiveChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('daftarMitra')
</main>
@endsection

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
@include('layouts.modalGambar')
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script type="text/javascript">
    document.getElementById('mainapp').remove();
    $('#beranda').addClass('active');

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

    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    let $colors = [];

    for(var i in {!! json_encode($jumlahBidang) !!}){
        $colors.push(dynamicColors());
    };

    let $chartBidang = new Chart(document.getElementById('chartBidang'), {
        type: 'pie',
        data: {
            datasets: [{
                data: {!! json_encode($jumlahBidang) !!},
                backgroundColor: $colors
            }],
            labels: {!! json_encode($labelBidang) !!}
        },
        options: {}
    })

    let $ctxKegiatan = document.getElementById('chartKegiatan');
    let $dataKegiatan = {
        datasets: [{
            data: {!! json_encode($dataKegiatanAlumni) !!},
            backgroundColor: ['green', 'blue', 'red', 'gray']
        }],
        labels: [
            'Bekerja', 'Kuliah', 'Belum Bekerja/Kuliah', 'Lain-lain'
        ],
    }
    let $optionsKegiatan = {}
    let $chartKegiatan = new Chart($ctxKegiatan, {
        type: 'pie',
        data: $dataKegiatan,
        options: $optionsKegiatan
    });
</script>
<script type="text/javascript" src="{{ asset('js/bkk-lpSlider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
