@extends('layouts.app')

@section('title')
    Ubah Data Diri -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header text-center h3">
                    <a href="{{ url('/') }}" class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                    Data Perusahaan
                </div>
                <div class="card-body p-0">
                    <form method="POST" action="{{ url('perusahaan/settings/datadiri') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id_kontak" value="{{ $perusahaan->kontak->id_kontak }}"/>

                        <div class="p-3">
                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-md-3 col-form-label text-md-right">{{ __('Nama Perusahaan*') }}</label>

                                <div class="col-md-8">
                                    <input id="nama_perusahaan" type="text" class="form-control{{ $errors->has('nama_perusahaan') ? ' is-invalid' : '' }}" name="nama_perusahaan" value="{{ $perusahaan->nama }}" required autofocus>

                                    @if ($errors->has('nama_perusahaan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-3 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-8">
                                    <textarea id="alamat" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat">{{ $perusahaan->alamat }}</textarea>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bio" class="col-md-3 col-form-label text-md-right">{{ __('Bio') }}</label>

                                <div class="col-md-8">
                                    <textarea id="bio" type="text" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio">{{ $perusahaan->bio }}</textarea>

                                    @if ($errors->has('bio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Foto') }}</label>

                                <div class="col-md-8">
                                    <img @if($perusahaan->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @endif class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">

                                    <input type="file" id="foto" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }} previewInputFoto" name="foto">

                                    @if ($errors->has('foto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="no_hp" class="col-md-3 col-form-label text-md-right">{{ __('No HP*') }}</label>

                                <div class="col-md-8">
                                    <input id="no_hp" type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ $perusahaan->kontak->no_hp }}">

                                    @if ($errors->has('no_hp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_hp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_telepon" class="col-md-3 col-form-label text-md-right">{{ __('No Telepon') }}</label>

                                <div class="col-md-8">
                                    <input id="no_telepon" type="text" class="form-control{{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" name="no_telepon" value="{{ $perusahaan->kontak->no_telepon }}">

                                    @if ($errors->has('no_telepon'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_line" class="col-md-3 col-form-label text-md-right">{{ __('ID Line') }}</label>

                                <div class="col-md-8">
                                    <input id="id_line" type="text" class="form-control{{ $errors->has('id_line') ? ' is-invalid' : '' }}" name="id_line" value="{{ $perusahaan->kontak->id_line }}">

                                    @if ($errors->has('id_line'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('id_line') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kontak" class="col-md-3 col-form-label text-md-right">{{ __('Kontak Lainnya') }}</label>

                                <div class="col-md-8">
                                    <textarea id="kontak" type="text" class="form-control{{ $errors->has('kontak') ? ' is-invalid' : '' }} summernote" name="kontak">{{ $perusahaan->kontak->kontak_dll }}</textarea>

                                    @if ($errors->has('kontak'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kontak') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                       </div>

                       <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                {{ __('Ubah Data Diri') }}
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
