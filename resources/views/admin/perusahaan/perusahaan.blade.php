@extends('layouts.app')

@section('css')
<style type="text/css">
    .tambah {
        position: absolute;
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
    <a href="{{ url('admin/perusahaan/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
    <div class="row">
        <section class="col-md-3 mb-2" id="menu">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">Menu</div>
                <div class="card-body">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-block btn-square">Beranda</a>
                    <a href="{{ url('admin/loker') }}" class="btn btn-primary btn-block btn-square">Daftar Lowongan Kerja</a>
                    <a href="{{ url('admin/cp') }}" class="btn btn-primary btn-block btn-square">Daftar Calon Pegawai</a>
                </div>
            </div>
        </section>
        <section class="col-md-9">
            <div class="card box btn-square">
                <div class="card-header h3 text-center">Daftar Perusahaan</div>
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
        </section>
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
