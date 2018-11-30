@extends('layouts.app')

@section('title')
    {{ $cp->nama }} -
@endsection

@section('css')
<style>
    #profile {
        background-color: #eee;
    }
    .dataGrid {
        display: grid;
        grid-template-columns: repeat(2, 50%);
    }
    p {
        font-size: 12px;
    }
    @media (max-width: 768px) {
        #fotoProfil {
            display: none;
        }
        .dataGrid {
            grid-template-columns: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img @if($cp->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoCP/'.$cp->foto) }}" alt="{{ $cp->nama }}" @endif class="box img-fluid imgZoom" id="fotoProfil">
        </div>

        <div class="col-md-9">
            <div class="box row p-3" id="profile">
                <section class="col-md-6 mb-3" id="profile1">
                    <strong><h4>INFORMASI UMUM</h4></strong>
                    <hr>
                    <div class="dataGrid">
                        <span>NIS:</span>
                        <span>{{ $cp->nis }}</span>
                        <span>Nama:</span>
                        <span>{{ $cp->nama }}</span>
                        <span>Jenis Kelamin:</span>
                        <span>@if($cp->jenis_kelamin === 'L') Laki-laki @else Perempuan @endif</span>
                        <span>Tempat, Tanggal Lahir:</span>
                        <span>{{ $cp->ttl }}</span>
                        <span>Alamat:</span>
                        <span>{!! $cp->alamat !!}</span>
                    </div>
                </section>
                <section class="col-md-6" id="profile2">
                    <strong><h4>KONTAK</h4></strong>
                    <hr>
                    <div class="dataGrid">
                        <span>No HP:</span>
                        <span>{{ $cp->kontak->no_hp }}</span>
                        <span>No Telepon:</span>
                        <span>{{ $cp->kontak->no_telepon }}</span>
                        <span>ID Line:</span>
                        <span>{{ $cp->kontak->id_line }}</span>
                    </div>
                    <span>Kontak lainnya:</span><br />
                    <span>{!! $cp->kontak->kontak_dll !!}</span>
                </section>
                <section class="col-md-12 mt-3" id="profile3">
                    <h4 class="text-center">Terakhir kali data di update: @if($cp->updated_at) {{ $cp->updated_at }} @else {{ $cp->created_at }} @endif</h4>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts.modalGambar')
@endsection
