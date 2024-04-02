@extends('layouts.main')
@section('layouts.content')
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header">
                        <Center>EDIT DATA</Center>
                    </div>    
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your
                            input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('database_konversi.update', $database_konversi->id ) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Komponen</label>
                                <input type="text" class="form-control @error('nomor_komponen') is-invalid @enderror"
                                    name="nomor_komponen" value="{{ $database_konversi->nomor_komponen }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('nomor_komponen')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Item</label>
                                <input type="text" class="form-control @error('item') is-invalid @enderror" name="item"
                                    value="{{ $database_konversi->item }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('item')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Komponen</label>
                                <input type="text" class="form-control @error('nama_komponen') is-invalid @enderror" name="nama_komponen"
                                    value="{{ $database_konversi->nama_komponen }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('nama_komponen')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                    name="satuan" value="{{ $database_konversi->satuan }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('satuan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Inner Packing</label>
                                <input type="text" class="form-control @error('inner_packing') is-invalid @enderror" name="inner_packing"
                                    value="{{ $database_konversi->inner_packing }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('inner_packing')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                       
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('database_konversi.index') }}" class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection