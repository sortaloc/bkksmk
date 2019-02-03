@extends('layouts.app')

@section('title')
    Tambah Lowongan Kerja -
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
                        <a @if(Auth::user()->id_status === 2) href="{{ url('/perusahaan/loker') }}" @elseif(Auth::user()->id_status === 1) href="{{ url('/admin/loker') }}" @endif class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                        Buat Lowongan Kerja
                    </div>

                    <div class="card-body p-0">
                        @if(Auth::user()->id_status === 1)
                        <form method="POST" action="{{ url('admin/loker/add') }}" enctype="multipart/form-data" id="lokerForm">
                        @elseif(Auth::user()->id_status === 2)
                        <form method="POST" action="{{ url('perusahaan/loker/add') }}" enctype="multipart/form-data" id="lokerForm">
                        @endif
                            @csrf
                            <div class="p-3">
                                <div class="form-group row">
                                    <label for="judul" class="col-md-3 col-form-label text-md-right">{{ __('Judul Loker*') }}</label>

                                    <div class="col-md-8">
                                        <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ old('judul') }}" placeholder="Dibutuhkan Vue Programmer!" required autofocus>

                                        @if ($errors->has('judul'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bidang_pekerjaan" class="col-md-3 col-form-label text-md-right">{{ __('Bidang Pekerjaan*') }}</label>

                                    <div class="col-md-8">
                                        <input id="bidang_pekerjaan" type="text" class="form-control{{ $errors->has('bidang_pekerjaan') ? ' is- invalid' : '' }}" name="bidang_pekerjaan" value="{{ old('bidang_pekerjaan') }}" placeholder="Programmer" required autofocus>

                                        @if($errors->has('bidang_pekerjaan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('bidang_pekerjaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="persyaratan" class="col-md-3 col-form-label text-md-right">{{ __('Persyaratan*') }}</label>

                                    <div class="col-md-8">
                                        <textarea id="persyaratan" type="text" class="form-control{{ $errors->has('persyaratan') ? ' is-invalid' : '' }} summernote" name="persyaratan" value="{{ old('persyaratan') }}"></textarea>

                                        @if ($errors->has('persyaratan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('persyaratan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jam_kerja" class="col-md-3 col-form-label text-md-right">{{ __('Jam Kerja*') }}</label>

                                    <div class="col-md-8">
                                        <!-- <textarea id="jam_kerja" type="text" class="form-control{{ $errors->has('jam_kerja') ? ' is-invalid' : '' }}" name="jam_kerja" value="{{ old('jam_kerja') }}" required autofocus></textarea> -->

                                        <div class="input-group">
                                            <select class="custom-select" id="jam_kerja" name="jam_kerja">
                                                @for($i = 1; $i <= 24; $i++)
                                                    <option value="{{ $i }} jam / hari" @if(old('jam_kerja') === $i.' jam / hari') selected @endif>{{ $i }} jam</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="jam_kerja">/ hari</label>
                                            </div>
                                        </div>

                                        @if ($errors->has('jam_kerja'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('jam_kerja') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gaji" class="col-md-3 col-form-label text-md-right">{{ __('Gaji*') }}</label>

                                    <div class="col-md-8">
                                        <!-- <textarea id="gaji" type="text" class="form-control{{ $errors->has('gaji') ? ' is-invalid' : '' }}" name="gaji" value="{{ old('gaji') }}" required autofocus></textarea> -->

                                        <div class="input-group">
                                            <select class="custom-select" id="gaji" name="gaji">
                                                <option value="Dibawah Rp. 1.000.000 / bulan" @if(old('gaji') === 'Dibawah Rp. 1.000.000 / bulan') selected @endif>Dibawah Rp. 1.000.000</option>
                                                <option value="Antara Rp. 1.000.000 - Rp. 2.000.000 / bulan" @if(old('gaji') === 'Antara Rp. 1.000.000 - Rp. 2.000.000 / bulan') selected @endif>Antara Rp. 1.000.000 - 2.000.000</option>
                                                <option value="Antara Rp. 2.000.000 - Rp. 5.000.000 / bulan" @if(old('gaji') === 'Antara Rp. 2.000.000 - Rp. 5.000.000 / bulan') selected @endif>Antara Rp. 2.000.000 - 5.000.000</option>
                                                <option value="Antara Rp. 5.000.000 - Rp. 10.000.000 / bulan" @if(old('gaji') === 'Antara Rp. 5.000.000 - Rp. 10.000.000 / bulan') selected @endif>Antara Rp. 5.000.000 - 10.000.000</option>
                                                <option value="Diatas Rp. 10.000.000 / bulan" @if(old('gaji') === 'Diatas Rp. 10.000.000 / bulan') selected @endif>Diatas Rp. 10.000.000</option>
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="gaji">/ bulan</label>
                                            </div>
                                        </div>

                                        @if ($errors->has('gaji'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gaji') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="keterangan" class="col-md-3 col-form-label text-md-right">{{ __('Keterangan Lainnya') }}</label>

                                    <div class="col-md-8">
                                        <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }} summernote" name="keterangan" value="{{ old('keterangan') }}"></textarea>

                                        @if ($errors->has('keterangan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('keterangan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jadwal_tes" class="col-md-3 col-form-label text-md-right">{{ __('Jadwal Tes*') }}</label>

                                    <div class="col-md-8">
                                        <input id="jadwal_tes" type="date" class="form-control{{ $errors->has('jadwal_tes') ? ' is-invalid' : '' }}" name="jadwal_tes" value="{{ old('jadwal_tes') }}" required>

                                        @if($errors->has('jadwal_tes'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('jadwal_tes') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="waktu_tes" class="col-md-3 col-form-label text-md-right">{{ __('Waktu Tes*') }}</label>

                                    <div class="col-md-4">
                                        <select class="custom-select" id="waktu_tes_jam" name="waktu_tes_jam" required>
                                            <option value="00" @if(old('waktu_tes_jam') === '00') selected @endif>00</option>
                                            <option value="01" @if(old('waktu_tes_jam') === '01') selected @endif>01</option>
                                            <option value="02" @if(old('waktu_tes_jam') === '02') selected @endif>02</option>
                                            <option value="03" @if(old('waktu_tes_jam') === '03') selected @endif>03</option>
                                            <option value="04" @if(old('waktu_tes_jam') === '04') selected @endif>04</option>
                                            <option value="05" @if(old('waktu_tes_jam') === '05') selected @endif>05</option>
                                            <option value="06" @if(old('waktu_tes_jam') === '06') selected @endif>06</option>
                                            <option value="07" @if(old('waktu_tes_jam') === '07') selected @endif>07</option>
                                            <option value="08" @if(old('waktu_tes_jam') === '08') selected @endif>08</option>
                                            <option value="09" @if(old('waktu_tes_jam') === '09') selected @endif>09</option>
                                            @for($i = 10; $i <= 24; $i++)
                                                <option value="{{ $i }}" @if(old('waktu_tes_jam') === $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <small id="waktu_tes_jamHelpBlock" class="form-text text-muted">Jam waktu tes</small>

                                        @if($errors->has('waktu_tes'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('waktu_tes_jam') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" id="waktu_tes_menit" name="waktu_tes_menit" required>
                                            <option value="00" @if(old('waktu_tes_menit') === '00') selected @endif>00</option>
                                            <option value="01" @if(old('waktu_tes_menit') === '01') selected @endif>01</option>
                                            <option value="02" @if(old('waktu_tes_menit') === '02') selected @endif>02</option>
                                            <option value="03" @if(old('waktu_tes_menit') === '03') selected @endif>03</option>
                                            <option value="04" @if(old('waktu_tes_menit') === '04') selected @endif>04</option>
                                            <option value="05" @if(old('waktu_tes_menit') === '05') selected @endif>05</option>
                                            <option value="06" @if(old('waktu_tes_menit') === '06') selected @endif>06</option>
                                            <option value="07" @if(old('waktu_tes_menit') === '07') selected @endif>07</option>
                                            <option value="08" @if(old('waktu_tes_menit') === '08') selected @endif>08</option>
                                            <option value="09" @if(old('waktu_tes_menit') === '09') selected @endif>09</option>
                                            @for($i = 10; $i <= 59; $i++)
                                                <option value="{{ $i }}" @if(old('waktu_tes_menit') === $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <small id="waktu_tes_menitHelpBlock" class="form-text text-muted">Menit waktu tes</small>

                                        @if($errors->has('waktu_tes'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('waktu_tes_menit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempat_tes" class="col-md-3 col-form-label text-md-right">{{ __('Tempat Tes*') }}</label>

                                    <div class="col-md-8">
                                        <input id="tempat_tes" type="text" class="form-control{{ $errors->has('tempat_tes') ? ' is-invalid' : '' }}" name="tempat_tes" value="{{ old('tempat_tes') }}" placeholder="Aula SMKN 11 Bandung" required>

                                        @if($errors->has('tempat_tes'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat_tes') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="brosur" class="col-md-3 col-form-label text-md-right">{{ __('Brosur') }}</label>

                                    <div class="col-md-8">
                                        <img src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">

                                        <input id="brosur" type="file" class="form-control{{ $errors->has('brosur') ? ' is-invalid' : '' }} previewInputFoto" name="brosur">

                                        @if ($errors->has('brosur'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('brosur') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-0 p-0">
                                <button type="submit" class="btn btn-primary btn-block btn-square">
                                    <i class="fas fa-plus"></i> {{ __('Buat Loker') }}
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
