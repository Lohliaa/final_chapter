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

<body>
    <div class="card shadow mt-3">
        <div class="card-header py-6 mb-5">
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">MATERIAL</h2>
        </div>
        <div class="form-row" style="margin-left: 2%; margin-right: 2%;">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" style="width: 1600px;">
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
            <div class="alert alert-success" style="width: 1600px;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $sukses }}</strong>
            </div>
            @endif
            <div class="form-group col-12 d-flex flex-wrap align-items-center">
                <button id="reset-material-button" class="btn btn-danger mr-2">Reset</button>

                <a href="{{ route('material.create') }}"
                    class="btn btn-md btn-md btn-default mb-6 mr-2">Tambah</a>
                <button type="button" class="btn btn-default mr-2"
                    onclick="handleEditClick()">Edit</button>

                <button type="button" class="btn btn-default mr-2" data-toggle="modal"
                    data-target="#import_excel_material">
                    Upload Excel
                </button>

                <div class="modal fade" id="import_excel_material" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="post" action="{{ url('import_excel_material') }}"
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
                <a href="{{ url('export_excel_material') }}" class="btn btn-default mr-2"
                    target="_blank">Download Excel</a>

                <button style="margin-bottom: 0px" class="btn btn-default delete_all mr-2"
                    data-url="{{ url('DeleteAll_material') }}">Delete</button>
                <a href="{{ url('proses_material') }}" class="btn btn-default mr-2">Proses</a>
                <a href="{{ url('material') }}" class="btn btn-default mr-2">Refresh</a>


                <input type="text" name="search" id="searchm" class="form-control w-25"
                    placeholder="Cari disini ...">

                <span class="ml-1" id="count">Jumlah Data {{ $count }}</span>
            </div>

            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                <table class="table table-bordered" style="width: 100%;" id="materialTableBody">
                    <thead style="height:40px">
                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
                            <th scope="col">No</th>
                            <th scope="col">Factory</th>
                            <th scope="col">Carcode</th>
                            <th scope="col">Area</th>
                            <th scope="col">Cavity</th>
                            <th scope="col">Partnumber</th>
                            <th scope="col">Part name</th>
                            <th scope="col">Qty total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        @forelse ($material as $c)
                        <tr id="tr_{{ $c->id }}">
                            <td ><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                                    onclick="handleCheckboxChange({{ $c->id }})"></td>
                            <td >{{$no++}}</td>
                            <td >{{ $c->factory }}</td>
                            <td >{{ $c->carcode }}</td>
                            <td >{{ $c->area }}</td>
                            <td >{{ $c->cavity }}</td>
                            <td >{{ $c->partnumber }}</td>
                            <td >{{ $c->part_name }}</td>
                            <td >{{ $c->qty_total }}</td>
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
</body>

<script>
    function cari_material() {
        const selected = document.getElementById('searchm').value;
    
        fetch(`{{ route('search.material') }}?material=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('materialTableBody').innerHTML = data;

                // Memperbarui jumlah data langsung dari respons server
                fetch(`{{ route('get.count.material') }}?material=${selected}`)
                    .then(response => response.text())
                    .then(countData => {
                        document.getElementById('count').innerText = 'Jumlah Data ' + countData;
                    });
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchm').addEventListener('input', function() {
        cari_material();
    });

    // Fungsi yang akan dipanggil ketika checkbox berubah
    function handleCheckboxChange(id) {
        // Tambahkan logika yang sesuai untuk menangani perubahan checkbox di sini
        console.log('Checkbox with ID ' + id + ' changed.');
    }
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
            var editUrl = "{{ url('edit_material') }}/" + itemsToEdit.join(',');
    
            window.location.href = editUrl;
        }
    }

</script>
<script>
    $(document).ready(function () {
        $('#reset-material-button').click(function () {
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

        {{--  $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });  --}}

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