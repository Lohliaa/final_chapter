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

                        <form action="{{ route('properti_single.update', $properti_single->id ) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Material</label>
                                <input type="text" class="form-control @error('material_properties') is-invalid @enderror"
                                    name="material_properties" value="{{ $properti_single->material_properties }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('material_properties')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Model</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                    value="{{ $properti_single->model }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('model')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Ukuran</label>
                                <input type="text" class="form-control @error('ukuran') is-invalid @enderror" name="ukuran"
                                    value="{{ $properti_single->ukuran }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('ukuran')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                    name="warna" value="{{ $properti_single->warna }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('warna')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">CL</label>
                                <input type="text" class="form-control @error('cl') is-invalid @enderror"
                                    name="cl" value="{{ $properti_single->cl }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cl')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TRM B</label>
                                <input type="text" class="form-control @error('trm_b') is-invalid @enderror"
                                    name="trm_b" value="{{ $properti_single->trm_b }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('trm_b')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc bag b1</label>
                                <input type="text" class="form-control @error('acc_bag_b1') is-invalid @enderror" name="acc_bag_b1"
                                    value="{{ $properti_single->acc_bag_b1 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_bag_b1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc bag b2</label>
                                <input type="text" class="form-control @error('acc_bag_b2') is-invalid @enderror"
                                    name="acc_bag_b2" value="{{ $properti_single->acc_bag_b2 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_bag_b2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TBE B</label>
                                <input type="text" class="form-control @error('tbe_b') is-invalid @enderror"
                                    name="tbe_b" value="{{ $properti_single->tbe_b }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tbe_b')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TRM A</label>
                                <input type="text" class="form-control @error('trm_a') is-invalid @enderror"
                                    name="trm_a" value="{{ $properti_single->trm_a }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('trm_a')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc bag a1</label>
                                <input type="text" class="form-control @error('acc_bag_a1') is-invalid @enderror"
                                    name="acc_bag_a1" value="{{ $properti_single->acc_bag_a1 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_bag_a1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc bag a2</label>
                                <input type="text" class="form-control @error('acc_bag_a2') is-invalid @enderror"
                                    name="acc_bag_a2" value="{{ $properti_single->acc_bag_a2 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_bag_a2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TBE A</label>
                                <input type="text" class="form-control @error('tbe_a') is-invalid @enderror"
                                    name="tbe_a" value="{{ $properti_single->tbe_a }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tbe_a')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('properti_single.index') }}" class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection