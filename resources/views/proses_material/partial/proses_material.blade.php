<table class="table table-bordered" style="width: 100%;" id="pmTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            {{-- <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th> --}}
            <th scope="col">No</th>
            <th scope="col">Factory</th>
            <th scope="col">Code</th>
            <th scope="col">Area</th>
            <th scope="col">Hole</th>
            <th scope="col">Component Number</th>
            <th scope="col">Component Name</th>
            <th scope="col">Qty Total</th>
            <th scope="col">Length</th>
            <th scope="col">Konversi</th>
            <th scope="col">QTY After Konversi</th>
            <th scope="col">Cek</th>
            <th scope="col">Harga</th>
            <th scope="col">Total</th>

        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($proses_material as $data)
        <tr id="tr_{{ $data->id }}">
            {{-- <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"
                    onclick="handleCheckboxChange({{ $data->id }})"></td> --}}
            <td>{{$no++}}</td>
            <td>{{ $data->factory }}</td>
            <td>{{ $data->code }}</td>
            <td>{{ $data->area }}</td>
            <td>{{ $data->hole }}</td>
            <td>{{ $data->component_number }}</td>
            <td>{{ $data->component_name }}</td>
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