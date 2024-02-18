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

                        <form action="{{ route('master_price.update', $master_price->id ) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Part Number Ori STO</label>
                                <input type="text" class="form-control @error('part_number_ori_sto') is-invalid @enderror"
                                    name="part_number_ori_sto" value="{{ $master_price->part_number_ori_sto }}" placeholder="Masukkan part number ori sto">

                                <!-- error message untuk title -->
                                @error('part_number_ori_sto')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Part Number MPL</label>
                                <input type="text" class="form-control @error('part_number_mpl') is-invalid @enderror"
                                    name="part_number_mpl" value="{{ $master_price->part_number_mpl }}" placeholder="Masukkan Part Number Mpl">

                                <!-- error message untuk title -->
                                @error('part_number_mpl')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Buppin</label>
                                <input type="text" class="form-control @error('buppin') is-invalid @enderror"
                                    name="buppin" value="{{ $master_price->buppin }}" placeholder="Masukkan Buppin">

                                <!-- error message untuk title -->
                                @error('buppin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                                                 
                            <div class="form-group">
                                <label class="font-weight-bold">Price Per Pcs</label>
                                <input type="text" class="form-control @error('price_per_pcs') is-invalid @enderror"
                                    name="price_per_pcs" value="{{ $master_price->price_per_pcs }}" placeholder="Masukkan Price per pcs">

                                <!-- error message untuk title -->
                                @error('price_per_pcs')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                            <a class="btn btn-md btn-primary" href="{{ route('master_price.index') }}" class="">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection