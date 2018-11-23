@section('css')
<style>
    @media only screen and (max-width: 992px) {
        #fotoProfil {
            display: none;
        }
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-modal.css') }}">
@endsection

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
    <div class="col-lg-3">
        <img id="fotoProfil" class="img-fluid box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
        <section class="card box btn-square mt-3 mb-3">
            <div class="card-header text-center h3">
                <span>Menu</span>
                <i class="fas fa-caret-up float-right bisaHover" id="menuButton"></i>
            </div>
            <div class="card-body" id="menuContent" data-toggle="show">
                <div class="btn-group btn-block">
                    <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary btn-square" ><i class="fas fa-plus"></i></a>
                    <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary text-left btn-block btn-square btn-desc">Buat Loker</a>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-9">
        <div class="card box btn-square mb-3">
            <div class="card-header text-center h3">Filters</div>

            <div class="card-body" id="filters">
                <form action="{{ url('/home') }}" method="GET">
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

                    <div class="btn-group btn-block">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        <button class="btn btn-primary btn-block text-left" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card box btn-square">
            <div class="card-header text-center h3">Daftar Loker Saya</div>

            <div class="card-body daftarItem" id="daftarLoker">
                @foreach($loker as $l)
                <div class="box item loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('perusahaan/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('perusahaan/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('perusahaan/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
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
                </div>
                @endforeach
                {{ $loker->links() }}
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{ asset('js/bkk-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-modalLoker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
