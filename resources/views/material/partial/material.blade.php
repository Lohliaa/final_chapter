<div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
    <table class="table table-bordered" style="width: 100%;" id="materialTableBody">
        <thead style="height:40px">
            <tr class="table-secondary" style=" position: sticky; top: 0;">
                <th style="width: 50px; text-align:center" scope="col"><input
                        type="checkbox" class="sub_chk" id="master"></th>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Factory</th>
                <th style="text-align:center" scope="col">Carcode</th>
                <th style="text-align:center" scope="col">Area</th>
                <th style="text-align:center" scope="col">Cavity</th>
                <th style="text-align:center" scope="col">Partnumber</th>
                <th style="text-align:center" scope="col">Part name</th>
                <th style="text-align:center" scope="col">Qty total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1 ?>
            @forelse ($material as $c)
            <tr id="tr_{{ $c->id }}">
                <td style="text-align:center" ><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                        onclick="handleCheckboxChange({{ $c->id }})"></td>
                <td style="text-align:center" >{{$no++}}</td>
                <td style="text-align:center" >{{ $c->factory }}</td>
                <td style="text-align:center" >{{ $c->carcode }}</td>
                <td style="text-align:center" >{{ $c->area }}</td>
                <td style="text-align:center" >{{ $c->cavity }}</td>
                <td style="text-align:center" >{{ $c->partnumber }}</td>
                <td style="text-align:center" >{{ $c->part_name }}</td>
                <td style="text-align:center" >{{ $c->qty_total }}</td>
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