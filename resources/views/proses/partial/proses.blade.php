<table class="table table-bordered" style="width: 200%;" id="prosesTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Month</th>
            <th scope="col">car_line</th>
            <th scope="col">conveyor</th>
            <th scope="col">ADDRESSING STORE</th>
            <th scope="col">CTRL NO1</th>
            <th scope="col">CTRL NO2</th>
            <th scope="col">kind</th>
            <th scope="col">size</th>
            <th scope="col">color</th>
            <th scope="col">kind_size_color</th>
            <th scope="col">cust_part_no</th>
            <th scope="col">cl</th>
            <th scope="col">term_b</th>
            <th scope="col">accb1</th>
            <th scope="col">accb2</th>
            <th scope="col">tubeb</th>
            <th scope="col">term_a</th>
            <th scope="col">acca1</th>
            <th scope="col">acca2</th>
            <th scope="col">tubea</th>
            <th scope="col">total_qty</th>
            <th scope="col">price</th>
            <th scope="col">wire_cost</th>
            <th scope="col">component_cost</th>
            <th scope="col">material cost</th>
            <th scope="col">material cost amount</th>
            <th scope="col">process</th>
            <th scope="col">UMH</th>
            <th scope="col">charge</th>
            <th scope="col">process cost</th>
            <th scope="col">process cost amount</th>
            <th scope="col">Total Cost Amount</th>
            <th scope="col">keterangan</th>
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