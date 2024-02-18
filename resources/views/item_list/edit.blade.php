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

                        <form action="{{ route('item_list.update', $item_list->id ) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">part_no</label>
                                <input type="text" class="form-control @error('part_no') is-invalid @enderror"
                                    name="part_no" value="{{ $item_list->part_no }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('part_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">cust_pno</label>
                                <input type="text" class="form-control @error('cust_pno') is-invalid @enderror"
                                    name="cust_pno" value="{{ $item_list->cust_pno }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('cust_pno')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">part_name</label>
                                <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                                    name="part_name" value="{{ $item_list->part_name }}" placeholder=" ">

                                <!-- error message untuk title -->
                                @error('part_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('item_list.index') }}" class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection