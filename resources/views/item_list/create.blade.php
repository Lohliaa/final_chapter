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
                            <form action="{{ route('item_list.store') }}" method="POST" enctype="multipart/form-data">
                            
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">PART_NO</label>
                                    <input type="text" class="form-control @error('part_no') is-invalid @enderror" name="part_no" value="{{ old('part_no') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('part_no')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">CUST_PNO</label>
                                    <input type="text" class="form-control @error('cust_pno') is-invalid @enderror" name="cust_pno" value="{{ old('cust_pno') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('cust_pno')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">PART_NAME</label>
                                    <input type="text" class="form-control @error('part_name') is-invalid @enderror" name="part_name" value="{{ old('part_name') }}" placeholder=" ">
                                
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