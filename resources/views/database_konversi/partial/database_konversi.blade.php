<table border="1" id="dkTableBody" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="width: 50px; text-align:center" scope="col">No</th>
            <th style="width: 250px; text-align:center" scope="col">Part No</th>
            <th style="width: 250px; text-align:center" scope="col">Buppin</th>
            <th style="width: 250px; text-align:center" scope="col">Part Name</th>
            <th style="width: 150px; text-align:center" scope="col">UOM</th>
            <th style="width: 150px; text-align:center" scope="col">Inner Packing</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($database_konversi as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->part_no }}</td>
            <td>{{ $c->buppin }}</td>
            <td>{{ $c->part_name }}</td>
            <td>{{ $c->uom }}</td>
            <td>{{ $c->inner_packing }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>
