<table border="1" id="pmTableBody" style="display: block; overflow: scroll; height: 500px; width: 1500px; text-align: center; margin: 0 auto;">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            {{--  <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>  --}}
            <th style="width: 50px; text-align:center" scope="col">No</th>
            <th style="width: 100px; text-align:center" scope="col">Factory</th>
            <th style="width: 100px; text-align:center" scope="col">Carcode</th>
            <th style="width: 200px; text-align:center" scope="col">Area</th>
            <th style="width: 200px; text-align:center" scope="col">Cavity</th>
            <th style="width: 200px; text-align:center" scope="col">Partnumber</th>
            <th style="width: 200px; text-align:center" scope="col">Part name</th>
            <th style="width: 150px; text-align:center" scope="col">Qty total</th>
            <th style="width: 150px; text-align:center" scope="col">Length</th>
            <th style="width: 150px; text-align:center" scope="col">Konversi</th>
            <th style="width: 150px; text-align:center" scope="col">QTY After Konversi</th>
            <th style="width: 150px; text-align:center" scope="col">Cek</th>
            <th style="width: 150px; text-align:center" scope="col">Price</th>
            <th style="width: 150px; text-align:center" scope="col">Amount</th>

        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($proses_material as $data)
        <tr id="tr_{{ $data->id }}">
            {{--  <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"
                    onclick="handleCheckboxChange({{ $data->id }})"></td>  --}}
            <td>{{$no++}}</td>
            <td>{{ $data->factory }}</td>
            <td>{{ $data->carcode }}</td>
            <td>{{ $data->area }}</td>
            <td>{{ $data->cavity }}</td>
            <td>{{ $data->partnumber }}</td>
            <td>{{ $data->part_name }}</td>
            <td>{{ $data->qty_total }}</td>
            <td>{{ $data->length }}</td>
            <td>{{ $data->konversi }}</td>
            <td>{{ $data->qty_after_konversi }}</td>
            <td>{{ $data->cek }}</td>
            <td>{{ $data->price }}</td>
            <td>{{ $data->amount }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>