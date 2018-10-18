@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card box btn-square">
                    <div class="card-header text-center h3">
                        <a href="{{ url('/') }}" class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                        Ganti Password
                    </div>

                    <div class="card-body p-0">
                        @if($akun->id_status === 1)
                        <form method="POST" action="{{ url('admin/settings/password') }}">
                        @elseif($akun->id_status === 2)
                        <form method="POST" action="{{ url('perusahaan/settings/password') }}">
                        @else
                        <form method="POST" action="{{ url('cp/settings/password') }}">
                        @endif
                            @csrf

                            <div class="p-3">
                                <div class="form-group row">
                                    <label for="passLama" class="col-md-4 col-form-label text-md-right">{{ __('Password Lama') }}</label>

                                    <div class="col-md-6">
                                        <input id="passLama" type="password" class="form-control{{ $errors->has('passLama') ? ' is-invalid' : '' }}" name="passLama" value="{{ old('passLama') }}" required>

                                        @if ($errors->has('pass_lama'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pass_lama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password Baru') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group row m-0 p-0">
                                <button type="submit" class="btn btn-primary btn-block btn-square">
                                    {{ __('Ganti Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
