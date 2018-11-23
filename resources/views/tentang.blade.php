@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card box btn-square">
        <div class="card-header text-center h3">Tentang</div>
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
