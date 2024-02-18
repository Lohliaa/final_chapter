@extends('layouts.main')
@section('layouts.content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/js/maxcdn.bootstrapcdn.com_bootstrap_3.3.7_css_bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_jquery_3.2.1_jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_twitter-bootstrap_3.3.7_js_bootstrap.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_bootstrap-confirmation_1.0.5_bootstrap-confirmation.min.js') }}">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body style="background: lightgray">
    <figure class="text-center">
        <blockquote class="blockquote" style="font-size: 24px; font-family: Cambria;">
            <p>PROSES PRE ASSY
            <p>
        </blockquote>
    </figure>
    <div class="container mt-6">
        <div class="row" style="width: 1100px">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-start">
                            <div id="error-message"></div>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success" style="width: 1050px;">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            {{-- notifikasi form validasi --}}
                            @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @endif
                            {{-- notifikasi sukses --}}
                            @if ($sukses = Session::get('sukses'))
                            <div class="alert alert-success" style="width: 1050px;">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $sukses }}</strong>
                            </div>
                            @endif
                            <div class="form-group">

                                <!-- Export Excel -->
                                <a href="{{ url('export-excel-proses-fa-1a') }}" class="btn btn-default "
                                    target="_blank">Download Excel</a>

                                <button style="margin-bottom: 0px" class="btn btn-default delete_all"
                                    data-url="{{ url('deleteAll_proses_pa') }}">Delete</button>
                                {{--  <a href="{{ url('proses-pa-841w?calculate=true') }}" class="btn btn-default">Hitung</a>  --}}
                                <a href="{{ url('proses-pa-841w') }}" class="btn btn-default">Refresh</a>
                            </div>

                            <div class="form-group col-3">
                                <form class="form" method="get" action="{{ route('proses_fa_1a.pilih_proses_pa') }}">
                                    {{-- <label for="inputCity">City</label> --}}
                                    <input type="text" name="pilih_proses_pa" class="form-control w-75 d-inline"
                                        id="pilih_proses_pa" placeholder=" ">
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                </form>
                            </div>

                            <div class="form-group col-5">
                                <form action="{{ route('proses_fa_1a.pilih_proses_pa') }}" method="get">
                                    @csrf
                                    <select name="pilih_proses_pa" class="form-control w-50 d-inline" placeholder="">
                                        <option value="" disabled selected hidden> </option>
                                        @foreach($proses_fa_1a->unique('ctrl_no') as $c)
                                        <option value="{{ $c->ctrl_no }}">{{ $c->ctrl_no }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                    <span>Jumlah Data {{ $count }}</span>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table border="1"
                                    style="display: block; overflow:scroll; height: 500px; width:3000px; text-align:center">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            <th style="width: 50px; text-align:center" scope="col"><input
                                                    type="checkbox" class="sub_chk" id="master"></th>
                                            <th style="width: 50px; text-align:center" scope="col">No</th>
                                            <th style="width: 80px; text-align:center" scope="col">Month</th>
                                            <th style="width: 80px; text-align:center" scope="col">car_line</th>
                                            <th style="width: 80px; text-align:center" scope="col">conveyor</th>
                                            <th style="width: 180px; text-align:center" scope="col">ADDRESSING STORE
                                            </th>
                                            <th style="width: 110px; text-align:center" scope="col">CTRL NO1</th>
                                            <th style="width: 100px; text-align:center" scope="col">CTRL NO2</th>
                                            <th style="width: 100px; text-align:center" scope="col">kind</th>
                                            <th style="width: 50px; text-align:center" scope="col">size</th>
                                            <th style="width: 50px; text-align:center" scope="col">color</th>
                                            <th style="width: 100px; text-align:center" scope="col">kind_size_color</th>
                                            <th style="width: 100px; text-align:center" scope="col">cust_part_no</th>
                                            <th style="width: 50px; text-align:center" scope="col">cl</th>
                                            <th style="width: 110px; text-align:center" scope="col">term_b</th>
                                            <th style="width: 130px; text-align:center" scope="col">accb1</th>
                                            <th style="width: 130px; text-align:center" scope="col">accb2</th>
                                            <th style="width: 110px; text-align:center" scope="col">tubeb</th>
                                            <th style="width: 110px; text-align:center" scope="col">term_a</th>
                                            <th style="width: 130px; text-align:center" scope="col">acca1</th>
                                            <th style="width: 130px; text-align:center" scope="col">acca2</th>
                                            <th style="width: 110px; text-align:center" scope="col">tubea</th>
                                            <th style="width: 80px; text-align:center" scope="col">total_qty</th>
                                            <th style="width: 100px; text-align:center" scope="col">price</th>
                                            <th style="width: 100px; text-align:center" scope="col">wire_cost</th>
                                            <th style="width: 130px; text-align:center" scope="col">component_cost</th>
                                            <th style="width: 130px; text-align:center" scope="col">material_cost</th>
                                            <th style="width: 130px; text-align:center" scope="col">material cost amount</th>
                                            <th style="width: 100px; text-align:center" scope="col">process</th>
                                            <th style="width: 100px; text-align:center" scope="col">UMH</th>
                                            <th style="width: 100px; text-align:center" scope="col">charge</th>
                                            <th style="width: 100px; text-align:center" scope="col">process cost</th>
                                            <th style="width: 100px; text-align:center" scope="col">process cost amount</th>
                                            <th style="width: 100px; text-align:center" scope="col">Total Cost Amount</th>
                                            <th style="width: 100px; text-align:center" scope="col">keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($proses_fa_1a as $data)
                                        <tr id="tr_{{ $data->id }}">
                                            <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                                            <td>{{$no++}}</td>
                                            <td>{{ $data->month }}</td>
                                            <td>{{ $data->car_line }}</td>
                                            <td>{{ $data->conveyor }}</td>
                                            <td>{{ $data->addressing_store }}</td>
                                            <td>{{ $data->ctrl_no }}</td>
                                            <td>{{ $data->ctrlno }}</td>
                                            <td>{{ $data->kind }}</td>
                                            <td>{{ $data->size }}</td>
                                            <td>{{ $data->color }}</td>
                                            <td>{{ $data->kind_size_color }}</td>
                                            <td>{{ $data->cust_part_no }}</td>
                                            <td>{{ $data->cl }}</td>
                                            <td>{{ $data->term_b }}</td>
                                            <td>{{ $data->accb1 }}</td>
                                            <td>{{ $data->accb2 }}</td>
                                            <td>{{ $data->tubeb }}</td>
                                            <td>{{ $data->term_a }}</td>
                                            <td>{{ $data->acca1 }}</td>
                                            <td>{{ $data->acca2 }}</td>
                                            <td>{{ $data->tubea }}</td>
                                            <td>{{ $data->total_qty }}</td>
                                            <td>{{ $data->price_sum }}</td>
                                            <td>{{ number_format($data->wire_cost, 2, ',', '.') }}</td>
                                            <td>{{ number_format($data->component_cost, 2, ',', '.') }}</td>
                                            <td>{{ number_format($data->material_cost, 2, ',', '.') }}</td>
                                            <td>{{ number_format($data->material_cost_amount, 2, ',', '.') }}</td>
                                            <td>{{ $data->process }}</td>
                                            <td>{{ number_format($data->umh, 2, ',', '.') }}</td>
                                            <td>{{ $data->charge }}</td>
                                            <td>{{ number_format($data->process_cost, 2, ',', '.') }}</td>
                                            <td>{{ number_format($data->process_cost_amount, 2, ',', '.') }}</td>
                                            <td>{{ number_format($data->total_amount, 2, ',', '.') }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                        </tr>
                                        @empty
                                        <br>
                                        <div class="alert alert-danger">
                                            Data belum Tersedia.
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script type="text/javascript">
    $(document).ready(function () {

        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  

                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

            return false;
        });
    });
</script>

@endsection