<table class="table table-bordered" style="width: 100%;" id="fa_1aTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Line</th>
            <th scope="col">Bagian</th>
            <th scope="col">Area Store</th>
            <th scope="col">Material</th>
            <th scope="col">Warna</th>
            <th scope="col">Qty Board</th>
            <th scope="col">Issue</th>
            <th scope="col">Total Qty</th>
            <th scope="col">Area</th>
            <th scope="col">Month</th>
            <th scope="col">Year</th>
            <th scope="col">Factory</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($fa_1a as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->car_line }}</td>
            <td>{{ $c->conveyor }}</td>
            <td>{{ $c->addressing_store }}</td>
            <td>{{ $c->ctrl_no }}</td>
            <td>{{ $c->colour }}</td>
            <td>{{ $c->qty_kbn }}</td>
            <td>{{ $c->issue }}</td>
            <td>{{ $c->total_qty }}</td>
            <td>{{ $c->housing }}</td>
            <td>{{ $c->month }}</td>
            <td>{{ $c->year }}</td>
            <td>{{ $c->sai }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>