@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    Buat Lowongan Kerja
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('perusahaan/loker/edit', base64_encode($loker->id_loker)) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="judul" class="col-md-4 col-form-label text-md-right">{{ __('Judul Loker') }}</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ $loker->judul }}" required autofocus>

                                @if ($errors->has('judul'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="persyaratan" class="col-md-4 col-form-label text-md-right">{{ __('Persyaratan') }}</label>

                            <div class="col-md-6">
                                <textarea id="persyaratan" type="text" class="form-control{{ $errors->has('persyaratan') ? ' is-invalid' : '' }}" name="persyaratan" required>{{ $loker->persyaratan }}</textarea>

                                @if ($errors->has('persyaratan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('persyaratan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jam_kerja" class="col-md-4 col-form-label text-md-right">{{ __('Jam Kerja') }}</label>

                            <div class="col-md-6">
                                <textarea id="jam_kerja" type="text" class="form-control{{ $errors->has('jam_kerja') ? ' is-invalid' : '' }}" name="jam_kerja" required>{{ $loker->jam_kerja }}</textarea>

                                @if ($errors->has('jam_kerja'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jam_kerja') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gaji" class="col-md-4 col-form-label text-md-right">{{ __('Gaji') }}</label>

                            <div class="col-md-6">
                                <textarea id="gaji" type="text" class="form-control{{ $errors->has('gaji') ? ' is-invalid' : '' }}" name="gaji" required>{{ $loker->gaji }}</textarea>

                                @if ($errors->has('gaji'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gaji') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan Lainnya') }}</label>

                            <div class="col-md-6">
                                <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" required>{{ $loker->keterangan_loker }}</textarea>

                                @if ($errors->has('keterangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brosur" class="col-md-4 col-form-label text-md-right">{{ __('Brosur') }}</label>

                            <div class="col-md-6">
                                <label for="brosur">{{ $loker->brosur }}</label>
                                <input id="brosur" type="file" class="form-control{{ $errors->has('brosur') ? ' is-invalid' : '' }}" name="brosur">

                                @if ($errors->has('brosur'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('brosur') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ubah Loker') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
