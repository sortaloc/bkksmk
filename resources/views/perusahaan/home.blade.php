@section('css')
<style>
    .btn-desc{
        overflow: hidden !important;
    }
</style>
@endsection
<div class="row">
    <div class="col-md-3">
        <img id="fotoProfil" class="img-fluid box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
        <div class="menu mt-3 mb-3 box p-3">
            <div class="menuTitle text-center h4">Main Menu</div>
            <hr>
            <div class="btn-group btn-block">
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary btn-square" ><i class="fas fa-plus"></i></a>
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary text-left btn-block btn-square btn-desc">Buat Loker</a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card box btn-square">
            <div class="card-header text-center h3">Daftar Loker Saya</div>

            <div class="card-body row justify-content-center">
                @foreach($loker as $l)
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
