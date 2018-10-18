<div class="row">
    @include('layouts.adminmenu')
    <section class="col-md-9" id="dashboard">
        <div class="card box btn-square">
            <div class="card-header h3 text-center">Dashboard</div>
            <div class="card-body">
                <h1 class="text-center">Selamat Datang di BKK-SMK.</h1>
            </div>
        </div>
    </section>
</div>
@section('js')
<script type="text/javascript">
    $('.adminmenu_beranda').addClass('active');
</script>
@endsection
{{-- <div class="card box btn-square">
    <div class="card-header h3 text-center">Dashboard</div>

    <div class="card-body">
        <a href="{{ url('admin/loker/add') }}" class="btn btn-primary">Buat Lowongan Kerja</a>
        <a href="{{ url('admin/perusahaan') }}" class="btn btn-primary">Daftar Perusahaan</a>
        <a href="{{ url('admin/cp') }}" class="btn btn-primary">Daftar Calon Pegawai</a>
    </div>
</div> --}}

{{-- <div class="card mt-3 box btn-square">
    <div class="card-header h3 text-center">Daftar Loker</div>

    <div class="card-body pb-0">
        @foreach($loker as $l)
            <div class="relative row">
                <div class="close-btn bisaHover">
                    <span href="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" class="deleteButton"><i class="text-danger">&times</i></span>
                </div>
                <div class="col-md-3">
                    <a @if($l->brosur !== 'nophoto.jpg') href="{{ url('storage/brosur/'.$l->brosur) }}" @else href="{{ url('assets/images/nophoto.jpg') }}" @endif>
                        <img @if($l->brosur === 'nophoto.jpg') src="{{ 'assets/images/nophoto.jpg' }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$l->brosur) }}" alt="{{ $l->judul }}" @endif width="220px">
                    </a>
                </div>
                <div class="col-md-9">
                    <a class="text-center" href="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}">
                        <h1> {{ $l->judul }} </h1>
                    </a>
                    @if(isset($l->id_perusahaan))
                        <p> Nama Perusahaan : {{ $l->perusahaan->nama }} </p>
                    @else
                        <p> Nama Perusahaan : Admin </p>
                    @endif
                    <ul>
                        <li><span class="h4">Persyaratan</span> <br>{!! $l->persyaratan !!}</li>
                        <li><span class="h4">Gaji</span> <br>{!! $l->gaji !!}</li>
                        <li><span class="h4">Jam Kerja</span> <br>{!! $l->jam_kerja !!}</li>
                        <li><span class="h4">Keterangan</span> <br>{!! $l->keterangan_loker !!}</li>
                    </ul>
                    <a href="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}"> Jumlah Pelamar : {{ count($l->lamaran) }} </a>
                </div>
            </div>
            <hr>
        @endforeach
        {{ $loker->links() }}
    </div>
</div> --}}
