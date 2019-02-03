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
                <div class="card-header h3 text-center">Data Calon Pegawai</div>
                <div class="card-body p-0">
                    <form method="POST" action="{{ url('cp/settings/datadiri') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id_kontak" value="{{ $cp->kontak->id_kontak }}"/>

                        <div class="p-3">
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
                                <label for="jk" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin*') }}</label>

                                <div class="col-md-6">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jk" id="laki" value="L" class="custom-control-input" @if($cp->jenis_kelamin === 'L') checked @endif autocomplete="off">
                                        <label for="laki" class="custom-control-label">Laki-Laki</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jk" id="perempuan" value="P" class="custom-control-input" @if($cp->jenis_kelamin === 'P') checked @endif autocomplete="off">
                                        <label for="perempuan"  class="custom-control-label">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alumni" class="col-md-4 col-form-label text-md-right">Alumni*</label>

                                <div class="col-md-6 {{ $errors->has('alumni') ? 'border border-danger p-1' : '' }}">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="alumni" id="iya" value="Y" class="custom-control-input" @if($cp->alumni === 'Y') checked @endif>
                                        <label for="iya" class="custom-control-label">Iya</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="alumni" id="tidak" value="T" class="custom-control-input" @if($cp->alumni === 'T') checked @endif>
                                        <label for="tidak" class="custom-control-label">Bukan</label>
                                    </div>
                                </div>

                                @if($errors->has('alumni'))
                                    <small id="alumniHelp" class="form-text text-danger">{{ $errors->first('alumni') }}</small>
                                @endif
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
                                        <input id="cv" type="file" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" name="cv" value="{{ $cp->cv }}" autofocus>
                                        {{-- <small id="cvHelpBlock" class="form-text text-muted">Masukkan link Google Drive CV anda. <a href="{{ url('cp/tutorial') }}" class="a-normal">Baca Disini</a></small> --}}

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
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

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

                            <hr />

                            <div class="form-group row">
                                <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('No HP*') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ $cp->kontak->no_hp }}">

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

                        <div id="formKegiatanCP" @if(!$cp->id_kegiatan_cp) style="display: none" @endif>
                            <hr/>

                            <div class="form-group row">
                                <label for="jenis_kegiatan" class="col-md-4 col-form-label text-md-right">Kegiatan Saat Ini</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="jenis_kegiatan" name="jenis_kegiatan" autocomplete="off">
                                            <option value="Belum Bekerja/Kuliah" @if($cp->id_kegiatan_cp) @if($cp->kegiatancp->jenis_kegiatan == 'Belum Bekerja/Kuliah') selected @endif @endif>Belum Bekerja/Kuliah</option>
                                            <option value="Bekerja" @if($cp->id_kegiatan_cp) @if($cp->kegiatancp->jenis_kegiatan == 'Bekerja') selected @endif @endif>Bekerja</option>
                                            <option value="Kuliah" @if($cp->id_kegiatan_cp) @if($cp->kegiatancp->jenis_kegiatan == 'Kuliah') selected @endif @endif>Kuliah</option>
                                            <option value="Lain-lain" @if($cp->id_kegiatan_cp) @if($cp->kegiatancp->jenis_kegiatan == 'Lain-lain') selected @endif @endif>Lain-lain</option>
                                    </select>
                                </div>
                            </div>

                            <div id="extra-detail" @if($cp->id_kegiatan_cp) @if($cp->kegiatancp->jenis_kegiatan === 'Lain-lain' || $cp->kegiatancp->jenis_kegiatan === 'Belum Bekerja/Kuliah') style="display: none" @endif @else style="display: none" @endif>
                                <div class="form-group row">
                                    <label for="tempat_kegiatan" class="col-md-4 col-form-label text-md-right">Tempat Bekerja/Kuliah</label>

                                    <div class="col-md-6">
                                        <textarea id="tempat_kegiatan" type="text" class="form-control{{ $errors->has('tempat_kegiatan') ? ' is-invalid' : '' }}" name="tempat_kegiatan">@if($cp->id_kegiatan_cp) {{ $cp->kegiatancp->tempat_kegiatan }} @endif</textarea>

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
                                        <input id="bidang_kegiatan" type="text" class="form-control{{ $errors->has('bidang_kegiatan') ? ' is-invalid' : '' }}" name="bidang_kegiatan" @if($cp->id_kegiatan_cp) value="{{ $cp->kegiatancp->bidang_kegiatan}}" @endif>

                                        @if ($errors->has('bidang_kegiatan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('bidang_kegiatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                {{ __('Ubah Data DIri') }}
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
