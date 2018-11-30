@extends('layouts.app')

@section('title')
    Edit Calon Pegawai -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">
                    <a href="{{ url('admin/cp') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Form Data Calon Pegawai
                </div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <form method="post" action="{{ url('admin/cp/edit', base64_encode($cp->nis)) }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id_kontak" value="{{ $cp->kontak->id_kontak }}">

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama*') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $cp->nama }}" required autofocus>

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ttl" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="ttl" type="date" class="form-control{{ $errors->has('ttl') ? ' is-invalid' : '' }}" name="ttl" value="{{ $cp->ttl }}" autofocus>

                                    @if ($errors->has('ttl'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ttl') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin*') }}</label>

                                <div class="col-md-6">
                                    <input type="radio" name="jk" id="laki" value="L" class="ml-3" @if($cp->jenis_kelamin === 'L') checked @endif>
                                    <label for="laki" class="col-form-label text-md-right ml-2">Laki-Laki</label>

                                    <input type="radio" name="jk" id="perempuan" value="P" class="ml-2" @if($cp->jenis_kelamin === 'P') checked @endif>
                                    <label for="perempuan"  class="col-form-label text-md-right ml-2">Perempuan</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea id="alamat" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat">{{ $cp->alamat }}</textarea>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($cp->cv)
                            <div class="embed-responsive embed-responsive-16by9 box col-md-6 offset-md-4 mb-2">
                                <iframe src="{{ $cp->cv }}" class="embed-responsive-item"></iframe>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="cv" class="col-md-4 col-form-label text-md-right">{{ __('CV') }}</label>

                                <div class="col-md-6">
                                    <div id="realUpload" style="display: none">
                                        <input type="file" id="cv" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv" value="{{ $cp->cv }}" autofocus>
                                        {{-- <input id="cv" type="text" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv" value="{{ $cp->cv }}" autofocus>
                                        <small id="cvHelpBlock" class="form-text text-muted">Masukkan link Google Drive CV anda. <a href="{{ url('admin/tutorial') }}" class="a-normal">Baca Disini</a></small> --}}

                                        @if ($errors->has('cv'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cv') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block" id="fakeUpload" type="button">Upload</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                                <div class="col-md-6">
                                    <img @if($cp->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoCP/'.$cp->foto) }}" alt="{{ $cp->nama }}" @endif class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">
                                    <input type="file" id="foto" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }} previewInputFoto" name="foto">

                                    @if ($errors->has('foto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('No HP*') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ $cp->kontak->no_hp }}" required>

                                    @if ($errors->has('no_hp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_hp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_telepon" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon') }}</label>

                                <div class="col-md-6">
                                    <input id="no_telepon" type="text" class="form-control{{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" name="no_telepon" value="{{ $cp->kontak->no_telepon }}">

                                    @if ($errors->has('no_telepon'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_line" class="col-md-4 col-form-label text-md-right">{{ __('ID Line') }}</label>

                                <div class="col-md-6">
                                    <input id="id_line" type="text" class="form-control{{ $errors->has('id_line') ? ' is-invalid' : '' }}" name="id_line" value="{{ $cp->kontak->id_line }}">

                                    @if ($errors->has('id_line'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('id_line') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kontak" class="col-md-4 col-form-label text-md-right">{{ __('Kontak Lainnya') }}</label>

                                <div class="col-md-6">
                                    <textarea id="kontak" type="text" class="form-control{{ $errors->has('kontak') ? ' is-invalid' : '' }} summernote" name="kontak">{{ $cp->kontak->kontak_dll }}</textarea>

                                    @if ($errors->has('kontak'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kontak') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-edit"></i> - {{ __('Ubah Data Diri') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Ganti Password</div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <form method="post" action="{{ url('admin/cp/edit/password', base64_encode($cp->id_user)) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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

                        <div class="form-group m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-edit"></i> - {{ __('Ubah Password') }}
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
<script type="text/javascript" src="{{ asset('js/bkk-popupGD.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-summernote.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-previewImage.js') }}"></script>
@endsection
