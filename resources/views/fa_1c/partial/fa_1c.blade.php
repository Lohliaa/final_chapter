<div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
    <table class="table table-bordered" style="width: 100%;" id="fa_1cTableBody">                    <thead style="height:40px">
            <tr class="table-secondary" style=" position: sticky; top: 0;">
                <th style="width: 50px; text-align:center" scope="col"><input
                        type="checkbox" class="sub_chk" id="master"></th>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Carline</th>
                <th style="text-align:center" scope="col">Conveyor</th>
                <th style="text-align:center" scope="col">Addressing Store</th>
                <th style="text-align:center" scope="col">Ctrl No</th>
                <th style="text-align:center" scope="col">Colour</th>
                <th style="text-align:center" scope="col">Qty Kbn</th>
                <th style="text-align:center" scope="col">Issue</th>
                <th style="text-align:center" scope="col">Total Qty</th>
                <th style="text-align:center" scope="col">Housing</th>
                <th style="text-align:center" scope="col">Month</th>
                <th style="text-align:center" scope="col">Year</th>
                <th style="text-align:center" scope="col">Factory</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1 ?>
            @forelse ($fa_1c as $c)
            <tr id="tr_{{ $c->id }}">
                <td style="white-space: nowrap; text-align:center"><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                        onclick="handleCheckboxChange({{ $c->id }})"></td>
                <td style="white-space: nowrap; text-align:center">{{$no++}}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->car_line }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->conveyor }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->addressing_store }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->ctrl_no }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->colour }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->qty_kbn }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->issue }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->total_qty }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->housing }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->month }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->year }}</td>
                <td style="white-space: nowrap; text-align:center">{{ $c->sai }}</td>
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