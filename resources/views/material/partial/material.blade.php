<table class="table table-bordered" style="width: 100%;" id="materialTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Factory</th>
            <th scope="col">Code</th>
            <th scope="col">Area</th>
            <th scope="col">Cavity</th>
            <th scope="col">Part Number</th>
            <th scope="col">Part Name</th>
            <th scope="col">Qty Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($material as $c)
        <tr id="tr_{{ $c->id }}">
            <td ><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td >{{$no++}}</td>
            <td >{{ $c->factory }}</td>
            <td >{{ $c->carcode }}</td>
            <td >{{ $c->area }}</td>
            <td >{{ $c->cavity }}</td>
            <td >{{ $c->partnumber }}</td>
            <td >{{ $c->part_name }}</td>
            <td >{{ $c->qty_total }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>