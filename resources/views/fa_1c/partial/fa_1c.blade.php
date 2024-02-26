<table border="1" id="fa_1cTableBody" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="width: 50px; text-align:center" scope="col">No</th>
            <th style="width: 100px; text-align:center" scope="col">Carline</th>
            <th style="width: 100px; text-align:center" scope="col">Conveyor</th>
            <th style="width: 150px; text-align:center" scope="col">Addressing Store
            </th>
            <th style="width: 100px; text-align:center" scope="col">Ctrl No</th>
            <th style="width: 70px; text-align:center" scope="col">Colour</th>
            <th style="width: 70px; text-align:center" scope="col">Qty Kbn</th>
            <th style="width: 50px; text-align:center" scope="col">Issue</th>
            <th style="width: 70px; text-align:center" scope="col">Total Qty</th>
            <th style="width: 80px; text-align:center" scope="col">Housing</th>
            <th style="width: 100px; text-align:center" scope="col">Month</th>
            <th style="width: 100px; text-align:center" scope="col">Year</th>
            <th style="width: 100px; text-align:center" scope="col">SAI</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($fa_1c as $c)
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
