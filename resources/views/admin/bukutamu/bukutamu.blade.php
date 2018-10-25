@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.adminmenu')
        <section class="col-md-9" id="bukutamu">
            <div class="card">
                <div class="card-header h3 text-center">Daftar Buku Tamu</div>
                <div class="card-body">
                    <table id="tabel" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Pengirim</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukutamu as $bt)
                                <tr>
                                    <td>{{ $bt->nama_pengirim }}</td>
                                    <td>{{ $bt->judul_pesan }}</td>
                                    <td>{{ $bt->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/bukutamu', base64_encode($bt->id_buku_tamu)) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                        <a href="{{ url('admin/bukutamu/delete', base64_encode($bt->id_buku_tamu)) }}" class="btn btn-danger deleteButton"><i class="far fa-trash-alt"></i></a>
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
    $('.adminmenu_bukutamu').addClass('active');
    $(document).ready(function () {
        $('#tabel').DataTable({
            responsive: true,
        });
    });
</script>
@endsection
