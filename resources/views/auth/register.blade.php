@extends('layouts.app')

@section('title')
    Daftar -
@endsection

@section('content')
<section id="content" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card box btn-square">
                <div class="card-header row m-0 p-0">
                    <a href="#perusahaan" id="perusahaan-btn" class="col-6 tab text-center active" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="perusahaan">
                        Perusahaan
                    </a>
                    <a href="#cp" id="cp-btn" class="col-6 tab text-center" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="cp">
                        Calon Pegawai
                    </a>
                </div>

                <div class="card-body collapse show p-0 pt-3" id="perusahaan">
                    <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control{{ $errors->has('nama_perusahaan') ? ' is-invalid' : '' }}" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="Digital Kolam" required autofocus>

                            @if($errors->has('nama_perusahaan'))
                                <small id="namaPerusahaanHelp" class="form-text text-danger">{{ $errors->first('nama_perusahaan') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="087825418390" required>

                            @if($errors->has('no_hp'))
                                <small id="noHPHelp" class="form-text text-danger">{{ $errors->first('no_hp') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="noSurat">No Surat MoU (Naskah Kerjasama)</label>
                            <input type="text" name="noSurat" id="noSurat" class="form-control{{ $errors->first('noSurat') }}" value="{{ old('noSurat')}}" placeholder="019/VII/OS/2016" required>

                            @if($errors->has('noSurat'))
                                <small id="noSuratHelp" class="form-text text-danger">{{ $errors->first('noSurat') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="suratKerjasama">File Surat MoU (Naskah Kerjasama)</label>
                            <div id="realUpload" style="display: none">
                                <input id="suratKerjasama" type="file" class="form-control{{ $errors->has('suratKerjasama') ? ' is-invalid' : '' }}" name="suratKerjasama" required />
                            </div>
                            <button class="btn btn-primary btn-block" type="button" id="fakeUpload" data-link="{{ url('google') }}">Upload</button>

                            @if($errors->has('suratKerjasama'))
                                <small id="suratKerjasamaHelp" class="form-text text-danger">{{ $errors->first('suratKerjasama') }}</small>
                            @endif
                        </div>

                        <hr>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="email">Alamat Email</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" placeholder="contoh.email@gmail.com" required autofocus>

                            @if($errors->has('email'))
                                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="username">Username</label>
                            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" value="{{ old('username') }}" placeholder="yanuarwanda" required autofocus>

                            @if($errors->has('username'))
                                <small id="usernameHelp" class="form-text text-danger">{{ $errors->first('username') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="password">Password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" value="{{ old('password') }}" required autofocus>

                            @if($errors->has('password'))
                                <small id="passwordHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus>

                            @if($errors->has('password_confirmation'))
                                <small id="passwordConfirmationHelp" class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-square">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>

                <div class="card-body collapse p-0 pt-3" id="cp">
                    <form method="POST" action="{{ url('registerCP') }}" >
                        {{ csrf_field() }}

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control{{ $errors->has('nis') ? ' is-invalid' : '' }}" name="nis" id="nis" value="{{ old('nis') }}" placeholder="1502011462" required autofocus>

                            @if($errors->has('nis'))
                                <small id="namaPerusahaanHelp" class="form-text text-danger">{{ $errors->first('nis') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Yanuar Wanda Putra" required autofocus>

                            @if($errors->has('nama'))
                                <small id="namaPerusahaanHelp" class="form-text text-danger">{{ $errors->first('nama') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                            <br>
                            <div class="{{ $errors->has('jk') ? 'border border-danger p-1' : '' }}">
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

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="alumni">Alumni</label>
                            <br>
                            <div class="{{ $errors->has('alumni') ? 'border border-danger p-1' : '' }}">
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

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="no_hp_cp">No HP</label>
                            <input type="text" class="form-control{{ $errors->has('no_hp_cp') ? ' is-invalid' : '' }}" name="no_hp_cp" id="no_hp_cp" value="{{ old('no_hp_cp') }}" placeholder="087825418390" required autofocus>

                            @if($errors->has('no_hp_cp'))
                                <small id="noHPCPHelp" class="form-text text-danger">{{ $errors->first('no_hp_cp') }}</small>
                            @endif
                        </div>

                        <hr>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="emailCP">Alamat Email</label>
                            <input type="email" class="form-control{{ $errors->has('emailCP') ? ' is-invalid' : '' }}" name="emailCP" id="emailCP" value="{{ old('emailCP') }}" placeholder="contoh.email@gmail.com" required autofocus>

                            @if($errors->has('emailCP'))
                                <small id="emailCPHelp" class="form-text text-danger">{{ $errors->first('emailCP') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="usernameCP">Username</label>
                            <input type="text" class="form-control{{ $errors->has('usernameCP') ? ' is-invalid' : '' }}" name="usernameCP" id="usernameCP" value="{{ old('usernameCP') }}" placeholder="yanuarwanda" required autofocus>

                            @if($errors->has('usernameCP'))
                                <small id="usernameCPHelp" class="form-text text-danger">{{ $errors->first('usernameCP') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="passwordCP">Password</label>
                            <input type="password" class="form-control{{ $errors->has('passwordCP') ? ' is-invalid' : '' }}" name="passwordCP" id="passwordCP" value="{{ old('passwordCP') }}" required autofocus>

                            @if($errors->has('passwordCP'))
                                <small id="passwordCPHelp" class="form-text text-danger">{{ $errors->first('passwordCP') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-md-10 offset-md-1">
                            <label for="passwordCP_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control{{ $errors->has('passwordCP_confirmation') ? ' is-invalid' : '' }}" name="passwordCP_confirmation" id="passwordCP_confirmation" value="{{ old('passwordCP_confirmation') }}" required autofocus>

                            @if($errors->has('passwordCP_confirmation'))
                                <small id="passwordCPConfirmHelp" class="form-text text-danger">{{ $errors->first('passwordCP_confirmation') }}</small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-square">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
    $('#daftar').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-popupGD.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-registerToggle.js') }}"></script>
@endsection
