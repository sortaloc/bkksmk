@extends('layouts.app')

@section('css')
<style>
    .profilPelamar {
        max-height: 220px;
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
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header text-center h3" id="pelamarJudul">
                    <a href="{{ url('/') }}" class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                    Daftar Pelamar Loker | {{ $loker->judul }}
                </div>
                <div class="card-body">
                    <div class="row">
                    @foreach($loker->lamaran as $index => $l)
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
                                    <a href="{{ url('perusahaan/loker/verif_pelamar', base64_encode($l->id_lamaran)) }}" class="btn btn-success btn-square" id="terima">Terima</a>
                                    <a href="{{ url('perusahaan/loker/tolak_pelamar', base64_encode($l->id_lamaran)) }}" class="btn btn-danger btn-square" id="tolak">Tolak</a>
                                @endif
                            </div>
                            <hr>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">


    $('.cvButton').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#cv_'+$index).slideToggle(250);
    });

    $('.slButton').on('click', function(){
        let $index = $(this).attr('data-toggle');
        $('#sl_'+$index).slideToggle(250);
    });
</script>
@endsection
