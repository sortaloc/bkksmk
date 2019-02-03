@extends('layouts.app')

@section('title')
    Edit Berita -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-squre">
                <div class="card-header text-center h3">
                    <a href="{{ url('admin/berita') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Form Edit Berita
                </div>
                <div class="card-body p-0">
                    <form action="{{ url('admin/berita/edit', base64_encode($berita->id_berita)) }}" method="post" enctype="multipart/form-data" class="p-3">
                        @csrf

                        <div class="form-group row">
                            <label for="judul_berita" class="col-md-3 col-form-label text-md-right">{{ __('Judul Berita*') }}</label>

                            <div class="col-md-8">
                                <input id="judul_berita" type="text" class="form-control{{ $errors->has('judul_berita') ? ' is-invalid' : '' }}" name="judul_berita" value="{{ $berita->judul_berita }}" required autofocus>

                                @if ($errors->has('judul_berita'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('judul_berita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penulis" class="col-md-3 col-form-label text-md-right">{{ __('Penulis') }}</label>

                            <div class="col-md-8">
                                <input id="penulis" type="text" class="form-control{{ $errors->has('penulis') ? ' is-invalid' : '' }}" name="penulis" value="{{ $berita->penulis }}" autofocus>

                                @if ($errors->has('penulis'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('penulis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isi_berita" class="col-md-3 col-form-label text-md-right">{{ __('Isi Berita*') }}</label>

                            <div class="col-md-8">
                                <textarea id="isi_berita" type="text" class="form-control{{ $errors->has('isi_berita') ? ' is-invalid' : '' }} summernote" name="isi_berita" required>{{ $berita->isi_berita }}</textarea>

                                @if ($errors->has('isi_berita'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('isi_berita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Foto Berita') }}</label>

                            <div class="col-md-8">
                                <img @if($berita->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$berita->foto_berita) }}" alt="{{ $berita->judul_berita }}" @endif class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">

                                <input id="foto_berita" type="file" class="form-control{{ $errors->has('foto_berita') ? ' is-invalid' : '' }} previewInputFoto" name="foto_berita">

                                @if ($errors->has('foto_berita'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto_berita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-edit"></i> {{ __('Ubah Berita') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts.modalGambar')
<script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-summernote.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-previewImage.js') }}"></script>
@endsection

