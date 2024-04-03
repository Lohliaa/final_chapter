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
                        <form action="{{ route('area_final.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Kav</label>
                                <input type="text" class="form-control @error('kav') is-invalid @enderror" name="kav"
                                    value="{{ old('kav') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('kav')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bagian</label>
                                <input type="text" class="form-control @error('bagian') is-invalid @enderror" name="bagian"
                                    value="{{ old('bagian') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('bagian')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Area Store</label>
                                <input type="text" class="form-control @error('area_store') is-invalid @enderror"
                                    name="area_store" value="{{ old('area_store') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('area_store')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Material</label>
                                <input type="text" class="form-control @error('material') is-invalid @enderror" name="material"
                                    value="{{ old('material') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('material')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                    name="warna" value="{{ old('warna') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('warna')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Qty Board</label>
                                <input type="text" class="form-control @error('qty_board') is-invalid @enderror"
                                    name="qty_board" value="{{ old('qty_board') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('qty_board')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Publish</label>
                                <input type="text" class="form-control @error('publish') is-invalid @enderror"
                                    name="publish" value="{{ old('publish') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('publish')
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
                                <label class="font-weight-bold">Plank</label>
                                <input type="text" class="form-control @error('plank') is-invalid @enderror" name="plank"
                                    value="{{ old('plank') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('plank')
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
                                <input type="text" class="form-control @error('factory') is-invalid @enderror" name="factory"
                                    value="{{ old('factory') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('factory')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('area_final.index') }}"
                                class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection