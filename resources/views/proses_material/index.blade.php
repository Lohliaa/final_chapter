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
            <p>Proses Material<p>
        </blockquote>
    </figure>
    <div class="container mt-6">
        <div class="row" style="width: 1100px">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-start">
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
                                <a href="{{ url('export_excel_prosesMaterial') }}" class="btn btn-default " target="_blank">Download Excel</a>

                                {{--  <button style="margin-bottom: 0px" class="btn btn-default delete_all"
                                    data-url="{{ url('DeleteAll_prosesMaterial') }}">Delete</button>  --}}
                                <a href="{{ url('proses_material') }}" class="btn btn-default">Refresh</a>
                            </div>

                            <div class="form-group col-3">
                                <form class="form" method="get" action="{{ route('proses_material.pilih_proses_material') }}">
                                    <input type="text" name="pilih_proses_material" class="form-control w-75 d-inline" id="pilih_proses_material"
                                        placeholder=" ">
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                </form>
                            </div>

                            <div class="form-group col-5">
                                <form action="{{ route('proses_material.pilih_proses_material') }}" method="get">
                                    @csrf
                                    <select name="pilih_proses_material" class="form-control w-50 d-inline" placeholder="">
                                        <option value="" disabled selected hidden> </option>
                                        @foreach($proses_material->unique('partnumber') as $c)
                                        <option value="{{ $c->partnumber }}">{{ $c->partnumber }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                    <span>Jumlah Data {{ $count }}</span>
                                </form>
                            </div>

                            <div class="table-responsive" style="margin: 0 auto;">
                                <table border="1" style="display: block; overflow: scroll; height: 500px; width: 1500px; text-align: center; margin: 0 auto;">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            {{--  <th style="width: 50px; text-align:center" scope="col"><input
                                                    type="checkbox" class="sub_chk" id="master"></th>  --}}
                                            <th style="width: 50px; text-align:center" scope="col">No</th>
                                            <th style="width: 100px; text-align:center" scope="col">Factory</th>
                                            <th style="width: 100px; text-align:center" scope="col">Carcode</th>
                                            <th style="width: 200px; text-align:center" scope="col">Area</th>
                                            <th style="width: 200px; text-align:center" scope="col">Cavity</th>
                                            <th style="width: 200px; text-align:center" scope="col">Partnumber</th>
                                            <th style="width: 200px; text-align:center" scope="col">Part name</th>
                                            <th style="width: 150px; text-align:center" scope="col">Qty total</th>
                                            <th style="width: 150px; text-align:center" scope="col">Length</th>
                                            <th style="width: 150px; text-align:center" scope="col">Konversi</th>
                                            <th style="width: 150px; text-align:center" scope="col">QTY After Konversi</th>
                                            <th style="width: 150px; text-align:center" scope="col">Cek</th>
                                            <th style="width: 150px; text-align:center" scope="col">Price</th>
                                            <th style="width: 150px; text-align:center" scope="col">Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($proses_material as $data)
                                        <tr id="tr_{{ $data->id }}">
                                            {{--  <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"
                                                    onclick="handleCheckboxChange({{ $data->id }})"></td>  --}}
                                            <td>{{$no++}}</td>
                                            <td>{{ $data->factory }}</td>
                                            <td>{{ $data->carcode }}</td>
                                            <td>{{ $data->area }}</td>
                                            <td>{{ $data->cavity }}</td>
                                            <td>{{ $data->partnumber }}</td>
                                            <td>{{ $data->part_name }}</td>
                                            <td>{{ $data->qty_total }}</td>
                                            <td>{{ $data->length }}</td>
                                            <td>{{ $data->konversi }}</td>
                                            <td>{{ $data->qty_after_konversi }}</td>
                                            <td>{{ $data->cek }}</td>
                                            <td>{{ $data->price }}</td>
                                            <td>{{ $data->amount }}</td>
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
</body>
<script>
    var itemsToEdit = [];

    function handleCheckboxChange(id) {
        var index = itemsToEdit.indexOf(id);
        if (index > -1) {
            itemsToEdit.splice(index, 1);
        } else {
            itemsToEdit.push(id);
        }
    }

    function handleEditClick() {
        if (itemsToEdit.length === 0) {
            alert("Please select at least one item to edit.");
        } else {
            var editUrl = "{{ url('edit_prosesMaterial') }}/" + itemsToEdit.join(',');
    
            window.location.href = editUrl;
        }
    }

</script>
<script>
    $(document).ready(function () {
        $('#reset-prosesMaterial-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_material') }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.success);
                        location.reload(); // Muat ulang halaman setelah berhasil
                    },
                    error: function (data) {
                        alert(data.error);
                    }
                });
            }
        });
    });
</script>
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