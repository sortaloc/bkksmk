@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">Data Lamaran</div>

                <div class="card-body">
                    <form method="post" action="{{ url('cp/lamaran', base64_encode($loker->id_loker)) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="cv" class="col-md-4 col-form-label text-md-right">{{ __('Curicullum Vitae') }}</label>

                            <div class="col-md-6">
                                <input id="cv" type="file" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv">

                                @if ($errors->has('cv'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surat_lamaran" class="col-md-4 col-form-label text-md-right">{{ __('Surat Lamaran') }}</label>

                            <div class="col-md-6">
                                <input id="surat_lamaran" type="file" class="form-control{{ $errors->has('surat_lamaran') ? ' is-invalid' : '' }}" name="surat_lamaran">

                                @if ($errors->has('surat_lamaran'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surat_lamaran') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan Lainnya') }}</label>

                            <div class="col-md-6">
                                <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" value="{{ old('keterangan') }}" required autofocus></textarea>

                                @if ($errors->has('keterangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Lamaran') }}
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
