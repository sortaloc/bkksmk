@extends('layouts.app')

@section('title')
    Tambah Calon Pegawai -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">
                    <a href="{{ url('admin/cp') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Form Data Calon Pegawai
                </div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <form method="POST" action="{{ url('admin/cp/add') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="nis" class="col-md-4 col-form-label text-md-right">{{ __('NIS*') }}</label>

                                <div class="col-md-6">
                                    <input id="nis" type="text" class="form-control{{ $errors->has('nis') ? ' is-invalid' : '' }}" name="nis" value="{{ old('nis') }}" required>

                                    @if ($errors->has('nis'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nis') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ttl" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="ttl" type="date" class="form-control{{ $errors->has('ttl') ? ' is-invalid' : '' }}" name="ttl" value="{{ old('ttl') }}">

                                    @if ($errors->has('ttl'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ttl') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama*') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required>

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin*') }}</label>

                                <div class="col-md-6 {{ $errors->has('jk') ? 'border border-danger p-1' : '' }}">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jk" id="laki" value="L" class="custom-control-input" @if(old('jk') === 'L') checked @endif>
                                        <label for="laki" class="custom-control-label">Laki-Laki</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jk" id="perempuan" value="P" class="custom-control-input" @if(old('jk') === 'P') checked @endif>
                                        <label for="perempuan" class="custom-control-label">Perempuan</label>
                                    </div>
                                </div>

                                @if($errors->has('jk'))
                                    <small id="jkHelp" class="form-text text-danger">{{ $errors->first('jk') }}</small>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="alumni" class="col-md-4 col-form-label text-md-right">Alumni*</label>

                                <div class="col-md-6 {{ $errors->has('alumni') ? 'border border-danger p-1' : '' }}">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="alumni" id="iya" value="Y" class="custom-control-input" @if(old('alumni') === 'Y') checked @endif>
                                        <label for="iya" class="custom-control-label">Iya</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="alumni" id="tidak" value="T" class="custom-control-input" @if(old('alumni')) checked @endif>
                                        <label for="tidak" class="custom-control-label">Bukan</label>
                                    </div>
                                </div>

                                @if($errors->has('alumni'))
                                    <small id="alumniHelp" class="form-text text-danger">{{ $errors->first('alumni') }}</small>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea id="alamat" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat">{{ old('alamat') }}</textarea>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cv" class="col-md-4 col-form-label text-md-right" id="cvLabel">{{ __('CV') }}</label>

                                <div class="col-md-6">
                                    <div id="realUpload" style="display: none">
                                        <input type="file" id="cv" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv" value="{{ old('cv') }}" autofocus>
                                        {{-- <input id="cv" type="text" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv" value="{{ old('cv') }}" autofocus>
                                        <small id="cvHelpBlock" class="form-text text-muted">Masukkan link Google Drive CV anda. <a href="{{ url('admin/tutorial') }}" class="a-normal">Baca Disini</a></small> --}}

                                        @if ($errors->has('cv'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cv') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block" id="fakeUpload" type="button" data-link="{{ url('google') }}">Upload</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                                <div class="col-md-6">
                                    <img src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">
                                    <input type="file" id="foto" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }} previewInputFoto" name="foto">

                                    @if ($errors->has('foto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="formKegiatanCP" style="display: none">
                                <div class="form-group row">
                                    <label for="jenis_kegiatan" class="col-md-4 col-form-label text-md-right">Kegiatan Saat Ini</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" id="jenis_kegiatan" name="jenis_kegiatan" autocomplete="off">
                                            <option value="Belum Bekerja/Kuliah" @if(old('jenis_kegiatan') == 'Belum Bekerja/Kuliah') selected @endif>Belum Bekerja/Kuliah</option>
                                            <option value="Bekerja" @if(old('jenis_kegiatan') == 'Bekerja') selected @endif>Bekerja</option>
                                            <option value="Kuliah" @if(old('jenis_kegiatan') == 'Kuliah') selected @endif>Kuliah</option>
                                            <option value="Lain-lain" @if(old('jenis_kegiatan') == 'Lain-lain') selected @endif>Lain-lain</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="extra-detail" @if(old('jenis_kegiatan') === 'Lain-lain' || old('jenis_kegiatan') === 'Belum Bekerja/Kuliah') style="display: none" @endif>
                                    <div class="form-group row">
                                        <label for="tempat_kegiatan" class="col-md-4 col-form-label text-md-right">Tempat Bekerja/Kuliah</label>

                                        <div class="col-md-6">
                                            <textarea id="tempat_kegiatan" type="text" class="form-control{{ $errors->has('tempat_kegiatan') ? ' is-invalid' : '' }}" name="tempat_kegiatan">{{ old('tempat_kegiatan') }}</textarea>

                                            @if ($errors->has('tempat_kegiatan'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tempat_kegiatan') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="bidang_kegiatan" class="col-md-4 col-form-label text-md-right">Bekerja / Kuliah di Bidang</label>

                                        <div class="col-md-6">
                                            <input id="bidang_kegiatan" type="text" class="form-control{{ $errors->has('bidang_kegiatan') ? ' is-invalid' : '' }}" name="bidang_kegiatan" value="{{ old('bidang_kegiatan') }}">

                                            @if ($errors->has('bidang_kegiatan'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('bidang_kegiatan') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="no_hp_cp" class="col-md-4 col-form-label text-md-right">{{ __('No HP*') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp_cp" type="text" class="form-control{{ $errors->has('no_hp_cp') ? ' is-invalid' : '' }}" name="no_hp_cp" value="{{ old('no_hp_cp') }}" required>

                                    @if ($errors->has('no_hp_cp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_hp_cp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_telepon" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon') }}</label>

                                <div class="col-md-6">
                                    <input id="no_telepon" type="text" class="form-control{{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" name="no_telepon" value="{{ old('no_telepon') }}">

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
                                    <input id="id_line" type="text" class="form-control{{ $errors->has('id_line') ? ' is-invalid' : '' }}" name="id_line" value="{{ old('id_line') }}">

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
                                    <textarea id="kontak" type="text" class="form-control{{ $errors->has('kontak') ? ' is-invalid' : '' }} summernote" name="kontak">{{ old('kontak') }}</textarea>

                                    @if ($errors->has('kontak'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kontak') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="emailCP" class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail*') }}</label>

                                <div class="col-md-6">
                                    <input id="emailCP" type="email" class="form-control{{ $errors->has('emailCP') ? ' is-invalid' : '' }}" name="emailCP" value="{{ old('emailCP') }}" required>

                                    @if ($errors->has('emailCP'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emailCP') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usernameCP" class="col-md-4 col-form-label text-md-right">{{ __('Username*') }}</label>

                                <div class="col-md-6">
                                    <input id="usernameCP" type="text" class="form-control{{ $errors->has('usernameCP') ? ' is-invalid' : '' }}" name="usernameCP" required>

                                    @if ($errors->has('usernameCP'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('usernameCP') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="passwordCP" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="passwordCP" type="password" class="form-control{{ $errors->has('passwordCP') ? ' is-invalid' : '' }}" name="passwordCP" required>

                                    @if ($errors->has('passwordCP'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passwordCP') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="passwordCP-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="passwordCP-confirm" type="password" class="form-control" name="passwordCP_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-plus"></i> - Tambah Data Calon Pegawai
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
<script type="text/javascript">
    $("input[name=alumni]:radio").on('change', function(e){
        if(e.target.value === 'Y'){
            $('#formKegiatanCP').fadeIn();
        }else{
            $('#formKegiatanCP').fadeOut();
        }

        if($('#jenis_kegiatan').val() === 'Belum Bekerja/Kuliah' || $('#jenis_kegiatan').val() === 'Lain-lain'){
            $('#extra-detail').fadeOut();
        }else{
            $('#extra-detail').fadeIn();
        }
    });

    $('#jenis_kegiatan').on('change', e => {
        if(e.target.value === 'Belum Bekerja/Kuliah' || e.target.value === 'Lain-lain'){
            $('#extra-detail').fadeOut();
        }else{
            $('#extra-detail').fadeIn();
        }
    });
</script>
@include('layouts.modalGambar')
<script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-popupGD.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-summernote.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-previewImage.js') }}"></script>
@endsection
