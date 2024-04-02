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

<body>
    <div class="card shadow mt-3">
        <div class="card-header py-6 mb-5">
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">DAFTAR UMH</h2>
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
            <div class="alert alert-success" style="width: 1050px;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $sukses }}</strong>
            </div>
            @endif
            <div class="form-group col-12 d-flex flex-wrap align-items-center">
                <button id="reset-umh-button" class="btn btn-danger mr-2">Reset</button>
                <a href="{{ route('umh_master.create') }}"
                    class="btn btn-md btn-md btn-default mb-6 mr-2">Tambah</a>
                <button type="button" class="btn btn-default mr-2" onclick="handleEditClick()">Edit</button>

                <button type="button" class="btn btn-default mr-2" data-toggle="modal"
                    data-target="#import_excel_umh">
                    Upload Excel
                </button>

                <div class="modal fade" id="import_excel_umh" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="post" action="{{ url('import_excel_umh') }}"
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

                <!-- Export Excel -->
                <a href="{{ url('export_excel_umh') }}" class="btn btn-default mr-2"
                    target="_blank">Download Excel</a>

                <button style="margin-bottom: 0px" class="btn btn-default delete_all mr-2"
                    data-url="{{ url('DeleteAll_umh') }}">Delete</button>
                <a href="{{ url('umh_master') }}" class="btn btn-default mr-2">Refresh</a>

                <input type="text" name="search" id="searchumh" class="form-control w-25 mr-2"
                    placeholder="Cari disini ...">

                <span class="ml-2" id="count">Jumlah Data {{ $count }}</span>
            </div>

            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                <table class="table table-bordered" style="width: 100%;" id="umhTableBody">
                    <thead style="height:40px">
                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
                            <th scope="col">No</th>
                            <th scope="col">Kav</th>
                            <th scope="col">Code 10</th>
                            <th scope="col">Code 20</th>
                            <th scope="col">Code 30</th>
                            <th scope="col">Process 10</th>
                            <th scope="col">Process 20</th>
                            <th scope="col">Process 30</th>
                            <th scope="col">Charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        @forelse ($umh_master as $c)
                        <tr id="tr_{{ $c->id }}">
                            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                                    onclick="handleCheckboxChange({{ $c->id }})"></td>
                            <td>{{$no++}}</td>
                            <td>{{ $c->kav }}</td>
                            <td>{{ number_format($c->code_umh1, 4, '.', '.') }}</td>
                            <td>{{ number_format($c->code_umh2, 4, '.', '.') }}</td>
                            <td>{{ number_format($c->code_umh3, 4, '.', '.') }}</td>
                            @php
                            $totalKodeUMH1 = $c->code_umh1;
                            @endphp
                            <td>{{ number_format($totalKodeUMH1, 4, '.', '') }}</td>
                            @php
                            $totalKodeUMH2 = $c->code_umh1 + $c->code_umh2;
                            @endphp
                            <td>{{ number_format($totalKodeUMH2, 4, '.', '') }}</td>
                            @php
                            $totalKodeUMH3 = $c->code_umh1 + $c->code_umh2 + $c->code_umh3;
                            @endphp
                            <td>{{ number_format($totalKodeUMH3, 4, '.', '') }}</td>
                            <td>{{ $c->charge }}</td>
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

<script src="{{ asset('assets/js/code.jquery.com_jquery-3.6.0.min.js') }}"></script>

<script>
    function cari_umh() {
        const selected = document.getElementById('searchumh').value;
    
        fetch(`{{ route('search.umh_master') }}?umh_master=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('umhTableBody').innerHTML = data;

                // Memperbarui jumlah data langsung dari respons server
                fetch(`{{ route('get.count.umh_master') }}?umh_master=${selected}`)
                    .then(response => response.text())
                    .then(countData => {
                        document.getElementById('count').innerText = 'Jumlah Data ' + countData;
                    });
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchumh').addEventListener('input', function() {
        cari_umh();
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
            var editUrl = "{{ url('edit_umh') }}/" + itemsToEdit.join(',');
    
            // Redirect ke halaman edit dengan URL yang telah dibuat
            window.location.href = editUrl;
        }
    }

</script>
<script>
    $(document).ready(function () {
        $('#reset-umh-button').click(function () {
            if (confirm("Apakah anda yakin ingin menghapus semua data?")) {
                $.ajax({
                    url: '{{ route('reset_umh') }}',
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