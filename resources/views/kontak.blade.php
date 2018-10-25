@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center h3">Kontak</div>
        <div class="card-body">
            <section class="row" id="kontakSection">
                <div class="col-md-6">
                    <h4>Alamat</h4>
                    <p>{{ $pengaturan->alamat }}</p>
                    <h4>No Telepon</h4>
                    <p>{{ $pengaturan->telp}}</p>
                </div>
                <div class="col-md-6">
                    <h4>Fax</h4>
                    <p>{{ $pengaturan->fax }}</p>
                    <h4>E-Mail</h4>
                    <p>{{ $pengaturan->email }}</p>
                </div>
            </section>
            <hr>
            <section id="feedbackSection">
                <h3 class="text-center">Kirim pesan, kritik atau saran disini!</h3>
                <form method="post" action="{{ url('/kontak') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nama_pengirim" class="col-md-3 col-form-label text-md-right">{{ __('Nama*') }}</label>

                        <div class="col-md-7">
                            <input id="nama_pengirim" type="text" class="form-control{{ $errors->has('nama_pengirim') ? ' is-invalid' : '' }}" name="nama_pengirim" value="{{ old('nama_pengirim') }}" required>

                            @if ($errors->has('nama_pengirim'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_pengirim') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="asal_pengirim" class="col-md-3 col-form-label text-md-right">{{ __('Asal*') }}</label>

                        <div class="col-md-7">
                            <input id="asal_pengirim" type="text" class="form-control{{ $errors->has('asal_pengirim') ? ' is-invalid' : '' }}" name="asal_pengirim" value="{{ old('asal_pengirim') }}" required>

                            @if ($errors->has('asal_pengirim'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('asal_pengirim') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email_pengirim" class="col-md-3 col-form-label text-md-right">{{ __('Email*') }}</label>

                        <div class="col-md-7">
                            <input id="email_pengirim" type="email" class="form-control{{ $errors->has('email_pengirim') ? ' is-invalid' : '' }}" name="email_pengirim" value="{{ old('email_pengirim') }}" required>

                            @if ($errors->has('email_pengirim'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_pengirim') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul_pesan" class="col-md-3 col-form-label text-md-right">{{ __('Judul*') }}</label>

                        <div class="col-md-7">
                            <input id="judul_pesan" type="text" class="form-control{{ $errors->has('judul_pesan') ? ' is-invalid' : '' }}" name="judul_pesan" value="{{ old('judul_pesan') }}" required>

                            @if ($errors->has('judul_pesan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('judul_pesan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isi_pesan" class="col-md-3 col-form-label text-md-right">{{ __('Isi Pesan*') }}</label>

                        <div class="col-md-7">
                            <textarea id="isi_pesan" type="text" class="form-control{{ $errors->has('isi_pesan') ? ' is-invalid' : '' }}" name="isi_pesan" required>{{ $pengaturan->isi_pesan }}</textarea>

                            @if ($errors->has('isi_pesan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('isi_pesan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-md-3 col-md-7 ">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-paper-plane"></i> {{ __('Kirim Pesan') }}
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#kontak').addClass('active');
</script>
@endsection
