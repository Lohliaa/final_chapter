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
                        <form action="{{ route('data-pa-841w.store') }}" method="POST" enctype="multipart/form-data">

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
                                <label class="font-weight-bold">Bagian</label>
                                <input type="text" class="form-control @error('conveyor') is-invalid @enderror" name="conveyor"
                                    value="{{ old('conveyor') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('conveyor')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Area Store</label>
                                <input type="text" class="form-control @error('addressing_store') is-invalid @enderror"
                                    name="addressing_store" value="{{ old('addressing_store') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('addressing_store')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Material</label>
                                <input type="text" class="form-control @error('ctrl_no') is-invalid @enderror" name="ctrl_no"
                                    value="{{ old('ctrl_no') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('ctrl_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Warna</label>
                                <input type="text" class="form-control @error('colour') is-invalid @enderror"
                                    name="colour" value="{{ old('colour') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('colour')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">QTY Board</label>
                                <input type="text" class="form-control @error('qty_kbn') is-invalid @enderror"
                                    name="qty_kbn" value="{{ old('qty_kbn') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('qty_kbn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Issue</label>
                                <input type="text" class="form-control @error('issue') is-invalid @enderror"
                                    name="issue" value="{{ old('issue') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('issue')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Total QTY</label>
                                <input type="text" class="form-control @error('total_qty') is-invalid @enderror"
                                    name="total_qty" value="{{ old('total_qty') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('total_qty')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Housing</label>
                                <input type="text" class="form-control @error('housing') is-invalid @enderror" name="housing"
                                    value="{{ old('housing') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('housing')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Month</label>
                                <input type="text" class="form-control @error('month') is-invalid @enderror" name="month"
                                    value="{{ old('month') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('month')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Year</label>
                                <input type="text" class="form-control @error('year') is-invalid @enderror" name="year"
                                    value="{{ old('year') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('year')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Factory</label>
                                <input type="text" class="form-control @error('sai') is-invalid @enderror" name="sai"
                                    value="{{ old('sai') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('sai')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('data-pa-841w.index') }}"
                                class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection