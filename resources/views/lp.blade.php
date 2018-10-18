@extends('layouts.app')

@section('css')
<style>
    .p-absolute {
        position: absolute;
        top: 5%;
        left: 50vw;
    }

    .img-hero {
        width: 100%;
        height: 91.3vh;
    }

    .img-hero-full {
        width: 100%;
        height: 100vh;
    }

    .hero-image {
        position: relative;
    }

    @media only screen and (max-width: 400px) {
        .img-hero {
            height: auto;
        }

        .img-hero-full {
            height: 40vh;
        }
    }

    .hero-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #444;
        background-color: rgba(235, 235, 235, 0.6);
        padding: 10px;
        width: 75%;
    }

    .hero-location {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 75%;
        color: #fff;
    }

    .hero-text h1, .h1-responsive {
        font-size: 8vw;
    }

    .hero-text label, .hero-text button {
        font-size: 3vw;
    }

    .hero-text p, .hero-text input, .p-responsive {
        font-size: 3vw;
    }
</style>
@endsection

@section('lp')
<main class="bg-1">
    <section class="hero-image">
        <img @if($pengaturan->foto1 !== 'nophoto.jpg') src="{{ asset('storage/banner/'.$pengaturan->foto1) }}" alt="{{ $pengaturan->foto1 }}" @else src="{{ asset('assets/images/unsplash1.jpg') }}" alt="banner1" @endif class="img-hero">
        <div class="hero-text">
            {!! $pengaturan->banner1 !!}
        </div>
    </section>
    {{-- <section class="row container-fluid justify-content-center">
        <div class="col-6 p-0 m-0">
            <img src="{{ asset('assets/images/unsplash2.jpg') }}" alt="unsplash" class="img-hero">
        </div>
        <div class="col-6 p-2">
            <div class="box p-3">
                <h1 class="h1-responsive">BKK SMK</h1>
                <p class="p-responsive">Bursa Kerja Khusus SMK adalah sebuah aplikasi yang memudahkan para siswa / calon pegawai untuk mencari lowongan pekerjaan.</p>
            </div>
        </div>
    </section> --}}
    {{-- <section class="relative">
        <img src="{{ asset('assets/images/unsplash3.png') }}" alt="unsplash" class="img-fluid">
        <div class="box hero-text" style="width: 75%;">
            <div class="box-container p-1">
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-0">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@gmail.com" required autofocus>

                        @if($errors->has('email'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" required>

                        @if($errors->has('password'))
                            <small id="passwordHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign-in</button>
                </form>
            </div>
        </div>
    </section> --}}
    <section class="text-center p-3">
        <h1>Features</h1>
        <div class="row justify-content-center m-0">
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-briefcase h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur1 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-user-check h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur2 }}</p>
            </div>
            <div class="col-sm-3 p-3 box m-2">
                <i class="fas fa-search h2"></i>
                <hr>
                <p>{{ $pengaturan->fitur3 }}</p>
            </div>
        </div>
    </section>
    <div class="bg-2 p-3 mt-3">
        <div class="row m-0 p-0">
            <div class="col-md-4 text-center">
                <h4>Lokasi</h4>
                <hr>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.002612100019!2d107.55619391442444!3d-6.8902891950211185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK+11+Bandung!5e0!3m2!1sen!2sid!4v1517989587366" frameborder="0" class="box" style="width:100%"></iframe>
            </div>
            <div class="col-md-4">
                <h4 class="text-center">Kontak</h4>
                <hr>
                <p>{{ $pengaturan->alamat }}</p>
                <p>
                    <b>Telp</b> : {{ $pengaturan->telp }}<br>
                    <b>Fax</b> : {{ $pengaturan->fax }}<br>
                    <b>E-Mail</b> : {{ $pengaturan->email }}
                </p>
            </div>
            <div class="col-md-4">
                <h4 class="text-center">Link</h4>
                <hr>
                <a class="text-white" href="http://www.smkn11bdg.sch.id/"><img class="img-fluid" src="{{ asset('assets/images/smk11.png') }}" alt="Website SMKN 11 Bandung"/></a>
            </div>
        </div>
        <p class="text-center m-0"><i class="small">©Copyright 2018. Yanuar Wanda Putra</i></p>
    </div>
</main>
@endsection

@section('js')
<script type="text/javascript">
    document.getElementById('mainapp').remove();
    // document.getElementById('navbar').remove();
</script>
@endsection
