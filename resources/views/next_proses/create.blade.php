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
                        <form action="{{ route('next_proses.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Carline</label>
                                <input type="text" class="form-control @error('carline') is-invalid @enderror"
                                    name="carline" value="{{ old('carline') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('carline')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Type</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" name="type"
                                    value="{{ old('type') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('type')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis</label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" value="{{ old('jenis') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('jenis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Ctrl NO</label>
                                <input type="text" class="form-control @error('ctrl_no') is-invalid @enderror"
                                    name="ctrl_no" value="{{ old('ctrl_no') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('ctrl_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Ctrl NO</label>
                                <input type="text" class="form-control @error('jenis_ctrl_no') is-invalid @enderror"
                                    name="jenis_ctrl_no" value="{{ old('jenis_ctrl_no') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('jenis_ctrl_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Ctrl No Circuit</label>
                                <input type="text" class="form-control @error('ctrl_no_cct') is-invalid @enderror"
                                    name="ctrl_no_cct" value="{{ old('ctrl_no_cct') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('ctrl_no_cct')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kind</label>
                                <input type="text" class="form-control @error('kind') is-invalid @enderror" name="kind"
                                    value="{{ old('kind') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('kind')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Size</label>
                                <input type="text" class="form-control @error('size') is-invalid @enderror" name="size"
                                    value="{{ old('size') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('size')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">COLOR</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror"
                                    name="color" value="{{ old('color') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('color')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kind Size Color</label>
                                <input type="text" class="form-control @error('kind_size_color') is-invalid @enderror"
                                    name="kind_size_color" value="{{ old('kind_size_color') }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('kind_size_color')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Cust Part No</label>
                                <input type="text" class="form-control @error('cust_part_no') is-invalid @enderror"
                                    name="cust_part_no" value="{{ old('cust_part_no') }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cust_part_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Cl</label>
                                <input type="text" class="form-control @error('cl') is-invalid @enderror" name="cl"
                                    value="{{ old('cl') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cl')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Term b</label>
                                <input type="text" class="form-control @error('term_b') is-invalid @enderror"
                                    name="term_b" value="{{ old('term_b') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('term_b')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Accb 1</label>
                                <input type="text" class="form-control @error('accb1') is-invalid @enderror"
                                    name="accb1" value="{{ old('accb1') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('accb1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Accb 2</label>
                                <input type="text" class="form-control @error('accb2') is-invalid @enderror"
                                    name="accb2" value="{{ old('accb2') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('accb2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tubeb</label>
                                <input type="text" class="form-control @error('tubeb') is-invalid @enderror"
                                    name="tubeb" value="{{ old('tubeb') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tubeb')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Term a</label>
                                <input type="text" class="form-control @error('term_a') is-invalid @enderror"
                                    name="term_a" value="{{ old('term_a') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('term_a')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acca 1</label>
                                <input type="text" class="form-control @error('acca1') is-invalid @enderror"
                                    name="acca1" value="{{ old('acca1') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acca1')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acca 2</label>
                                <input type="text" class="form-control @error('acca2') is-invalid @enderror"
                                    name="acca2" value="{{ old('acca2') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acca2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tube a</label>
                                <input type="text" class="form-control @error('tubea') is-invalid @enderror"
                                    name="tubea" value="{{ old('tubea') }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tubea')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('next_proses.index') }}"
                                class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection