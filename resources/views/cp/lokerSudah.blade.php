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
                        <div id="alasanContainer">
                            <h4> Alasan </h4>
                            <p id="alasanModal"></p>
                        </div>
                        <div class="btn-group text-light">
                            <a class="btn btn-primary buttonPelamar"><span id="jumlahPelamar"></span></a>
                            <a class="btn btn-primary text-left buttonPelamar">Daftar Pelamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        @include('layouts.cpmenu')
        <section class="col-md-9" id="dashboard">
            <div class="box btn-square mb-2 p-2" style="background-color: white">
                <span style="color: #0f0">Hijau</span> : Diterima | <span style="color: #f00">Merah</span> : Ditolak
            </div>

            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Lamaran Saya</div>

                <div class="card-body justify-content-center" id="daftarLoker">
                    @foreach ($loker as $index => $l)
                        <div class="box loker" data-formodal="{{ $l }}" @if($l->id_perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-jumlahPelamar="{{ count($l->lamaran) }}" data-lamaran="{{ $lamaran[$index] }}" @if($lamaran[$index]->status === 'diterima') style="background-color: #0F0" @elseif($lamaran[$index]->status === 'ditolak') style="background-color: red" @endif>
                            <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid">
                            <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                        </div>
                    @endforeach
                    {{ $loker->links() }}
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $('.cpmenu_loker_sudah').addClass('active');

    $('.loker').on('click', function(){
        let $lamaran = JSON.parse(JSON.stringify(eval("(" + $(this).attr('data-lamaran') + ")")));
        console.log($lamaran);
        if($lamaran.status === 'pending'){
            $('#alasanContainer').fadeOut();
        }else{
            $('#alasanContainer').fadeIn();
            if($lamaran.alasan == null){
                $('#alasanModal').html('Perusahaan / Admin tidak memberi alasan.');
            }else{
                $('#alasanModal').html($lamaran.alasan);
            }
        }
    });
</script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
