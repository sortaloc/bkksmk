@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">
                    <a href="{{ url('cp/loker') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    <span>Data Lamaran</span>
                </div>

                <div class="card-body p-0">
                    <form method="post" action="{{ url('cp/lamaran', base64_encode($loker->id_loker)) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="p-3">
                            <div class="form-group row">
                                <label for="surat_lamaran" class="col-md-4 col-form-label text-md-right">{{ __('Surat Lamaran*') }}</label>

                                <div class="col-md-6">
                                    <div id="realUpload" style="display: none">
                                        <input id="surat_lamaran" type="file" class="form-control{{ $errors->has('surat_lamaran') ? ' is-invalid' : '' }}" name="surat_lamaran" value="{{ old('surat_lamaran') }}" required autofocus>
                                        {{-- <small id="surat_lamaranHelpBlock" class="form-text text-muted">Masukkan link Google Drive CV anda. <a href="{{ url('cp/tutorial') }}" class="a-normal">Baca Disini</a></small> --}}

                                        @if ($errors->has('surat_lamaran'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surat_lamaran') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block" type="buton" id="fakeUpload">Upload</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan Lainnya') }}</label>

                                <div class="col-md-6">
                                    <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }} summernote" name="keterangan" value="{{ old('keterangan') }}" autofocus></textarea>

                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('keterangan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                {{ __('Kirim Lamaran') }}
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
<script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-popupGD.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-summernote.js') }}"></script>
@endsection
