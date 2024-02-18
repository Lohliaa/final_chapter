@extends('layouts.main')
@section('layouts.content')

<head>
    <link rel="stylesheet"
        href="{{ asset('assets/js/maxcdn.bootstrapcdn.com_bootstrap_3.3.7_css_bootstrap.min.css') }}">
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
            <p>CIRCUIT SINGLE
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
                            {{-- @if ($sukses = Session::get('sukses'))
                            <div class="alert alert-success" style="width: 1050px;">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $sukses }}</strong>
                            </div>
                            @endif --}}
                            <div class="form-group col-12">
                                <button id="reset-kc-button" class="btn btn-danger">Reset</button>

                                <a href="{{ route('konsep_commonize.create') }}"
                                    class="btn btn-md btn-md btn-default mb-6">Tambah</a>
                                <button type="button" class="btn btn-default" onclick="handleEditClick()">Edit</button>

                                <button type="button" class="btn btn-default " data-toggle="modal"
                                    data-target="#import_excel_kc">
                                    Upload Excel
                                </button>

                                <div class="modal fade" id="import_excel_kc" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('import_excel_kc') }}"
                                            enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
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
                                <div class="modal fade" id="update_excel_kc" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('update_excel_kc') }}"
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
                                <a href="{{ url('export_excel_kc') }}" class="btn btn-default " target="_blank">Download
                                    Excel</a>
                                <button style="margin-bottom: 0px" class="btn btn-default delete_all"
                                    data-url="{{ url('DeleteAll_konsep') }}">Delete</button>
                                    <a href="{{ url('konsep_commonize') }}" class="btn btn-default">Refresh</a>

                            </div>
                            <div class="form-group col-3">
                                <form class="form" method="get" action="{{ url('cari_konsep') }}">
                                    {{-- <label for="inputCity">City</label> --}}
                                    <input type="text" name="cari_konsep" class="form-control w-75 d-inline"
                                        id="cari_konsep" placeholder=" ">
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                </form>
                            </div>
                            <div class="form-group col-5">
                                <form action="{{ url('cari_konsep') }}" method="get">
                                    @csrf
                                    <select name="cari_konsep" class="form-control w-50 d-inline" placeholder="">
                                        <option value="" disabled selected hidden> </option>
                                        @foreach($konsep_commonize->unique('ctrl_no') as $c)
                                        <option value="{{ $c->ctrl_no }}">{{ $c->ctrl_no }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-default ">Cari</button>
                                    <span>Jumlah Data {{ $count }}</span>
                                </form>

                            </div>


                            <div class="table-responsive">
                                <table border="1"
                                    style="display: block; overflow:scroll; height: 500px; width:1350px; text-align:center">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            <th style="width: 50px; text-align:center" scope="col"><input
                                                    type="checkbox" class="sub_chk" id="master"></th>
                                            <th style="width: 50px; text-align:center" scope="col">No</th>
                                            <th style="width: 60px; text-align:center" scope="col">Ctrl No</th>
                                            <th style="width: 100px; text-align:center" scope="col">Kind New</th>
                                            <th style="width: 80px; text-align:center" scope="col">Size New</th>
                                            <th style="width: 80px; text-align:center" scope="col">Col New</th>
                                            <th style="width: 60px; text-align:center" scope="col">C/L-28</th>
                                            <th style="width: 100px; text-align:center" scope="col">Term B New</th>
                                            <th style="width: 110px; text-align:center" scope="col">Acc B1 New</th>
                                            <th style="width: 100px; text-align:center" scope="col">Acc B2</th>
                                            <th style="width: 120px; text-align:center" scope="col">Tube B New</th>
                                            <th style="width: 100px; text-align:center" scope="col">Term A New</th>
                                            <th style="width: 110px; text-align:center" scope="col">Acc A1 New</th>
                                            <th style="width: 110px; text-align:center" scope="col">Acc A2</th>
                                            <th style="width: 120px; text-align:center" scope="col">Tube A New</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($konsep_commonize as $c)
                                        <tr id="tr_{{ $c->id }}">
                                            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                                                    onclick="handleCheckboxChange({{ $c->id }})"></td>
                                            <td>{{$no++}}</td>
                                            <td>{{ $c->ctrl_no }}</td>
                                            <td>{{ $c->kind_new }}</td>
                                            <td>{{ $c->size_new }}</td>
                                            <td>{{ $c->col_new }}</td>
                                            <td>{{ $c->cl_28 }}</td>
                                            <td>{{ $c->term_b_new }}</td>
                                            <td>{{ $c->acc_b1_new }}</td>
                                            <td>{{ $c->acc_b2 }}</td>
                                            <td>{{ $c->tube_b_new }}</td>
                                            <td>{{ $c->term_a_new }}</td>
                                            <td>{{ $c->acc_a1_new }}</td>
                                            <td>{{ $c->acc_a2 }}</td>
                                            <td>{{ $c->tube_a_new }}</td>
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
<script src="{{ asset('assets/js/code.jquery.com_jquery-3.6.0.min.js') }}"></script>

<script>
    @if ($errors->any())
        var errorMessages = @json($errors->all());
        var errorMessage = errorMessages.join('\n');
        alert(errorMessage);
    @elseif (session('success'))
        alert("{{ session('success') }}");
    @endif
</script>
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
        // Membuat URL dengan fungsi url() Laravel
        var editUrl = "{{ url('edit') }}/" + itemsToEdit.join(',');

        // Redirect ke halaman edit dengan URL yang telah dibuat
        window.location.href = editUrl;
    }
}

</script>
<script>
    $(document).ready(function () {
        $('#reset-kc-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_kc') }}',
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