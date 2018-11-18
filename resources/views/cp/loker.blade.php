@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modalLoker.css') }}">
@endsection

@section('content')
<div class="container">
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
                        <p class="text-center" id="statusSudahModal"> Anda sudah melamar kesini dengan status <span id="statusLamaranModal"></span></p>
                        <div class="btn-group" id="statusModal">
                            <a class="btn btn-primary text-light buttonLamar"><i class="fas fa-briefcase"></i></a>
                            <a class="btn btn-primary text-left text-light buttonLamar">Lamar</a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-primary text-light"><span id="jumlahPelamar"></span></a>
                            <a class="btn btn-primary text-left text-light">Daftar Pelamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        @include('layouts.cpmenu')
        <section class="col-md-9" id="dashboard">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Loker</div>

                <div class="card-body pb-0">
                    @if(!$cp->cv)
                        <p class="text-center"> Anda belum menambahkan cv ke profil anda. Silahkan <a href="{{ url('cp/settings/datadiri') }}" class="a-normal">klik disini</a> untuk mengubahnya. </p>
                    @else
                        <section id="daftarLoker" class="m-3">
                            @foreach($loker as $l)
                                @if($l->status === 'Aktif')
                                    <div class="box loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-lamar="{{ url('cp/lamaran', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}" data-statusLamaran="{{ $l->lamaran }}" data-status="belum">
                                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid" style="height:200px">
                                        <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                                        {{-- <p class="text-center m-0"><small>{!! str_limit($l->judul, 40)  !!}</small></p> --}}
                                    </div>
                                @endif
                            @endforeach

                            {{-- @foreach($sudahDiLamar as $l)
                                <div class="box loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-jumlahPelamar="{{ count($l->lamaran) }}" data-statusLamaran="{{ $l->lamaran }}" data-status="sudah">
                                    <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid">
                                    <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                                </div>
                                <hr>
                            @endforeach --}}
                        </section>
                        {{ $loker->links() }}
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $('.cpmenu_loker').addClass('active');

    $('.loker').on('click', function(){
        $('.buttonLamar').attr('href', $(this).attr('data-lamar'));

        if($(this).attr('data-status') == 'sudah'){
            $data = JSON.parse(JSON.stringify(eval("(" + $(this).attr('data-formodal') + ")")));
            $statusLamaran = JSON.parse(JSON.stringify(eval("(" + $(this).attr('data-statusLamaran') + ")")));
            for(let i = 0; i < $statusLamaran.length; i++){
                if($statusLamaran[i].id_loker == $data.id_loker){
                    $('#statusLamaranModal').html("'" + $statusLamaran[i].status + "'");
                }
            }

            $('#statusModal').addClass('d-none');
            $('#statusSudahModal').removeClass('d-none');
        }else if($(this).attr('data-status') == 'belum'){
            $('#statusSudahModal').addClass('d-none');
            $('#statusModal').removeClass('d-none');
        }
    });
</script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection

{{-- @foreach($l->lamaran as $la)
    @if($la->nis == $cp->nis)
        <p class="text-center"> Anda sudah melamar kesini dengan status <span class="">'{{ $la->status }}'</span></p>
    @endif
@endforeach --}}
