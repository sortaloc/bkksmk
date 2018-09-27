@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">Daftar Calon Pegawai <a href="{{ url('admin/cp/add') }}" class="float-right">Tambah Data Calon Pegawai</a></div>
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
                                        <a href="{{ url('admin/cp/edit', base64_encode($c->nis)) }}" class="btn btn-primary"> Detail </a>
                                        <a href="{{ url('admin/cp', base64_encode($c->nis)) }}" class="btn btn-danger deleteButton"> Hapus </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready( function () {
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
