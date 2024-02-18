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

                        <form action="{{ route('material.update', $material->id ) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Factory</label>
                                <input type="text" class="form-control @error('factory') is-invalid @enderror"
                                    name="factory" value="{{ $material->factory }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('factory')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Carcode</label>
                                <input type="text" class="form-control @error('carcode') is-invalid @enderror"
                                    name="carcode" value="{{ $material->carcode }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('carcode')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Area</label>
                                <input type="text" class="form-control @error('area') is-invalid @enderror" name="area"
                                    value="{{ $material->area }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('area')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Cavity</label>
                                <input type="text" class="form-control @error('cavity') is-invalid @enderror"
                                    name="cavity" value="{{ $material->cavity }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cavity')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Partnumber</label>
                                <input type="text" class="form-control @error('partnumber') is-invalid @enderror"
                                    name="partnumber" value="{{ $material->partnumber }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('partnumber')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Part Name</label>
                                <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                                    name="part_name" value="{{ $material->part_name }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('part_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">QTY Total</label>
                                <input type="text" class="form-control @error('qty_total') is-invalid @enderror"
                                    name="qty_total" value="{{ $material->qty_total }}" placeholder=" ">

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