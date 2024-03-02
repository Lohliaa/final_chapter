<table class="table table-bordered" style="width: 200%;" id="prosesTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Month</th>
            <th scope="col">Line</th>
            <th scope="col">Bagian</th>
            <th scope="col">Area STORE</th>
            <th scope="col">Material</th>
            <th scope="col">Material Properties</th>
            <th scope="col">Model</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Warna</th>
            <th scope="col">Model Ukuran Warna</th>
            <th scope="col">Specific Part Numb</th>
            <th scope="col">CL</th>
            <th scope="col">Terminal B</th>
            <th scope="col">Acc bag b1</th>
            <th scope="col">Acc bag b2</th>
            <th scope="col">Tube B</th>
            <th scope="col">Terminal A</th>
            <th scope="col">Acc bag a1</th>
            <th scope="col">Acc bag a2</th>
            <th scope="col">Tube B</th>
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