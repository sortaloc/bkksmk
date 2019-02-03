@extends('layouts.app')

@section('title')
    Tentang -
@endsection

@section('css')
<style>
    #fitur, #tentang {
        animation: fadeInFromUp 1s forwards 0s ease;
    }

</style>
@endsection

@section('content')
<div class="container">
    <section id="fitur" class="text-center p-3">
        <h1>Features</h1>
        <div class="row justify-content-center m-0">
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-briefcase h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur1 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-user-check h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur2 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-search h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur3 }}</p>
            </div>
        </div>
    </section>

    <div id="tentang" class="card box btn-square">
        <div class="card-header text-center h1">Tentang</div>
        <div class="card-body">
            {!! $pengaturan->tentang1 !!}
            <hr>
            <h2>Tujuan</h2>
            {!! $pengaturan->tujuan1 !!}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#tentang').addClass('active');
</script>
@endsection
