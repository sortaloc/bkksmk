@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-squre">
                <div class="card-header text-center h3">
                    <a href="{{ url('admin/kegiatan') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Form Tambah Kegiatan
                </div>
                <div class="card-body p-0">
                    <form action="{{ url('admin/kegiatan/add') }}" method="post" enctype="multipart/form-data">
                        <div class="p-3">
                            @csrf

                            <div class="form-group row">
                                <label for="judul_kegiatan" class="col-md-3 col-form-label text-md-right">{{ __('Judul Kegiatan*') }}</label>

                                <div class="col-md-8">
                                    <input id="judul_kegiatan" type="text" class="form-control{{ $errors->has('judul_kegiatan') ? ' is-invalid' : '' }}" name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" required autofocus>

                                    @if ($errors->has('judul_kegiatan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('judul_kegiatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi_kegiatan" class="col-md-3 col-form-label text-md-right">{{ __('Deskripsi Kegiatan*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="deskripsi_kegiatan" type="text" class="form-control{{ $errors->has('deskripsi_kegiatan') ? ' is-invalid' : '' }}" name="deskripsi_kegiatan" required>{{ old('deskripsi_kegiatan') }}</textarea>

                                    @if ($errors->has('deskripsi_kegiatan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('deskripsi_kegiatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Foto Kegiatan') }}</label>

                                <div class="col-md-8">
                                    <img src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" class="img-thumbnail mb-2" id="profile-img-tag" width="220px">

                                    <input id="foto_kegiatan" type="file" class="form-control{{ $errors->has('foto_kegiatan') ? ' is-invalid' : '' }}" name="foto_kegiatan">

                                    @if ($errors->has('foto_kegiatan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto_kegiatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-plus"></i> {{ __('Tambah Kegiatan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
