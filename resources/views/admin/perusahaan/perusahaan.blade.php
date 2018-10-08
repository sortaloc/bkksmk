@extends('layouts.app')

@section('css')
<style type="text/css">

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card box btn-square">
                <div class="card-header h3">Daftar Perusahaan <a href="{{ url('admin/perusahaan/add') }}" class="float-right"> Tambah Data Perusahaan </a></div>
                <div class="card-body">
                    <table id="tabel" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perusahaan as $p)
                                <tr>
                                    <td>
                                        <img
                                            @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto"
                                            @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}"
                                            @endif
                                        class="img-fluid img-thumbnail"/>
                                    </td>
                                    <td>
                                        {{ $p->nama }}
                                    </td>
                                    <td>
                                        {{ $p->alamat }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/perusahaan/edit', base64_encode($p->id_perusahaan)) }}" class="btn btn-primary"> Detail </a> |
                                        <a href="{{ url('admin/perusahaan', base64_encode($p->id_perusahaan)) }}" class="btn btn-danger deleteButton"> Hapus </a>
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
                null, null, null
            ]
        });
    });
</script>
@endsection
