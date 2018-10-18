@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img id="fotoProfil" class="img-fluid box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
            {{-- <div class="menu mt-3 mb-3 box p-3">
                <div class="menuTitle text-center h4">Menu</div>
                <hr>
                <a class="text-white btn btn-primary btn-block" id="btnProfil">Profil</a>
                <a class="text-white btn btn-primary btn-block" id="btnLoker">Daftar Loker</a>
            </div> --}}
        </div>
        <div class="col-md-9">
            <div class="card box btn-square" id="profil">
                <div class="card-header text-center h3">Profil</div>
                <div class="card-body">
                    <h1 class="text-center"></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-center">{{ $perusahaan->nama }}</h1>
                            <hr />
                            <h4 class='text-center'>Bio</h4>
                            <p>{!! $perusahaan->bio !!}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Alamat</h4>
                            <p>{!! $perusahaan->alamat !!}</p>
                            <h4>Kontak</h4>
                            <p>{{ $perusahaan->kontak->no_hp }},
                            {{ $perusahaan->kontak->no_telepon }}</p>
                            <p>
                                ID Line : {{ $perusahaan->kontak->id_line }}<br>
                                {!! $perusahaan->kontak->kontak_dll !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card box btn-square mt-2" id="loker">
                <div class="card-header text-center h3">Daftar Loker</div>
                <div class="card-body row justify-content-center">
                    @foreach($belumDiLamar as $l)
                        <div class="col-md-3 mb-3 brosur">
                            <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid imgZoom">
                        </div>
                        <div class="col-md-9">
                            <h1 class="judulLoker">{{$l->judul}}</h1>
                            <span class="text-muted small">Dipost pada: {{$l->created_at}} | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif </span>
                            <h4 class="mt-2"> Persyaratan </h4>
                            {!! $l->persyaratan !!}
                            <h4> Gaji </h4>
                            <p>{{ $l->gaji }}</p>
                            <h4> Jam Kerja </h4>
                            <p>{{ $l->jam_kerja }}</p>
                            @if($cp->cv)
                                @if($l->status === 'Aktif')
                                    <a href="{{ url('cp/lamaran', base64_encode($l->id_loker)) }}" class="btn btn-primary btn-block">Lamar pekerjaan ini</a>
                                @else
                                    <p class="text-danger text-center">Lowongan pekerjaan sudah tidak aktif.</p>
                                @endif
                            @else
                                <p> Anda belum menambahkan cv ke profil anda. Silahkan <a href="#">klik disini</a> untuk mengubahnya. </p>
                            @endif
                            <hr />
                        </div>
                    @endforeach
                    @foreach($sudahDiLamar as $l)
                        <div class="col-md-3 brosur">
                            <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid imgZoom">
                        </div>

                        <div class="col-md-8">
                            <h1 class="judulLoker"> {{ $l->judul }} </h1>
                            <span class="text-muted small">Dipost pada: {{$l->created_at}} | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif </span>
                            <h4 class="mt-2">Persyaratan</h4>
                            {!! $l->persyaratan !!}
                            <h4>Gaji</h4>
                            {!! $l->gaji !!}
                            <h4>Jam Kerja</h4>
                            {!! $l->jam_kerja !!}
                            <h4>Keterangan</h4>
                            {!! $l->keterangan_loker !!}
                            @foreach($l->lamaran as $la)
                                @if($la->nis == $cp->nis)
                                    <p class="text-center"> Anda sudah melamar kesini dengan status <span class="">'{{ $la->status }}'</span></p>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                    @endforeach
                    {{ $loker->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    let profilToggle = true;let lokerToggle = false;
    $('#btnProfil').on('click', () => {
        if(!profilToggle && lokerToggle){
            $('#profil').slideToggle(500);
            $('#loker').slideToggle(500);
            profilToggle = true;lokerToggle = false;
        }
    });

    $('#btnLoker').on('click', () => {
        if(!lokerToggle && profilToggle){
            $('#loker').slideToggle(500);
            $('#profil').slideToggle(500);
            lokerToggle = true;profilToggle = false;
        }
    });
</script>
@endsection
