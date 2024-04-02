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
                            <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                            
                                @csrf
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
                                    <label class="font-weight-bold">Specific Component Number</label>
                                    <input type="text" class="form-control @error('specific_component_number') is-invalid @enderror" name="specific_component_number" value="{{ old('specific_component_number') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('specific_component_number')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Component Name</label>
                                    <input type="text" class="form-control @error('component_name') is-invalid @enderror" name="component_name" value="{{ old('component_name') }}" placeholder=" ">
                                
                                    <!-- error message untuk title -->
                                    @error('component_name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                                <a class="btn btn-md btn-primary" href="{{ route('item.index') }}" class="">KEMBALI</a>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection