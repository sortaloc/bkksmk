<div class="card box btn-square">
    <div class="card-header h3 text-center">Daftar Loker</div>

    <div class="card-body pb-0">
        @foreach($belumDiLamar as $l)
            @if($l->status === 'Aktif')
            <div class="relative row">
                <div class="col-md-3 brosur">
                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid">
                    </a>
                </div>

                <div class="col-md-9">
                    <h1 class="judulLoker"> {{ $l->judul }} </h1>
                    @if(isset($l->id_perusahaan))
                        <p class="text-muted small"> Dipost oleh : <a href="#">{{ $l->perusahaan->nama }}</a> | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif</p>
                    @else
                        <p class="text-muted small"> Dipost oleh : Admin | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif</p>
                    @endif
                    <h4>Persyaratan</h4>
                    {!! $l->persyaratan !!}
                    <h4>Gaji</h4>
                    {!! $l->gaji !!}
                    <h4>Jam Kerja</h4>
                    {!! $l->jam_kerja !!}
                    <h4>Keterangan</h4>
                    {!! $l->keterangan_loker !!}

                    @if($cp->cv)
                        <a href="{{ url('cp/lamaran', base64_encode($l->id_loker)) }}" class="btn btn-primary btn-block">Lamar pekerjaan ini</a>
                    @else
                        <p> Anda belum menambahkan cv ke profil anda. Silahkan <a href="#">klik disini</a> untuk mengubahnya. </p>
                    @endif
                </div>
            </div>
            <hr />
            @endif
        @endforeach

        @foreach($sudahDiLamar as $l)
            <div class="relative row">
                <div class="col-md-3 brosur">
                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                        <img @if($l->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif class="box img-fluid">
                    </a>
                </div>

                <div class="col-md-8">
                    <h1 class="judulLoker"> {{ $l->judul }} </h1>
                    @if(isset($l->id_perusahaan))
                        <p class="text-muted small"> Dipost oleh : <a href="{{ url('cp/perusahaan', base64_encode($l->id_perusahaan)) }}" class="a-normal">{{ $l->perusahaan->nama }}</a>  | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif</p>
                    @else
                        <p class="text-muted small"> Dipost oleh : Admin  | @if($l->status === 'Aktif') <span style="color:green">Aktif</span> @else <span style="color:red">Tidak Aktif</span> @endif</p>
                    @endif
                    <h4>Persyaratan</h4>
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
            </div>
            <hr>
        @endforeach
        {{ $loker->links() }}
    </div>
</div>
