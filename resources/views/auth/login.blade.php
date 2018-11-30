@extends('layouts.app')

@section('title')
    Login -
@endsection

@section('css')
<style>
    @media only screen and (max-width: 768px) {
        #photo {
            display: none;
        }
    }
    .img-full {
        height: 100%;
        width: 100%;
    }
</style>
@endsection

@section('content')
<section id="content" class="container">
    <div class="row justify-content-center">
        <div class="box row col-10 p-0">
            <div class="col-md-5 col-sm-12 p-0 m-0" id="photo">
                <img src="{{ asset('assets/images/login.jpg') }}" class="img-full">
            </div>
            <div class="box-container float-right col-md-7 col-sm-12 bg-2">
                <h1 class="text-center"> Login </h1>
                <hr>
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
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
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
    $('#login').addClass('active');
</script>
@endsection
