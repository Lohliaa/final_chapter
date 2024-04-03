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
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">PROSES AREA FINAL</h2>
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

                <!-- Export Excel -->
                <a href="{{ url('export_excel_proses') }}" class="btn btn-default mr-2"
                    target="_blank">Download Excel</a>

                <button style="margin-bottom: 0px" class="btn btn-default delete_all mr-2"
                    data-url="{{ url('DeleteAll_proses') }}">Delete</button>
                <a href="{{ url('proses') }}" class="btn btn-default mr-2">Refresh</a>

                <input type="text" name="search" id="searchproses" class="form-control w-25 mr-2"
                    placeholder="Cari disini ...">

                <span class="ml-2" id="count">Jumlah Data {{ $count }}</span>

            </div>

            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                <table class="table table-bordered" style="width: 200%;" id="prosesTableBody">
                    <thead style="height:40px">
                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                            <th scope="col"><input
                                    type="checkbox" class="sub_chk" id="master"></th>
                            <th scope="col">No</th>
                            <th scope="col">Month</th>
                            <th scope="col">Kav</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Area Store</th>
                            <th scope="col">Material</th>
                            <th scope="col">Material Properties</th>
                            <th scope="col">Model</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Warna</th>
                            <th scope="col">Model Ukuran Warna</th>
                            <th scope="col">Specific Component Number</th>
                            <th scope="col">CL</th>
                            <th scope="col">TRM B</th>
                            <th scope="col">Acc bag b1</th>
                            <th scope="col">Acc bag b2</th>
                            <th scope="col">TBE B</th>
                            <th scope="col">TRM A</th>
                            <th scope="col">Acc bag a1</th>
                            <th scope="col">Acc bag a2</th>
                            <th scope="col">TBE B</th>
                            <th scope="col">Total QTY</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Wire Cost</th>
                            <th scope="col">Component Cost</th>
                            <th scope="col">Material Cost</th>
                            <th scope="col">Material Cost Amount</th>
                            <th scope="col">Process</th>
                            <th scope="col">UMH</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Process Cost</th>
                            <th scope="col">Process Cost Amount</th>
                            <th scope="col">Total Cost Amount</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        @forelse ($proses as $data)
                        <tr id="tr_{{ $data->id }}">
                            <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                            <td>{{$no++}}</td>
                            <td>{{ $data->month }}</td>
                            <td>{{ $data->kav }}</td>
                            <td>{{ $data->bagian }}</td>
                            <td>{{ $data->area_store }}</td>
                            <td>{{ $data->material }}</td>
                            <td>{{ $data->material_properties }}</td>
                            <td>{{ $data->model }}</td>
                            <td>{{ $data->ukuran }}</td>
                            <td>{{ $data->warna }}</td>
                            <td>{{ $data->model_ukuran_warna }}</td>
                            <td>{{ $data->specific_component_number }}</td>
                            <td>{{ $data->cl }}</td>
                            <td>{{ $data->trm_b }}</td>
                            <td>{{ $data->acc_bag_b1 }}</td>
                            <td>{{ $data->acc_bag_b2 }}</td>
                            <td>{{ $data->tbe_b }}</td>
                            <td>{{ $data->trm_a }}</td>
                            <td>{{ $data->acc_bag_a1 }}</td>
                            <td>{{ $data->acc_bag_a2 }}</td>
                            <td>{{ $data->tbe_a }}</td>
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
</body>

<script>
    function pilih_proses() {
        const selected = document.getElementById('searchproses').value;
    
        fetch(`{{ route('search.proses') }}?proses=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('prosesTableBody').innerHTML = data;

                // Memperbarui jumlah data langsung dari respons server
                fetch(`{{ route('get.count.proses') }}?proses=${selected}`)
                    .then(response => response.text())
                    .then(countData => {
                        document.getElementById('count').innerText = 'Jumlah Data ' + countData;
                    });
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchproses').addEventListener('input', function() {
        pilih_proses();
    });

    // Fungsi yang akan dipanggil ketika checkbox berubah
    function handleCheckboxChange(id) {
        // Tambahkan logika yang sesuai untuk menangani perubahan checkbox di sini
        console.log('Checkbox with ID ' + id + ' changed.');
    }
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