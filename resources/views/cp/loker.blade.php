@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modal.css') }}">
@endsection

@section('content')
<div class="container">
    <section class="modal" id="modalLoker">
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
        <section class="col-lg-9" id="dashboard">
            <div class="card box btn-square mb-3">
                <div class="card-header text-center h3">Filters</div>

                <div class="card-body" id="filters">
                    <form action="{{ url('cp/loker') }}" method="GET">
                        <select name="bp" id="bp" class="form-control mb-2" style="width: 100%">
                            <option value="">Semua bidang pekerjaan</option>
                            @foreach ($bidangPekerjaan as $bp)
                                <option value="{{ $bp->bidang_pekerjaan }}" @if($request->input('bp') == $bp->bidang_pekerjaan) selected @endif>{{ $bp->bidang_pekerjaan }}</option>
                            @endforeach
                        </select>

                        <select name="gaji" id="gaji" class="form-control mb-2" style="width: 100%">
                            <option value="">Semua rentang gaji</option>
                            @foreach ($gaji as $g)
                                <option value="{{ $g->gaji }}" @if($request->input('gaji') == $g->gaji) selected @endif>{{ $g->gaji }}</option>
                            @endforeach
                        </select>

                        <select name="np" id="np" class="form-control mb-2" style="width: 100%">
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

            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Loker</div>

                <div class="card-body">
                    @if(!$cp->cv)
                        <p class="text-center"> Anda belum menambahkan cv ke profil anda. Silahkan <a href="{{ url('cp/settings/datadiri') }}" class="a-normal">klik disini</a> untuk mengubahnya. </p>
                    @else
                        <section id="daftarLoker" class="daftarItem">
                            @foreach($loker as $l)
                                @if($l->status === 'Aktif')
                                    <div class="box item loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-lamar="{{ url('cp/lamaran', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}" data-statusLamaran="{{ $l->lamaran }}" data-status="belum">
                                        <img
                                            @if($l->brosur === 'nophoto.jpg')
                                                @if($l->perusahaan)
                                                    src="{{ asset('storage/fotoPerusahaan/'.$l->perusahaan->foto) }}"
                                                    alt="{{ $l->perusahaan->nama }}"
                                                @else
                                                    src="{{ asset('assets/images/nophoto.jpg') }}"
                                                    alt="nophoto"
                                                @endif
                                            @else
                                                src="{{ asset('storage/brosur/'.$l->brosur) }}"
                                                alt="{{ $l->judul }}"
                                            @endif
                                            class="img-fluid"
                                        >
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
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
