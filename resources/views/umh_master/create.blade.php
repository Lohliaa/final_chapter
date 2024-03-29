@extends('layouts.main')
@section('layouts.content')

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header">
                        <Center>TAMBAH DATA</Center>
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
                        <form action="{{ route('umh_master.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Line</label>
                                <input type="text" class="form-control @error('car_line') is-invalid @enderror" name="car_line"
                                    value="{{ old('car_line') }}" placeholder=" ">
                                <!-- error message untuk title -->
                                @error('car_line')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Code 10</label>
                                <input type="text" class="form-control @error('code_umh1') is-invalid @enderror"
                                    name="code_umh1" value="{{ old('code_umh1') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('code_umh1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Code 20</label>
                                <input type="text" class="form-control @error('code_umh2') is-invalid @enderror"
                                    name="code_umh2" value="{{ old('code_umh2') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('code_umh2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Code 30</label>
                                <input type="text" class="form-control @error('code_umh3') is-invalid @enderror"
                                    name="code_umh3" value="{{ old('code_umh3') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('code_umh3')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Process 10</label>
                                <input type="text" class="form-control @error('kode_umh1') is-invalid @enderror"
                                    name="kode_umh1" value="{{ old('kode_umh1') }}" placeholder="Silakan isi dengan nilai 0 karena akan menghitung otomatis. ">

                                <!-- error message untuk title -->
                                @error('kode_umh1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Process 20</label>
                                <input type="text" class="form-control @error('kode_umh2') is-invalid @enderror"
                                    name="kode_umh2" value="{{ old('kode_umh2') }}" placeholder="Silakan isi dengan nilai 0 karena akan menghitung otomatis.">

                                <!-- error message untuk title -->
                                @error('kode_umh2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Process 30</label>
                                <input type="text" class="form-control @error('kode_umh3') is-invalid @enderror"
                                    name="kode_umh3" value="{{ old('kode_umh3') }}" placeholder="Silakan isi dengan nilai 0 karena akan menghitung otomatis. ">

                                <!-- error message untuk title -->
                                @error('kode_umh3')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Charge</label>
                                <input type="text" class="form-control @error('charge') is-invalid @enderror"
                                    name="charge" value="{{ old('charge') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('charge')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('umh_master.index') }}"
                                class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection