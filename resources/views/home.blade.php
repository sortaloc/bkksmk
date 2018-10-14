@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @if(Auth::user()->id_status === 1)
                @include('admin.home')
            @endif

            @if(Auth::user()->id_status === 2)
                @include('perusahaan.home')
            @endif

            @if(Auth::user()->id_status === 3)
                @include('cp.home')
            @endif
        </div>
    </div>
</div>
@endsection
