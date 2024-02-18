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
            <p>FINAL ASSY
            <p>
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
                            <div class="form-group col-12">
                                <button id="reset-fa-button" class="btn btn-danger">Reset</button>

                                <a href="{{ route('data-fa-841w.create') }}"
                                    class="btn btn-md btn-md btn-default mb-6">Tambah</a>

                                <button type="button" class="btn btn-default " data-toggle="modal"
                                    data-target="#import_excel_fa">
                                    Upload Excel
                                </button>

                                <div class="modal fade" id="import_excel_fa" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('import_excel_fa') }}"
                                            enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                                                </div>
                                                <div class="modal-body">

                                                    {{ csrf_field() }}

                                                    <label>Pilih file excel</label>
                                                    <div class="form-group">
                                                        <input type="file" name="file" required="required">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-default ">Import</button>
                                                    <br>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Import Excel -->
                                <div class="modal fade" id="update_excel_fa_1c" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('update_excel_fa_1c') }}"
                                            enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                                                </div>
                                                <div class="modal-body">

                                                    {{ csrf_field() }}

                                                    <label>Pilih file excel</label>
                                                    <div class="form-group">
                                                        <input type="file" name="file" required="required">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-default ">Import</button>
                                                    <br>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Export Excel -->
                                <a href="{{ url('export_excel_fa') }}" class="btn btn-default " target="_blank">Download
                                    Excel</a>

                                <button style="margin-bottom: 0px" class="btn btn-default delete_all"
                                    data-url="{{ url('DeleteAll_fa') }}">Delete</button>
                                <button type="button" class="btn btn-default" onclick="handleEditClick()">Edit</button>
                                <a href="{{ url('proses') }}" class="btn btn-default">Proses</a>
                                <a href="{{ url('data-fa-841w') }}" class="btn btn-default">Refresh</a>
                            </div>

                            <div class="form-group">
                                <form class="form" method="get" action="{{ route('fa_1c.cari_fa') }}">
                                    {{-- <label for="inputCity">City</label> --}}
                                    <input type="text" name="cari_fa" class="form-control w-75 d-inline" id="cari_fa"
                                        placeholder=" ">
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                </form>
                            </div>

                            <div class="form-group col-6">
                                <form action="{{ route('fa_1c.cari_fa') }}" method="get">
                                    @csrf
                                    <select name="cari_fa" class="form-control w-50 d-inline" placeholder="">
                                        <option value="" disabled selected hidden> </option>
                                        @foreach($fa_1c->unique('ctrl_no') as $c)
                                        <option value="{{ $c->ctrl_no }}">{{ $c->ctrl_no }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                    <span>Jumlah Data {{ $count }}</span>
                                </form>
                            </div>

                            <div class="table-responsive" style="margin: 0 auto;">
                                <table border="1" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            <th style="width: 50px; text-align:center" scope="col"><input
                                                    type="checkbox" class="sub_chk" id="master"></th>
                                            <th style="width: 50px; text-align:center" scope="col">No</th>
                                            <th style="width: 100px; text-align:center" scope="col">Carline</th>
                                            <th style="width: 100px; text-align:center" scope="col">Conveyor</th>
                                            <th style="width: 150px; text-align:center" scope="col">Addressing Store
                                            </th>
                                            <th style="width: 100px; text-align:center" scope="col">Ctrl No</th>
                                            <th style="width: 70px; text-align:center" scope="col">Colour</th>
                                            <th style="width: 70px; text-align:center" scope="col">Qty Kbn</th>
                                            <th style="width: 50px; text-align:center" scope="col">Issue</th>
                                            <th style="width: 70px; text-align:center" scope="col">Total Qty</th>
                                            <th style="width: 80px; text-align:center" scope="col">Housing</th>
                                            <th style="width: 100px; text-align:center" scope="col">Month</th>
                                            <th style="width: 100px; text-align:center" scope="col">Year</th>
                                            <th style="width: 100px; text-align:center" scope="col">SAI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($fa_1c as $c)
                                        <tr id="tr_{{ $c->id }}">
                                            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                                                    onclick="handleCheckboxChange({{ $c->id }})"></td>
                                            <td>{{$no++}}</td>
                                            <td>{{ $c->car_line }}</td>
                                            <td>{{ $c->conveyor }}</td>
                                            <td>{{ $c->addressing_store }}</td>
                                            <td>{{ $c->ctrl_no }}</td>
                                            <td>{{ $c->colour }}</td>
                                            <td>{{ $c->qty_kbn }}</td>
                                            <td>{{ $c->issue }}</td>
                                            <td>{{ $c->total_qty }}</td>
                                            <td>{{ $c->housing }}</td>
                                            <td>{{ $c->month }}</td>
                                            <td>{{ $c->year }}</td>
                                            <td>{{ $c->sai }}</td>
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
            var editUrl = "{{ url('edit_fa') }}/" + itemsToEdit.join(',');
    
            window.location.href = editUrl;
        }
    }

</script>
<script>
    $(document).ready(function () {
        $('#reset-fa-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_fa') }}',
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