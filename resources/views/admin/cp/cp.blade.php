@extends('layouts.app')

@section('css')
<style type="text/css">
    .tambah {
        position: fixed;
        z-index: 999;
        bottom: 0;
        right: 15px;
    }
    .tambah:hover{
        background-color: black;
        color: white;
        transition: 0.5s;
    }
</style>
@endsection

@section('content')
<div class="container">
    <a href="{{ url('admin/cp/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
    <div class="row">
        @include('layouts.adminmenu')
        <section class="col-md-9">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Calon Pegawai</div>
                <div class="card-body">
                    <table id="tabel" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cp as $c)
                                <tr>
                                    <td>
                                        <img
                                            @if($c->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto"
                                            @else src="{{ asset('storage/fotoCP/'.$c->foto) }}" alt="{{ $c->nama }}"
                                            @endif
                                        class="img-fluid img-thumbnail"/>
                                    </td>
                                    <td> {{ $c->nama }} </td>
                                    <td> {{ $c->nis }} </td>
                                    <td> @if($c->jenis_kelamin === 'L') Laki-laki @else Perempuan @endif </td>
                                    <td>
                                        <a href="{{ url('admin/cp/edit', base64_encode($c->nis)) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ url('admin/cp', base64_encode($c->nis)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
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
<script type="text/javascript">
    $('.adminmenu_cp').addClass('active');
    $(document).ready(function () {
        $('#tabel').DataTable({
            responsive: true,
            "columns": [
                { "width": "20%" },
                null, null, null, null
            ]
        });
    });
</script>
@endsection
