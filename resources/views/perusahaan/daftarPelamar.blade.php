@extends('layouts.app')

@section('css')
<style>
    .profilPelamar {
        max-height: 220px;
    }

    #daftarItem {
        display: flex;
        flex-basis: 20%;
        flex-wrap: wrap;
    }
    .box.item {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s ease-in-out;
        margin: 8px;
    }
    .box.item:hover {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
    .box.item img {
        max-height: 200px;
    }
    .box.item img:hover,
    #fotoModal:hover {
        opacity: 0.7;
        cursor: pointer;
    }

    .terimaDataToggle {
        border: 1px solid #0f0;
        padding: 1em;
    }
    .tolakDataToggle {
        border: 1px solid #f00;
        padding: 1em;
    }
    #dataModalContainer {
        max-width: 100% !important;
    }


    @media (max-width: 768px) and (min-width: 370px) {
        .profilPelamar {
            margin: 0 25%;
        }
    }

    @media (max-width: 768px) {
        #pelamarDesc,
        #pelamarShow {
            text-align: center;
        }
        .slButton {
            margin-top: 1em;
        }
        #tolak {
            float: right;
        }
        #pelamarJudul {
            font-size: 20px;
        }
    }

    @media (max-width: 520px) {
        #pelamarJudul {
            font-size: 16px;
        }
        #fotoModalContainer {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <section class="modal" id="modalDetail">
        <span class="close">&times;</span>
        <div class="row justify-content-center">
            <div class="col-3" id="fotoModalContainer">
                <img id="fotoModal" class="img-fluid"><br />
                <small class="text-light">Klik gambar untuk memperbesar / memperkecil gambar!</small>
            </div>
            <div class="col-5" id="dataModalContainer">
                <div class="card box btn-square">
                    <div class="card-header text-center h3" id="judulModal"></div>
                    <div class="card-body">
                        <span class="text-muted small" id="postModal">Dikirim pada: <span id="waktuModal"></span></span>
                        <div class="btn-group btn-block">
                            <a class="btn btn-primary text-light buttonDetailPelamar btn-square" target=""><i class="fas fa-info"></i></a>
                            <a class="btn btn-primary text-left text-light buttonDetailPelamar btn-square btn-block" target="_blank">Lihat Detail Pelamar</a>
                        </div>
                        <div class="mb-1 mt-1">
                            <div class="btn-group btn-block">
                                <a class="btn btn-primary text-light buttonShowCV btn-square"><i class="fas fa-user"></i></a>
                                <a class="btn btn-primary text-left text-light buttonShowCV btn-square btn-block">Lihat CV</a>
                                <a class="btn btn-primary text-light buttonShowCV btn-square"><i class="fas fa-caret-down"></i></a>
                            </div>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9 box cv" style="display:none">
                            <iframe class="embed-responsive-item"></iframe>
                        </div>
                        <div class="mb-1">
                            <div class="btn-group btn-block">
                                <a class="btn btn-primary text-light buttonShowSL btn-square"><i class="fas fa-envelope"></i></a>
                                <a class="btn btn-primary text-left text-light buttonShowSL btn-square btn-block">Lihat SL</a>
                                <a class="btn btn-primary text-light buttonShowSL btn-square"><i class="fas fa-caret-down"></i></a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 box sl" style="display:none">
                                <iframe class="embed-responsive-item"></iframe>
                            </div>
                        </div>
                        <div class="mb-1" id="terimaSection">
                            <div class="btn-group btn-block">
                                <a class="btn btn-success text-light buttonTerimaToggle btn-square"><i class="fas fa-check"></i></a>
                                <a class="btn btn-success text-left text-light buttonTerimaToggle btn-square btn-block">Terima Pelamar</a>
                                <a class="btn btn-success text-light buttonTerimaToggle btn-square"><i class="fas fa-caret-down"></i></a>
                            </div>
                            <div class="terimaDataToggle" style="display: none">
                                <h4 class="text-center">Alasan</h4>
                                <form action="" method="post">
                                    @csrf
                                    <textarea class="form-control" name="alasan" id="alasan" cols="30" rows="10"></textarea>
                                    <button class="btn btn-success btn-block btn-square buttonTerima" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div id="tolakSection">
                            <div class="btn-group btn-block">
                                <a class="btn btn-danger text-light buttonTolakToggle btn-square"><i class="fas fa-times"></i></a>
                                <a class="btn btn-danger text-left text-light buttonTolakToggle btn-square btn-block">Tolak Pelamar</a>
                                <a class="btn btn-danger text-light buttonTolakToggle btn-square"><i class="fas fa-caret-down"></i></a>
                            </div>
                            <div class="tolakDataToggle" style="display: none">
                                <h4 class="text-center">Alasan</h4>
                                <form action="" method="post">
                                    @csrf
                                    <textarea name="alasan" id="alasan" cols="30" rows="10" class="form-control"></textarea>
                                    <button class="btn btn-danger btn-block btn-square buttonTolak" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div id="wholeStatusModal">
                            <h4> Alasan </h4>
                            <p id="alasanModal"></p>
                            <p>Status: <span id="statusModal"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row justify-content-center">
        <div class="col-11">
            <div class="box btn-square mb-2 p-2" style="background-color: #fff">
                <span style="color: #0f0">Hijau</span> : Diterima | <span style="color: #f00">Merah</span> : Ditolak
            </div>
            <div class="box btn-square mb-2 p-2 text-center" style="background-color: #fff">
                {{ $loker->judul }}
            </div>
            <div class="card box btn-square">
                <div class="card-header text-center h3" id="pelamarJudul">
                    <a @if(Auth::user()->id_status === 2) href="{{ url('/') }}" @elseif(Auth::user()->id_status === 1) href="{{ url('/admin/loker') }}" @endif class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                    Daftar Pelamar Loker
                </div>
                <div class="card-body">
                    <div id="daftarItem">
                        @foreach($lamaran as $l)
                            <div class="box item"
                                data-nama="{{ $l->daftarcp->nama }}"
                                data-nis="{{ $l->daftarcp->nis }}"
                                @if(Auth::user()->id_status == '2')
                                    data-pelamar="{{ url('perusahaan/cp', base64_encode($l->daftarcp->nis)) }}"
                                    data-terima="{{ url('perusahaan/loker/verif_pelamar', base64_encode($l->id_lamaran)) }}"
                                    data-tolak="{{ url('perusahaan/loker/tolak_pelamar', base64_encode($l->id_lamaran)) }}"
                                @elseif(Auth::user()->id_status == '1')
                                    data-pelamar="{{ url('admin/cp/edit', base64_encode($l->daftarcp->nis)) }}"
                                    data-terima="{{ url('admin/loker/verif_pelamar', base64_encode($l->id_lamaran)) }}"
                                    data-tolak="{{ url('admin/loker/tolak_pelamar', base64_encode($l->id_lamaran)) }}"
                                @endif
                                data-cv="{{ $l->daftarcp->cv }}"
                                data-sl="{{ $l->surat_lamaran }}"
                                data-waktu="{{ $l->created_at }}"
                                data-status="{{ $l->status }}"
                                data-alasan="{{ $l->alasan }}"
                                style="background-color: @if($l->status === 'diterima') #0f0 @elseif($l->status === 'ditolak') #f33 @endif"
                            >
                                <img @if($l->daftarcp->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoCP/'.$l->daftarcp->foto) }}" alt="{{ $l->daftarcp->nama }}" @endif class="img-fluid">
                                <p class="text-center small m-0">{{ $l->daftarcp->nama }}</p>
                            </div>
                        @endforeach
                    </div>
                    {{ $lamaran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('.buttonShowCV').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#cv_'+$index).slideToggle(250);
    });

    $('.buttonShowSL').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#sl_'+$index).slideToggle(250);
    });

    $('.buttonTerimaToggle').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#terima_'+$index).slideToggle(250);
    })

    $('.buttonTolakToggle').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#tolak_'+$index).slideToggle(250);
    });

    $('.item').on('click', function(){
        let $nama = $(this).attr('data-nama');
        let $nis = $(this).attr('data-nis');
        let $status = $(this).attr('data-status');
        let $alasan = $(this).attr('data-alasan');
        let $waktu = $(this).attr('data-waktu');
        let $urlCP = $(this).attr('data-pelamar');
        let $urlTerima = $(this).attr('data-terima');
        let $urlTolak = $(this).attr('data-tolak');
        let $cv = $(this).attr('data-cv');
        let $sl = $(this).attr('data-sl');

        $('#fotoModal').attr('src', $(this).children('img').attr('src'));

        $('#waktuModal').html($waktu);
        $('#judulModal').html($nama);

        if($alasan.length > 0){
            $('#alasanModal').html($alasan);
        }else{
            $('#alasanModal').html("Anda tidak memberikan alasan.");
        }

        $('.buttonDetailPelamar').attr('href', $urlCP);
        $('.buttonTerima').attr('href', $urlTerima);
        $('.buttonTolak').attr('href', $urlTolak);

        $('.buttonShowCV').attr('data-toggle', $nis);
        $('.cv').attr('id', 'cv_' + $nis);
        $('.cv').children('iframe').attr('src', $cv);

        $('.buttonShowSL').attr('data-toggle', $nis);
        $('.sl').attr('id', 'sl_' + $nis);
        $('.sl').children('iframe').attr('src', $sl);

        $('.buttonTerimaToggle').attr('data-toggle', $nis);
        $('.terimaDataToggle').attr('id', 'terima_' + $nis);
        $('.terimaDataToggle').children('form').attr('action', $urlTerima);

        $('.buttonTolakToggle').attr('data-toggle', $nis);
        $('.tolakDataToggle').attr('id', 'tolak_' + $nis);
        $('.tolakDataToggle').children('form').attr('action', $urlTolak);

        if($status === 'diterima' || $status === 'ditolak'){
            $('#terimaSection').fadeOut();
            $('#tolakSection').fadeOut();
            $('#wholeStatusModal').fadeIn();
            $('#statusModal').html($status);
        }else{
            $('#wholeStatusModal').fadeOut();
            $('#terimaSection').fadeIn();
            $('#tolakSection').fadeIn();
        }

        $('body').addClass('modal-open');
        $('#modalDetail').fadeIn(500);
    });

    $('.close').on('click', function(){
        $('body').removeClass('modal-open');
        $('#modalDetail').fadeOut(500);
    });

    $('.buttonTerima').on('click', function(e){
        e.preventDefault();

        $('#modalDetail').attr('style', 'display: none');

        var $form = $(this).parent('form');
        swal({
            title: 'Terima calon pegawai ini?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terima',
        }).then($result => {
            $form.submit();
        });
    });

    $('.buttonTolak').on('click', function(e){
        e.preventDefault();

        $('#modalDetail').attr('style', 'display: none');

        var $form = $(this).parent('form');
        swal({
            title: 'Tolak calon pegawai ini?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tolak',
        }).then($result => {
            $form.submit();
        });
    });
