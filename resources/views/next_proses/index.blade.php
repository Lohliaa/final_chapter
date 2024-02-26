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
            <p>CIRCUIT NON-SINGLE
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

                            <div class="form-group col-12 d-flex align-items-center">
                                <button id="reset-np-button" class="btn btn-danger mr-2">Reset</button>
                                <a href="{{ route('next_proses.create') }}"
                                    class="btn btn-md btn-md btn-default mb-6 mr-2">Tambah</a>

                                <button type="button" class="btn btn-default mr-2" data-toggle="modal"
                                    data-target="#import_excel_np">
                                    Upload Excel
                                </button>

                                <div class="modal fade" id="import_excel_np" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('import_excel_np') }}"
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
                                <a href="{{ url('export_excel_np') }}" class="btn btn-default mr-2" 
                                target="_blank">Download Excel</a>

                                <button style="margin-bottom: 0px" class="btn btn-default delete_all mr-2"
                                    data-url="{{ url('DeleteAll_Next_Proses') }}">Delete</button>
                                <button type="button" class="btn btn-default mr-2" onclick="handleEditClick()">Edit</button>
                                <a href="{{ url('next_proses') }}" class="btn btn-default mr-2">Refresh</a>
                                <input type="text" name="search" id="searchnp" class="form-control w-25 mr-2"
                                    placeholder="Cari disini ...">

                                <span class="ml-2" id="count">Jumlah Data {{ $count }}</span>

                            </div>

                            <div class="table-responsive">
                                <table border="1" id="nextProsesTableBody"
                                    style="display: block; overflow:scroll; height: 500px; width:2300px; text-align:center">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            <th style="width: 50px; text-align:center" scope="col"><input
                                                    type="checkbox" class="sub_chk" id="master"></th>
                                            <th style="width: 50px; text-align:center" scope="col">No</th>
                                            <th style="width: 150px; text-align:center" scope="col">Carline</th>
                                            <th style="width: 150px; text-align:center" scope="col">Type</th>
                                            <th style="width: 100px; text-align:center" scope="col">Jenis</th>
                                            <th style="width: 100px; text-align:center" scope="col">Ctrl_no</th>
                                            <th style="width: 100px; text-align:center" scope="col">jenis_ctrl_no</th>
                                            <th style="width: 100px; text-align:center" scope="col">ctrl_no_cct</th>
                                            <th style="width: 100px; text-align:center" scope="col">kind</th>
                                            <th style="width: 50px; text-align:center" scope="col">size</th>
                                            <th style="width: 50px; text-align:center" scope="col">color</th>
                                            <th style="width: 100px; text-align:center" scope="col">kind_size_color</th>
                                            <th style="width: 100px; text-align:center" scope="col">cust_part_no</th>
                                            <th style="width: 50px; text-align:center" scope="col">cl</th>
                                            <th style="width: 110px; text-align:center" scope="col">term_b</th>
                                            <th style="width: 180px; text-align:center" scope="col">accb1</th>
                                            <th style="width: 180px; text-align:center" scope="col">accb2</th>
                                            <th style="width: 180px; text-align:center" scope="col">tubeb</th>
                                            <th style="width: 110px; text-align:center" scope="col">term_a</th>
                                            <th style="width: 180px; text-align:center" scope="col">acca1</th>
                                            <th style="width: 180px; text-align:center" scope="col">acca2</th>
                                            <th style="width: 180px; text-align:center" scope="col">tubea</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($next_proses as $c)
                                        <tr id="tr_{{ $c->id }}">
                                            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                                                    onclick="handleCheckboxChange({{ $c->id }})"></td>
                                            <td>{{$no++}}</td>
                                            <td>{{ $c->carline }}</td>
                                            <td>{{ $c->type }}</td>
                                            <td>{{ $c->jenis }}</td>
                                            <td>{{ $c->ctrl_no }}</td>
                                            <td>{{ $c->jenis_ctrl_no }}</td>
                                            <td>{{ $c->ctrl_no_cct }}</td>
                                            <td>{{ $c->kind }}</td>
                                            <td>{{ $c->size }}</td>
                                            <td>{{ $c->color }}</td>
                                            <td>{{ $c->kind_size_color }}</td>
                                            <td>{{ $c->cust_part_no }}</td>
                                            <td>{{ $c->cl }}</td>
                                            <td>{{ $c->term_b }}</td>
                                            <td>{{ $c->accb1 }}</td>
                                            <td>{{ $c->accb2 }}</td>
                                            <td>{{ $c->tubeb }}</td>
                                            <td>{{ $c->term_a }}</td>
                                            <td>{{ $c->acca1 }}</td>
                                            <td>{{ $c->acca2 }}</td>
                                            <td>{{ $c->tubea }}</td>
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
    function cari_next_proses() {
        const selected = document.getElementById('searchnp').value;
    
        fetch(`{{ route('search.next_proses') }}?next_proses=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('nextProsesTableBody').innerHTML = data;

                // Memperbarui jumlah data langsung dari respons server
                fetch(`{{ route('get.count.next_proses') }}?next_proses=${selected}`)
                    .then(response => response.text())
                    .then(countData => {
                        document.getElementById('count').innerText = 'Jumlah Data ' + countData;
                    });
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchnp').addEventListener('input', function() {
        cari_next_proses();
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
    // Menggunakan variabel global untuk menyimpan daftar ID item yang ingin di-edit
    var itemsToEdit = [];

    // Event handler untuk checkbox
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
            var editUrl = "{{ url('edit_next_proses') }}/" + itemsToEdit.join(',');
    
            // Redirect ke halaman edit dengan URL yang telah dibuat
            window.location.href = editUrl;
        }
    }

</script>

<script>
    $(document).ready(function () {
        $('#reset-np-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_np') }}',
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