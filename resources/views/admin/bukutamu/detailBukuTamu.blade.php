@extends('layouts.app')

@section('title')
    Detail Buku Tamu -
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.adminmenu')
        <section class="col-md-9" id="detailBukuTamu">
            <div class="card btn-square box">
                <div class="card-header h3 text-center">
                    <a href="{{ url('admin/bukutamu') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Isi Pesan
                </div>
                <div class="card-body">
                    <h4>{{$bukutamu->nama_pengirim}} <span class="text-muted small">({{$bukutamu->email_pengirim}})</span></h4>
                    <h5 class="text-muted small">dari {{$bukutamu->asal_pengirim}} pada {{$bukutamu->created_at}}</h5>
                    <hr>
                    {!! $bukutamu->isi_pesan !!}
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.adminmenu_bukutamu').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
