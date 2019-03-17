@extends('layouts.app')

@section('title')
    Perusahaan -
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}">
<style>
    #tableSwitcher {
        width: 100%;
        background-color: transparent;
        display: flex;
    }
    #tableSwitcher > button {
        background-color: transparent;
        border: 0;
        border-bottom: 3px solid #d8d8d8;
        margin: 0;
        padding: 1rem;
        cursor: pointer;
        transition: 0.5s ease-in-out;
        width: 50%;
    }
    #tableSwitcher > button.active {
        background-color: #d8d8d8;
    }
    #tableSwitcher > button:hover {
        background-color: #e9e9e9;
        transition: 0.5s ease-in-out;
    }
    #tabelVerified_wrapper, #tabelUnverified_wrapper {
        border: 3px solid #d8d8d8;
        border-top: 0;
        padding: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <a href="{{ url('admin/perusahaan/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
    <div class="row">
        @include('layouts.adminmenu')
        <section class="col-lg-9">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Perusahaan</div>
                <div class="card-body">
                    <div id="tableSwitcher">
                        <button id="verified" class="active">Sudah Terverifikasi</button>
                        <button id="unverified">Belum Terverifikasi</button>
                    </div>
                    <table id="tabelVerified" class="table table-striped table-bordered active" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perusahaanVerified as $p)
                                <tr>
                                    <td>
                                        <img
                                            @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto"
                                            @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}"
                                            @endif
                                        class="img-fluid img-thumbnail imgZoom imgDT"/>
                                    </td>
                                    <td>
                                        {{ $p->nama }}
                                    </td>
                                    <td>
                                        {{ $p->alamat }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/perusahaan/edit', base64_encode($p->id_perusahaan)) }}" class="btn btn-primary"><i class="fas fa-edit"></i> </a>
                                        <a href="{{ url('admin/perusahaan', base64_encode($p->id_perusahaan)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table id="tabelUnverified" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perusahaanUnverified as $p)
                                <tr>
                                    <td>
                                        <img
                                            @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto"
                                            @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}"
                                            @endif
                                        class="img-fluid img-thumbnail imgZoom imgDT"/>
                                    </td>
                                    <td>
                                        {{ $p->nama }}
                                    </td>
                                    <td>
                                        {{ $p->alamat }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/perusahaan/edit', base64_encode($p->id_perusahaan)) }}" class="btn btn-primary"><i class="fas fa-edit"></i> </a>
                                        <a href="{{ url('admin/perusahaan', base64_encode($p->id_perusahaan)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
@include('layouts.modalGambar')
<script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
<script type="text/javascript">
    $('.adminmenu_perusahaan').addClass('active');
    $('#verified').on('click', function(){
        $(this).addClass('active');
        $('#unverified').removeClass('active');

        $('#tabelVerified_wrapper').attr('style', 'width:100%;display:table');
        $('#tabelUnverified_wrapper').attr('style', 'width:100%;display:none');
    });
    $('#unverified').on('click', function(){
        $(this).addClass('active');
        $('#verified').removeClass('active');

        $('#tabelUnverified_wrapper').attr('style', 'width:100%;display:table');
        $('#tabelVerified_wrapper').attr('style', 'width:100%;display:none');
    });
    $(document).ready( function () {
        $('#tabelVerified').DataTable({
            responsive: true,
            "columns": [
                null, null, null, { "width": "20%"}
            ]
        });
        $('#tabelUnverified').DataTable({
            responsive: true,
            "columns": [
                null, null, null, { "width": "20%"}
            ]
        });
        $('#tabelUnverified_wrapper').attr('style', 'width:100%;display:none');
    });
</script>
@endsection
