@extends('layouts.app')

@section('title')
    Daftar Mitra -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bkk-mitra.css') }}">
@endsection

@section('content')
<section id="content" class="container">
    <div class="card box btn-square">
        <div class="card-header text-center h3">Daftar Mitra Perusahaan</div>
        <div class="card-body">
            @if(count($perusahaan) < 1)
                <h1 class="text-center">Sekolah ini belum mempunyai mitra perusahaan.</h1>
            @else
                <div id="mitraContainer">
                @foreach($perusahaan as $p)
                    <div class="mitra row littleBox">
                        <div class="col-lg-3">
                            <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-fluid-custom img-thumbnail imgZoom img-center">
                        </div>
                        <div class="col-lg-8 ml-2">
                            <p class="text-center">
                                <strong>
                                    {{ $p->nama }}
                                </strong>
                                <br />
                                {!! str_limit($p->bio, 56) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
                </div>
                <div>{{ $perusahaan->links() }}</div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('js')
@include('layouts.modalGambar')
<script type="text/javascript">
    $('#mitra').addClass('active');
</script>
@endsection