</script>
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
@endsection

{{-- <div class="row">
@foreach($lamaran as $index => $l)
    <div class="col-md-3">
        <img @if($l->daftarcp->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoCP/'.$l->daftarcp->foto) }}" alt="{{ $l->daftarcp->nama }}" @endif class="box img-fluid">
        <p class="text-center">{{ $l->daftarcp->nama }}</p>
    </div>
    <div class="col-md-9">
        <div class="row" id="pelamarDesc">
            <div class="col-md-6">
                <h4>Alamat</h4>
                <p>{{ $l->daftarcp->alamat }}</p>
                <h4>No HP</h4>
                <p>{{ $l->daftarcp->kontak->no_hp }}</p>
            </div>
            <div class="col-md-6">
                <h4>Status</h4>
                <p>@if($l->status === 'diterima') <span class="text-success">{{ $l->status }}</span> @elseif($l->status === 'ditolak') <span class="text-danger">{{ $l->status }} @else {{ $l->status }} @endif</p>
                <h4>Keterangan</h4>
                <p>@if($l->keterangan_lamaran) {!! $l->keterangan_lamaran !!} @else Tidak ada keterangan. @endif</p>
            </div>
        </div>
        <div class="row" id="pelamarShow">
            <div class="col-md-6">
                <button class="btn btn-primary btn-square cvButton" data-toggle="{{ $index }}">Show CV</button>
                <div id="cv_{{$index}}" class="embed-responsive embed-responsive-16by9 box" style="display:none">
                    <iframe src="{{ $l->daftarCP->cv }}" class="embed-responsive-item"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-square slButton" data-toggle="{{ $index }}">Show SL</button>
                <div id="sl_{{$index}}" class="embed-responsive embed-responsive-16by9 box" style="display:none">
                    <iframe src="{{ $l->surat_lamaran }}" class="embed-responsive-item"></iframe>
                </div>
            </div>
        </div>
        <div class="mt-2">
            @if($l->status === 'pending')
                <a href="{{ url('perusahaan/loker/verif_pelamar', base64_encode($l->id_lamaran)) }}" class="btn btn-success btn-square terimaButton">Terima</a>
                <a href="{{ url('perusahaan/loker/tolak_pelamar', base64_encode($l->id_lamaran)) }}" class="btn btn-danger btn-square tolakButton">Tolak</a>
            @endif
        </div>
        <hr>
    </div>
@endforeach
</div> --}}
