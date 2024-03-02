<table class="table table-bordered" style="width: 200%;" id="pmTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            {{-- <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th> --}}
            <th style="white-space: nowrap; text-align:center" scope="col">No</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Factory</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Carcode</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Area</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Cavity</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Partnumber</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Part name</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Qty total</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Length</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Konversi</th>
            <th style="white-space: nowrap; text-align:center" scope="col">QTY After Konversi</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Cek</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Price</th>
            <th style="white-space: nowrap; text-align:center" scope="col">Amount</th>

        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($proses_material as $data)
        <tr id="tr_{{ $data->id }}">
            {{-- <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"
                    onclick="handleCheckboxChange({{ $data->id }})"></td> --}}
            <td style="white-space: nowrap; text-align:center">{{$no++}}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->factory }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->carcode }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->area }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->cavity }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->partnumber }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->part_name }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->qty_total }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->length }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->konversi }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->qty_after_konversi }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->cek }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->price }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $data->amount }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>