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

                        <form action="{{ route('konsep_commonize.update', $konsep_commonize->id ) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Ctrl No</label>
                                <input type="text" class="form-control @error('ctrl_no') is-invalid @enderror"
                                    name="ctrl_no" value="{{ $konsep_commonize->ctrl_no }}" placeholder="Masukkan CTRL NO">

                                <!-- error message untuk title -->
                                @error('ctrl_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kind New</label>
                                <input type="text" class="form-control @error('kind_new') is-invalid @enderror" name="kind_new"
                                    value="{{ $konsep_commonize->kind_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('kind_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Size New</label>
                                <input type="text" class="form-control @error('size_new') is-invalid @enderror" name="size_new"
                                    value="{{ $konsep_commonize->size_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('size_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Col New</label>
                                <input type="text" class="form-control @error('col_new') is-invalid @enderror"
                                    name="col_new" value="{{ $konsep_commonize->col_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('col_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">C/L 28</label>
                                <input type="text" class="form-control @error('cl_28') is-invalid @enderror"
                                    name="cl_28" value="{{ $konsep_commonize->cl_28 }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cl_28')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Term B New</label>
                                <input type="text" class="form-control @error('term_b_new') is-invalid @enderror"
                                    name="term_b_new" value="{{ $konsep_commonize->term_b_new }}"
                                    placeholder=" ">

                                <!-- error message untuk title -->
                                @error('term_b_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc B1 New</label>
                                <input type="text" class="form-control @error('acc_b1_new') is-invalid @enderror" name="acc_b1_new"
                                    value="{{ $konsep_commonize->acc_b1_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_b1_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc B2</label>
                                <input type="text" class="form-control @error('acc_b2') is-invalid @enderror"
                                    name="acc_b2" value="{{ $konsep_commonize->acc_b2 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_b2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tube B New</label>
                                <input type="text" class="form-control @error('tube_b_new') is-invalid @enderror"
                                    name="tube_b_new" value="{{ $konsep_commonize->tube_b_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tube_b_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Term A New</label>
                                <input type="text" class="form-control @error('term_a_new') is-invalid @enderror"
                                    name="term_a_new" value="{{ $konsep_commonize->term_a_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('term_a_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc A1 New</label>
                                <input type="text" class="form-control @error('acc_a1_new') is-invalid @enderror"
                                    name="acc_a1_new" value="{{ $konsep_commonize->acc_a1_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_a1_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Acc A2</label>
                                <input type="text" class="form-control @error('acc_a2') is-invalid @enderror"
                                    name="acc_a2" value="{{ $konsep_commonize->acc_a2 }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('acc_a2')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tube A New</label>
                                <input type="text" class="form-control @error('tube_a_new') is-invalid @enderror"
                                    name="tube_a_new" value="{{ $konsep_commonize->tube_a_new }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('tube_a_new')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('konsep_commonize.index') }}" class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection