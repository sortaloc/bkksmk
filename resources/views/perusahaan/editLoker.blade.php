@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Ubah Lowongan Kerja</div>

                <div class="card-body p-0">
                    <form method="POST" action="{{ url('perusahaan/loker/edit', base64_encode($loker->id_loker)) }}" enctype="multipart/form-data">
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
                                <label for="persyaratan" class="col-md-3 col-form-label text-md-right">{{ __('Persyaratan*') }}</label>

                                <div class="col-md-8">
                                    <textarea id="persyaratan" type="text" class="form-control{{ $errors->has('persyaratan') ? ' is-invalid' : '' }}" name="persyaratan" required>{{ $loker->persyaratan }}</textarea>

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
                                    <textarea id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" required>{{ $loker->keterangan_loker }}</textarea>

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
                                    <img @if($loker->brosur === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/brosur/'.$loker->brosur) }}" alt="{{ $loker->judul }}" @endif class="img-thumbnail mb-2" id="profile-img-tag" width="220px">

                                    <input id="brosur" type="file" class="form-control{{ $errors->has('brosur') ? ' is-invalid' : '' }}" name="brosur">

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
                                {{ __('Ubah Loker') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
