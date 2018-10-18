@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.adminmenu')
        <section class="col-md-9" id="pengaturan">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Pengaturan</div>

                <div class="card-body p-0">
                    <form method="POST" action="{{ url('admin/pengaturan') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="p-3">
                            <h2 class="text-center">Data Landing Page</h2>
                            <div class="form-group row">
                                <label for="banner1" class="col-md-3 col-form-label text-md-right">{{ __('Banner 1*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="banner1" type="text" class="form-control{{ $errors->has('banner1') ? ' is-invalid' : '' }}" name="banner1" required>{{ $pengaturan->banner1 }}</textarea>

                                    @if ($errors->has('banner1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('banner1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Foto 1*') }}</label>

                                <div class="col-md-8">
                                    <img @if($pengaturan->foto1 === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/banner/'.$pengaturan->foto1) }}" alt="{{ $pengaturan->foto1 }}" @endif class="img-thumbnail mb-2" id="profile-img-tag" width="220px">

                                    <input id="foto1" type="file" class="form-control{{ $errors->has('foto1') ? ' is-invalid' : '' }}" id="foto1" name="foto1">

                                    @if ($errors->has('foto1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fitur1" class="col-md-3 col-form-label text-md-right">{{ __('Fitur 1*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="fitur1" type="text" class="form-control{{ $errors->has('fitur1') ? ' is-invalid' : '' }}" name="fitur1" required>{{ $pengaturan->fitur1 }}</textarea>

                                    @if ($errors->has('fitur1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fitur1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fitur2" class="col-md-3 col-form-label text-md-right">{{ __('Fitur 2*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="fitur2" type="text" class="form-control{{ $errors->has('fitur2') ? ' is-invalid' : '' }}" name="fitur2" required>{{ $pengaturan->fitur2 }}</textarea>

                                    @if ($errors->has('fitur2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fitur2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fitur3" class="col-md-3 col-form-label text-md-right">{{ __('Fitur 3*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="fitur3" type="text" class="form-control{{ $errors->has('fitur3') ? ' is-invalid' : '' }}" name="fitur3" required>{{ $pengaturan->fitur3 }}</textarea>

                                    @if ($errors->has('fitur3'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fitur3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <h2 class="text-center">Data Footer</h2>
                            <div class="form-group row">
                                <label for="alamat" class="col-md-3 col-form-label text-md-right">{{ __('Alamat*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="alamat" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" required>{{ $pengaturan->alamat }}</textarea>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telp" class="col-md-3 col-form-label text-md-right">{{ __('No Telepon*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="telp" type="text" class="form-control{{ $errors->has('telp') ? ' is-invalid' : '' }}" name="telp" required>{{ $pengaturan->telp }}</textarea>

                                    @if ($errors->has('telp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fax" class="col-md-3 col-form-label text-md-right">{{ __('Fax*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="fax" type="text" class="form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" name="fax" required>{{ $pengaturan->fax }}</textarea>

                                    @if ($errors->has('fax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>{{ $pengaturan->email }}</textarea>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-edit"></i> {{ __('Ubah Pengaturan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.adminmenu_setting').addClass('active');
</script>
@endsection
