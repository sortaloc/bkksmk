@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header text-center h3">
                    <a @if(Auth::user()->id_status === 2) href="{{ url('/') }}" @elseif(Auth::user()->id_status === 1) href="{{ url('/admin/loker') }}" @endif class="backButton"><i class="fas fa-arrow-left float-left"></i></a>
                    Data Lowongan Kerja
                </div>

                <div class="card-body p-0">
                    <form method="POST" @if(Auth::user()->id_status === 2) action="{{ url('perusahaan/loker/edit', base64_encode($loker->id_loker)) }}" @elseif(Auth::user()->id_status === 1) action="{{ url('admin/loker/edit', base64_encode($loker->id_loker)) }}" @endif enctype="multipart/form-data">
                        @csrf
                        <div class="p-3">
                            <div class="form-group row">
                                <label for="judul" class="col-md-3 col-form-label text-md-right">{{ __('Judul Loker*') }}</label>

                                <div class="col-md-8">
                                    <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ $loker->judul }}" required autofocus>

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
                                    <input id="bidang_pekerjaan" type="text" class="form-control{{ $errors->has('bidang_pekerjaan') ? ' is- invalid' : '' }}" name="bidang_pekerjaan" value="{{ $loker->bidang_pekerjaan }}" placeholder="Programmer" required autofocus>

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
                                    <textarea id="persyaratan" type="text" class="form-control{{ $errors->has('persyaratan') ? ' is-invalid' : '' }} summernote" name="persyaratan" required>{{ $loker->persyaratan }}</textarea>

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
                                    <!-- <textarea id="jam_kerja" type="text" class="form-control{{ $errors->has('jam_kerja') ? ' is-invalid' : '' }}" name="jam_kerja" required>{{ $loker->jam_kerja }}</textarea> -->

                                    <div class="input-group">
                                        <select class="custom-select" id="jam_kerja" name="jam_kerja">
                                            @for($i = 1; $i <= 24; $i++)
                                                <option value="{{ $i }} jam / hari" @if($loker->jam_kerja == $i.' jam / hari') selected @endif>{{ $i }} jam</option>
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
                                    <!-- <textarea id="gaji" type="text" class="form-control{{ $errors->has('gaji') ? ' is-invalid' : '' }}" name="gaji" required>{{ $loker->gaji }}</textarea> -->

                                    <div class="input-group">
                                        <select class="custom-select" id="gaji" name="gaji">
                                            <option value="Dibawah Rp. 1.000.000 / bulan" @if($loker->gaji === 'Dibawah Rp. 1.000.000 / bulan') selected @endif>Dibawah Rp. 1.000.000</option>
                                            <option value="Antara Rp. 1.000.000 - Rp. 2.000.000 / bulan" @if($loker->gaji === 'Antara Rp. 1.000.000 - Rp. 2.000.000 / bulan') selected @endif>Antara Rp. 1.000.000 - 2.000.000</option>
                                            <option value="Antara Rp. 2.000.000 - Rp. 5.000.000 / bulan" @if($loker->gaji === 'Antara Rp. 2.000.000 - Rp. 5.000.000 / bulan') selected @endif>Antara Rp. 2.000.000 - 5.000.000</option>
                                            <option value="Antara Rp. 5.000.000 - Rp. 10.000.000 / bulan" @if($loker->gaji === 'Antara Rp. 5.000.000 - Rp. 10.000.000 / bulan') selected @endif>Antara Rp. 5.000.000 - 10.000.000</option>
                                            <option value="Diatas Rp. 10.000.000 / bulan" @if($loker->gaji === 'Diatas Rp. 10.000.000 / bulan') selected @endif>Diatas Rp. 10.000.000</option>
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
                                <label for="jadwal_tes" class="col-md-3 col-form-label text-md-right">{{ __('Jadwal Tes*') }}</label>

                                <div class="col-md-8">
                                    <input id="jadwal_tes" type="date" class="form-control{{ $errors->has('jadwal_tes') ? ' is-invalid' : '' }}" name="jadwal_tes" value="{{ $loker->jadwal_tes }}" required>

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
                                    <select class="custom-select" id="waktu_tes_jam" name="waktu_tes_jam" autocomplete="off" required>
                                        <option value="00" @if(substr($loker->waktu_tes, 0, 2) == '00') selected @endif>00</option>
                                        <option value="01" @if(substr($loker->waktu_tes, 0, 2) == '01') selected @endif>01</option>
                                        <option value="02" @if(substr($loker->waktu_tes, 0, 2) == '02') selected @endif>02</option>
                                        <option value="03" @if(substr($loker->waktu_tes, 0, 2) == '03') selected @endif>03</option>
                                        <option value="04" @if(substr($loker->waktu_tes, 0, 2) == '04') selected @endif>04</option>
                                        <option value="05" @if(substr($loker->waktu_tes, 0, 2) == '05') selected @endif>05</option>
                                        <option value="06" @if(substr($loker->waktu_tes, 0, 2) == '06') selected @endif>06</option>
                                        <option value="07" @if(substr($loker->waktu_tes, 0, 2) == '07') selected @endif>07</option>
                                        <option value="08" @if(substr($loker->waktu_tes, 0, 2) == '08') selected @endif>08</option>
                                        <option value="09" @if(substr($loker->waktu_tes, 0, 2) == '09') selected @endif>09</option>
                                        @for($i = 10; $i <= 24; $i++)
                                            <option value="{{ $i }}" @if(substr($loker->waktu_tes, 0, 2) == $i) selected @endif>{{ $i }}</option>
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
                                    <select class="custom-select" id="waktu_tes_menit" name="waktu_tes_menit" autocomplete="off" required>
                                        <option value="00" @if(substr($loker->waktu_tes, 3, 2) == '00') selected @endif>00</option>
                                        <option value="01" @if(substr($loker->waktu_tes, 3, 2) == '01') selected @endif>01</option>
                                        <option value="02" @if(substr($loker->waktu_tes, 3, 2) == '02') selected @endif>02</option>
                                        <option value="03" @if(substr($loker->waktu_tes, 3, 2) == '03') selected @endif>03</option>
                                        <option value="04" @if(substr($loker->waktu_tes, 3, 2) == '04') selected @endif>04</option>
                                        <option value="05" @if(substr($loker->waktu_tes, 3, 2) == '05') selected @endif>05</option>
                                        <option value="06" @if(substr($loker->waktu_tes, 3, 2) == '06') selected @endif>06</option>
                                        <option value="07" @if(substr($loker->waktu_tes, 3, 2) == '07') selected @endif>07</option>
                                        <option value="08" @if(substr($loker->waktu_tes, 3, 2) == '08') selected @endif>08</option>
                                        <option value="09" @if(substr($loker->waktu_tes, 3, 2) == '09') selected @endif>09</option>
                                        @for($i = 10; $i <= 59; $i++)
                                            <option value="{{ $i }}" @if(substr($loker->waktu_tes, 3, 2) == $i) selected @endif>{{ $i }}</option>
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
                                    <input id="tempat_tes" type="text" class="form-control{{ $errors->has('tempat_tes') ? ' is-invalid' : '' }}" name="tempat_tes" value="{{ $loker->tempat_tes }}" placeholder="Aula SMKN 11 Bandung" required>

                                    @if($errors->has('tempat_tes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tempat_tes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status*') }}</label>

                                <div class="col-md-8">
                                    <input type="radio" name="status" id="aktif" value="Aktif" class="ml-3" @if($loker->status === 'Aktif') checked @endif>
                                    <label for="aktif" class="col-form-label text-md-right ml-2">Aktif</label>

                                    <input type="radio" name="status" id="tAktif" value="Tidak Aktif" class="ml-2" @if($loker->status === 'Tidak Aktif') checked @endif>
                                    <label for="tAKtif"  class="col-form-label text-md-right ml-2">Tidak Aktif</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keterangan" class="col-md-3 col-form-label text-md-right">{{ __('Keterangan Lainnya') }}</label>

                                <div class="col-md-8">
                                    <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }} summernote" name="keterangan">{{ $loker->keterangan_loker }}</textarea>

                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('keterangan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="brosur" class="col-md-3 col-form-label text-md-right">{{ __('Brosur') }}</label>

                                <div class="col-md-8">
                                    <img @if($loker->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$loker->brosur) }}" alt="{{ $loker->judul }}" @endif class="img-thumbnail mb-2 imgZoom" id="profile-img-tag" width="220px">

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
                                <i class="fas fa-edit"> </i>{{ __('Ubah Loker') }}
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
