@extends('layouts.app')

@section('title')
    Edit Alumni -
@endsection

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card box btn-squre">
                <div class="card-header text-center h3">
                    <a href="{{ url('admin/alumni') }}" class="backButton float-left"><i class="fas fa-arrow-left"></i></a>
                    Form Edit Alumni
                </div>
                <div class="card-body p-0">
                    <form action="{{ url('admin/alumni/edit', base64_encode($alumni->nis)) }}" method="post">
                        <div class="p-3">
                            @csrf

                            <div class="form-group row">
                                <label for="nis" class="col-md-3 col-form-label text-md-right">NIS</label>

                                <div class="col-md-8">
                                    <input id="nis" type="text" class="form-control{{ $errors->has('nis') ? ' is-invalid' : '' }}" name="nis" value="{{ $alumni->nis }}" readonly/>

                                    @if ($errors->has('nis'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nis') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-md-3 col-form-label text-md-right">Nama</label>

                                <div class="col-md-8">
                                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $alumni->nama }}" required />

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="angkatan" class="col-md-3 col-form-label text-md-right">Tahun Angkatan Lulus</label>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-4">
                                            <select class="custom-select" id="angkatanAwal" name="angkatanAwal" >
                                                @for($i = 2000; $i <= (int)date('Y'); $i++)
                                                    <option value="{{ $i }}" @if(substr($alumni->angkatan, 0, 4) == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <span style="font-size: 24px;">/</span>
                                        <div class="col-4">
                                            {{-- <select class="custom-select" id="angkatanAkhir" name="angkatanAkhir">
                                                @for($i = 2000; $i <= (int)date('Y'); $i++)
                                                    <option value="{{ $i }}" @if(substr($alumni->angkatan, 7, 11) == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select> --}}
                                            <input type="text" class="form-control" name="angkatanAkhir" id="angkatanAkhir" value="{{ substr($alumni->angkatan, 7, 11) }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-0 p-0">
                            <button type="submit" class="btn btn-primary btn-block btn-square">
                                <i class="fas fa-edit"></i> Ubah Alumni
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#angkatanAwal').on('change', function(){
        $('#angkatanAkhir').attr('value', parseInt($(this).val()) + 1);
    });
</script>
@endsection
