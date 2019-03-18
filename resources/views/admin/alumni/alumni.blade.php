@extends('layouts.app')

@section('title')
    Alumni -
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.adminmenu')
        <a href="{{ url('admin/alumni/add') }}" class="tambah h2 btn btn-primary"><i class="fas fa-plus"></i></a>
        <section class="col-md-9" id="alumni">
            <div class="card">
                    <div class="card-header h3 text-center">Daftar Alumni</div>
                    <div class="card-body">
                        <table id="tabel" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Angkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumni as $a)
                                    <tr>
                                        <td>{{ $a->nis }}</td>
                                        <td>{{ $a->nama }}</td>
                                        <td>{{ $a->angkatan }}</td>
                                        <td>
                                            <a href="{{ url('admin/alumni/edit', base64_encode($a->nis)) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                            <a href="{{ url('admin/alumni', base64_encode($a->nis)) }}" class="btn btn-danger deleteButton"><i class="far fa-trash-alt"></i></a>
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
<script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
<script type="text/javascript">
    $('.adminmenu_alumni').addClass('active');
    $(document).ready(function () {
        $('#tabel').DataTable({
            responsive: true,
        });
    });
</script>
@endsection
