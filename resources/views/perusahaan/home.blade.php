@section('css')
<style>
    .btn-desc{
        overflow: hidden !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modalLoker.css') }}">
@endsection
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
                        <a class="btn btn-primary buttonEdit"><i class="far fa-edit"></i></a>
                        <a class="btn btn-primary text-left buttonEdit">Edit</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-danger deleteButton buttonDelete"><i class="fas fa-trash"></i></a>
                        <a class="btn btn-danger deleteButton text-left buttonDelete">Hapus</a>
                    </div>
                    <div class="btn-group float-right">
                        <a class="btn btn-primary buttonPelamar"><span id="jumlahPelamar"></span></a>
                        <a class="btn btn-primary text-left buttonPelamar">Daftar Pelamar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-3">
        <img id="fotoProfil" class="img-fluid box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
        <section class="menu mt-3 mb-3 box p-3" id="menu">
            <div class="menuTitle text-center h4">Main Menu</div>
            <hr>
            <div class="btn-group btn-block">
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary btn-square" ><i class="fas fa-plus"></i></a>
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary text-left btn-block btn-square btn-desc">Buat Loker</a>
            </div>
        </section>
    </div>
    <div class="col-md-9">
        <div class="card box btn-square">
            <div class="card-header text-center h3">Daftar Loker Saya</div>

            <div class="card-body row justify-content-center" id="daftarLoker">
                {{-- @foreach($loker as $l)
                    <div class="col-md-3 mb-3 brosur">
                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid imgZoom">
                    </div>
                    <div class="col-md-9">
                        <h1 class="judulLoker"><a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}">{{$l->judul}}</a></h1>
                        <span class="text-muted small">Dipost pada: {{$l->created_at}} | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif </span>
                        <h4 class="mt-2"> Persyaratan </h4>
                        {!! $l->persyaratan !!}
                        <h4> Gaji </h4>
                        <p>{{ $l->gaji }}</p>
                        <h4> Jam Kerja </h4>
                        <p>{{ $l->jam_kerja }}</p>
                        <a href="{{ url('perusahaan/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" class="jumlahPelamar btn-square badge badge-primary">{{ count($l->lamaran) }}</a>
                        <div class="btn-group">
                            <a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" class="btn btn-primary btn-square"><i class="fas fa-edit"></i></a>
                            <a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" class="btn btn-primary btn-square btn-desc text-left">Edit</a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" class="btn btn-danger deleteButton float-right btn-square deleteButton"><i class="fas fa-trash"></i></a>
                            <a href="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" class="btn btn-danger btn-square btn-desc text-left deleteButton">Hapus</a>
                        </div>
                        <hr />
                    </div>
                @endforeach --}}
                @foreach($loker as $l)
                <div class="box loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('perusahaan/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
                    <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="img-fluid">
                    <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                </div>
                @endforeach
                {{ $loker->links() }}
                {{-- <div class="row justify-content-center">
                    @foreach($loker as $l)
                        <a href="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" class="relative d-inline-block col-md-4 col-sm-5 mr-3 mb-3 p-0" id="boxLoker">
                            <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box brosur">
                            <span href="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" class="close-btn deleteButton bisaHover"><i class="fas fa-times text-danger"></i></span>
                            <span href="{{ url('perusahaan/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" class="jumlahPelamar btn-square badge badge-primary">{{ count($l->lamaran) }}</span>
                            <div class="judulBrosur"><span>{{ $l->judul }}</span></div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $loker->links()  }}
                </div> --}}
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
@endsection
