<table border="1" id="materialTableBody" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="width: 50px; text-align:center" scope="col">No</th>
            <th style="width: 100px; text-align:center" scope="col">Factory</th>
            <th style="width: 100px; text-align:center" scope="col">Carcode</th>
            <th style="width: 200px; text-align:center" scope="col">Area</th>
            <th style="width: 250px; text-align:center" scope="col">Cavity</th>
            <th style="width: 200px; text-align:center" scope="col">Partnumber</th>
            <th style="width: 200px; text-align:center" scope="col">Part name</th>
            <th style="width: 150px; text-align:center" scope="col">Qty total</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($material as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->factory }}</td>
            <td>{{ $c->carcode }}</td>
            <td>{{ $c->area }}</td>
            <td>{{ $c->cavity }}</td>
            <td>{{ $c->partnumber }}</td>
            <td>{{ $c->part_name }}</td>
            <td>{{ $c->qty_total }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>
