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
    <a href="{{ url('admin/perusahaan/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
    <div class="row">
        @include('layouts.adminmenu')
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
<script type="text/javascript">
    $('.adminmenu_perusahaan').addClass('active');
    $(document).ready( function () {
        $('#tabel').DataTable({
            responsive: true,
            "columns": [
                null, null, null, { "width": "20%"}
            ]
        });
    });
</script>
@endsection
