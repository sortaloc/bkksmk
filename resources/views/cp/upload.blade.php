@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card box btn-square">
        <div class="card-header text-center h3">Tutorial Mengambil Link Google Drive</div>
        <div class="card-body">
            <ol class="h2">
                <li class="mb-3">
                    Buka drive.google.com
                    <img src="{{ asset('assets/images/tutorial/1.png') }}" alt="Buka drive.google.com" class="img-fluid"/>
                </li>
                <li class="mb-3">
                    Cari file yang akan digunakan
                    <img src="{{ asset('assets/images/tutorial/2.png') }}" alt="Cari file yang akan digunakan" class="img-fluid">
                </li>
                <li class="mb-3">
                    Klik kanan file tersebut lalu klik "Get shareable link"
                    <img src="{{ asset('assets/images/tutorial/3.png') }}" alt="Klik kanan file tersebut lalu klik 'Get shareable link'" class="img-fluid">
                </li>
                <li class="mb-3">
                    Copykan linknya
                    <img src="{{ asset('assets/images/tutorial/4.png') }}" alt="Copy link nya" class="img-fluid">
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection
