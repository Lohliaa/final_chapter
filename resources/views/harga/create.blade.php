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
                            <form action="{{ route('harga.store') }}" method="POST" enctype="multipart/form-data">
                            
                                @csrf

                                <div class="form-group">
                                    <label class="font-weight-bold">Component Number Ori</label>
                                    <input type="text" class="form-control @error('component_number_ori') is-invalid @enderror" name="component_number_ori" value="{{ old('component_number_ori') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('component_number_ori')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Component Number</label>
                                    <input type="text" class="form-control @error('component_number') is-invalid @enderror" name="component_number" value="{{ old('component_number') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('component_number')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Item</label>
                                    <input type="text" class="form-control @error('item') is-invalid @enderror" name="item" value="{{ old('item') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('item')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Price Per Pcs</label>
                                    <input type="text" class="form-control @error('price_per_pcs') is-invalid @enderror" name="price_per_pcs" value="{{ old('price_per_pcs') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('price_per_pcs')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
    
                                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                                <a class="btn btn-md btn-primary" href="{{ route('harga.index') }}" class="">KEMBALI</a>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection