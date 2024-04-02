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
                        <form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Factory</label>
                                <input type="text" class="form-control @error('factory') is-invalid @enderror"
                                    name="factory" value="{{ old('factory') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('factory')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" value="{{ old('code') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('code')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Area</label>
                                <input type="text" class="form-control @error('area') is-invalid @enderror" name="area"
                                    value="{{ old('area') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('area')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Hole</label>
                                <input type="text" class="form-control @error('hole') is-invalid @enderror"
                                    name="hole" value="{{ old('hole') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('hole')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Component Number</label>
                                <input type="text" class="form-control @error('component_number') is-invalid @enderror"
                                    name="component_number" value="{{ old('component_number') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('component_number')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Component Name</label>
                                <input type="text" class="form-control @error('component_name') is-invalid @enderror"
                                    name="component_name" value="{{ old('component_name') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('component_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">QTY Total</label>
                                <input type="text" class="form-control @error('qty_total') is-invalid @enderror"
                                    name="qty_total" value="{{ old('qty_total') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('qty_total')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('material.index') }}"
                                class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection