@extends('layouts.app')

@section('css')
<style>
    #fitur, #daftarLoker, #daftarMitra {
        animation: fadeInFromUp 1s forwards 0s ease;
    }

    select.form-control {
        margin-bottom: 8px;
    }
    select.form-control:nth-last-child(){
        margin-bottom: 0;
    }
</style>
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

    <section id="gambar-lp" class="position-relative">
        <img @if($pengaturan->foto1 !== 'nophoto.jpg') src="{{ asset('storage/banner/'.$pengaturan->foto1) }}" alt="{{ $pengaturan->foto1 }}" @else src="{{ asset('assets/images/unsplash1.jpg') }}" alt="banner1" @endif class="img-hero-full">
        <div id="lpContentContainer">
            <i class="fas fa-arrow-left h2 leftArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}" data-arah="left"></i>
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
            <i class="fas fa-arrow-right h2 rightArrow responsiveArrow" data-jumlahKegiatan="{{ count($kegiatan) }}" data-arah="right"></i>
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

    <section id="daftarLoker" class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-lg-3">
                <div class="card box btn-square">
                    <div class="card-header text-center h3">Filter</div>

                    <div class="card-body">
                        <!-- Filters -->
                        <form action="{{ route('lp') }}" method="GET">
                            <select name="bp" id="bp" class="form-control" style="width: 100%">
                                <option value="">Semua bidang pekerjaan</option>
                                @foreach ($bidangPekerjaan as $bp)
                                    <option value="{{ $bp->bidang_pekerjaan }}" @if($request->input('bp') == $bp->bidang_pekerjaan) selected @endif>{{ $bp->bidang_pekerjaan }}</option>
                                @endforeach
                            </select>

                            <select name="gaji" id="gaji" class="form-control" style="width: 100%">
                                <option value="">Semua rentang gaji</option>
                                @foreach ($gaji as $g)
                                    <option value="{{ $g->gaji }}" @if($request->input('gaji') == $g->gaji) selected @endif>{{ $g->gaji }}</option>
                                @endforeach
                            </select>

                            <select name="np" id="np" class="form-control" style="width: 100%">
                                <option value="">Semua perusahaan</option>
                                @foreach ($perusahaanAll as $np)
                                    @if(count($np->loker) > 0)
                                        <option value="{{ $np->id_perusahaan }}" @if($request->input('np') == $np->id_perusahaan) selected @endif>{{ $np->nama }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <div class="btn-group btn-block">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                <button class="btn btn-primary btn-block text-left" type="submit">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card box btn-square">
                    <div class="card-header text-center h3">Daftar Loker</div>

                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-lg-9">
                                <select class="form-control" style="width: 100%">
                                    <option value="1">Urutkan berdasarkan tanggal dibuat</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select name="" id="" class="form-control">
                                    <option value="down">Descending</option>
                                    <option value="up">Ascending</option>
                                </select>
                            </div>
                        </div> --}}
                        @if(count($loker) < 1)
                            <p class="text-center">Maaf, saat ini belum ada loker.</p>
                        @else
                            <div class="daftarItem">
                                @foreach($loker as $l)
                                <div class="box item loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
                                    <img
                                        @if($l->brosur === 'nophoto.jpg')
                                            @if($l->perusahaan)
                                                @if($l->perusahaan->foto === 'nophoto.jpg')
                                                    src="{{ asset('assets/images/BKKSMK Logo.png') }}"
                                                    alt="bkksmk logo"
                                                @else
                                                    src="{{ asset('storage/fotoPerusahaan/'.$l->perusahaan->foto) }}"
                                                    alt="{{ $l->perusahaan->nama }}"
                                                @endif
                                            @else
                                                src="{{ asset('assets/images/BKKSMK Logo.png') }}"
                                                alt="bkksmk logo"
                                            @endif
                                        @else
                                            src="{{ asset('storage/brosur/'.$l->brosur) }}"
                                            alt="{{ $l->judul }}"
                                        @endif
                                        class="img-fluid"
                                    >
                                    <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    {{ $loker->links() }}
                </div>
            </div>
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
</main>
@endsection

@section('js')
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
</script>
<script type="text/javascript" src="{{ asset('js/bkk-lpSlider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
