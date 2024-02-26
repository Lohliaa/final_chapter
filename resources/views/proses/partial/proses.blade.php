<table border="1" id="prosesTableBody"
style="display: block; overflow:scroll; height: 500px; width:3000px; text-align:center">
<thead style="height:40px">
    <tr class="table-secondary" style=" position: sticky; top: 0;">
        <th style="width: 50px; text-align:center" scope="col"><input
                type="checkbox" class="sub_chk" id="master"></th>
        <th style="width: 50px; text-align:center" scope="col">No</th>
        <th style="width: 80px; text-align:center" scope="col">Month</th>
        <th style="width: 80px; text-align:center" scope="col">car_line</th>
        <th style="width: 80px; text-align:center" scope="col">conveyor</th>
        <th style="width: 180px; text-align:center" scope="col">ADDRESSING STORE
        </th>
        <th style="width: 110px; text-align:center" scope="col">CTRL NO1</th>
        <th style="width: 100px; text-align:center" scope="col">CTRL NO2</th>
        <th style="width: 100px; text-align:center" scope="col">kind</th>
        <th style="width: 50px; text-align:center" scope="col">size</th>
        <th style="width: 50px; text-align:center" scope="col">color</th>
        <th style="width: 100px; text-align:center" scope="col">kind_size_color</th>
        <th style="width: 100px; text-align:center" scope="col">cust_part_no</th>
        <th style="width: 50px; text-align:center" scope="col">cl</th>
        <th style="width: 110px; text-align:center" scope="col">term_b</th>
        <th style="width: 130px; text-align:center" scope="col">accb1</th>
        <th style="width: 130px; text-align:center" scope="col">accb2</th>
        <th style="width: 110px; text-align:center" scope="col">tubeb</th>
        <th style="width: 110px; text-align:center" scope="col">term_a</th>
        <th style="width: 130px; text-align:center" scope="col">acca1</th>
        <th style="width: 130px; text-align:center" scope="col">acca2</th>
        <th style="width: 110px; text-align:center" scope="col">tubea</th>
        <th style="width: 80px; text-align:center" scope="col">total_qty</th>
        <th style="width: 100px; text-align:center" scope="col">price</th>
        <th style="width: 100px; text-align:center" scope="col">wire_cost</th>
        <th style="width: 130px; text-align:center" scope="col">component_cost</th>
        <th style="width: 130px; text-align:center" scope="col">material cost</th>
        <th style="width: 130px; text-align:center" scope="col">material cost amount</th>
        <th style="width: 100px; text-align:center" scope="col">process</th>
        <th style="width: 100px; text-align:center" scope="col">UMH</th>
        <th style="width: 100px; text-align:center" scope="col">charge</th>
        <th style="width: 100px; text-align:center" scope="col">process cost</th>
        <th style="width: 100px; text-align:center" scope="col">process cost amount</th>
        <th style="width: 100px; text-align:center" scope="col">Total Cost Amount</th>
        <th style="width: 100px; text-align:center" scope="col">keterangan</th>
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
