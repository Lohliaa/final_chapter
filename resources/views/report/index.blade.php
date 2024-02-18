@extends('layouts.main')
@section('layouts.content')

<body>

    <div class="container mt-4">
        <div class="row px-2">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="height: 200px; position: relative; display: flex; justify-content: center; align-items: center;">
                                    <div class="inner">
                                        <h3 style="margin: 0;">AMOUNT</h3>
                                    </div>
                                    <a href="{{ url('export') }}" class="small-box-footer" style="position: absolute; bottom: 0; left: 0; width: 100%; color: #fff; padding: 5px; text-align: center; text-decoration: none;">Download Report <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            {{--  <div class="form-group col-4">
                                <!-- small box -->
                                <div class="small-box bg-info" style="height: 200px; position: relative; display: flex; justify-content: center; align-items: center;">
                                    <div class="inner">
                                        <h3 style="margin: 0;">QTY</h3>
                                    </div>
                                    <a href="{{ url('export_cv') }}" class="small-box-footer" style="position: absolute; bottom: 0; left: 0; width: 100%; color: #fff; padding: 5px; text-align: center; text-decoration: none;">Download Report <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>  --}}
                            <div class="form-group col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="height: 200px; position: relative; display: flex; justify-content: center; align-items: center;">
                                    <div class="inner">
                                        <h3 style="margin: 0;">QTY ALL</h3>
                                    </div>
                                    <a href="{{ url('export_qty') }}" class="small-box-footer" style="position: absolute; bottom: 0; left: 0; width: 100%; color: #fff; padding: 5px; text-align: center; text-decoration: none;">Download Report <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection