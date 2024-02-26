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
            <p>MASTER PRICE
            <p>
        </blockquote>
    </figure>
    <div class="container">
        <div class="row" style="width: 1100px">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-start">
                            {{-- notifikasi form validasi --}}
                            @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                @foreach ($errors->get('file') as $error)
                                <strong>{{ $error }}</strong><br>
                                @endforeach
                            </span>
                            @endif

                            <div class="form-group col-12 d-flex align-items-center">
                                <button id="reset-mp-button" class="btn btn-danger mr-2">Reset</button>
                                <a href="{{ route('master_price.create') }}"
                                    class="btn btn-md btn-md btn-default mb-6 mr-2">Tambah</a>

                                <button type="button" class="btn btn-default mr-2" data-toggle="modal"
                                    data-target="#import_excel_mp">
                                    Upload Excel
                                </button>

                                <div class="modal fade" id="import_excel_mp" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('import_excel_mp') }}"
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
                                <a href="{{ url('export_excel_mp') }}" class="btn btn-default mr-2" target="_blank">Download
                                    Excel</a>
                                <button style="margin-bottom: 0px" class="btn btn-default delete_all mr-2"
                                    data-url="{{ url('deleteAll') }}">Delete</button>
                                <a href="{{ url('master_price') }}" class="btn btn-default mr-2">Refresh</a>
                            
                                <input type="text" name="search" id="searchmp" class="form-control w-25 mr-2"
                                    placeholder="Cari disini ...">

                                <span class="ml-2" id="count">Jumlah Data {{ $count }}</span>
                            </div>

                            <div class="table-responsive">
                                <div class="table-responsive" style="margin: 0 auto;">
                                    <table border="1" id="mpTableBody"
                                        style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
                                        <thead style="height:40px">
                                            <tr class="table-secondary" style=" position: sticky; top: 0;">
                                                <th style="width: 50px; text-align:center" scope="col"><input
                                                        type="checkbox" class="sub_chk" id="master"></th>
                                                <th style="width: 50px; text-align:center" scope="col">No</th>
                                                <th style="width: 220px; text-align:center" scope="col">
                                                    part_number_ori_sto
                                                </th>
                                                <th style="width: 200px; text-align:center" scope="col">part_number_mpl
                                                </th>
                                                <th style="width: 200px; text-align:center" scope="col">buppin</th>
                                                <th style="width: 170px; text-align:center" scope="col">price_per_pcs
                                                </th>
                                                <th style="width: 150px; text-align:center " scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1 ?>
                                            @forelse ($master_price as $mp)
                                            <tr id="tr_{{ $mp->id }}">
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$mp->id}}"></td>
                                                <td>{{$no++}}</td>
                                                <td>{{ $mp->part_number_ori_sto }}</td>
                                                <td>{{ $mp->part_number_mpl }}</td>
                                                <td>{{ $mp->buppin }}</td>
                                                <td>{{ $mp->price_per_pcs }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('master_price.edit', $mp->id) }}"
                                                        class="btn btn-xs" style="margin-top: 5px; margin-bottom: 5px; background-color: transparent;
                                                            border: 1px solid #f0ad4e;
                                                            padding: 6px 12px;
                                                            border-radius: 4px;">EDIT</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <br>
                                            <div class="alert alert-danger">
                                                Data belum Tersedia.
                                            </div>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $master_price->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
<script src="{{ asset('assets/js/code.jquery.com_jquery-3.6.0.min.js') }}"></script>

<script>
    function search() {
        const selected = document.getElementById('searchmp').value;
    
        fetch(`{{ route('search.master_price') }}?master_price=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('mpTableBody').innerHTML = data;

                // Memperbarui jumlah data langsung dari respons server
                fetch(`{{ route('get.count.master_price') }}?master_price=${selected}`)
                    .then(response => response.text())
                    .then(countData => {
                        document.getElementById('count').innerText = 'Jumlah Data ' + countData;
                    });
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchmp').addEventListener('input', function() {
        search();
    });

    // Fungsi yang akan dipanggil ketika checkbox berubah
    function handleCheckboxChange(id) {
        // Tambahkan logika yang sesuai untuk menangani perubahan checkbox di sini
        console.log('Checkbox with ID ' + id + ' changed.');
    }
</script>

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
    $(document).ready(function () {
        $('#reset-mp-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_mp') }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.success);
                        location.reload();
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