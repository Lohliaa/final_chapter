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
                                <label class="font-weight-bold">Part No</label>
                                <input type="text" class="form-control @error('part_no') is-invalid @enderror"
                                    name="part_no" value="{{ $database_konversi->part_no }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('part_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Buppin</label>
                                <input type="text" class="form-control @error('buppin') is-invalid @enderror" name="buppin"
                                    value="{{ $database_konversi->buppin }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('buppin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Part Name</label>
                                <input type="text" class="form-control @error('part_name') is-invalid @enderror" name="part_name"
                                    value="{{ $database_konversi->part_name }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('part_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">UOM</label>
                                <input type="text" class="form-control @error('uom') is-invalid @enderror"
                                    name="uom" value="{{ $database_konversi->uom }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('uom')
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