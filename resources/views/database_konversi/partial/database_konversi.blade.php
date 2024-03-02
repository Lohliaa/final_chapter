<table class="table table-bordered" style="width: 100%;" id="dkTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="text-align:center" scope="col">No</th>
            <th style="text-align:center" scope="col">Part No</th>
            <th style="text-align:center" scope="col">Buppin</th>
            <th style="text-align:center" scope="col">Part Name</th>
            <th style="text-align:center" scope="col">UOM</th>
            <th style="text-align:center" scope="col">Inner Packing</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($database_konversi as $c)
        <tr id="tr_{{ $c->id }}">
            <td style="text-align:center"><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td style="text-align:center">{{$no++}}</td>
            <td style="text-align:center">{{ $c->part_no }}</td>
            <td style="text-align:center">{{ $c->buppin }}</td>
            <td style="text-align:center">{{ $c->part_name }}</td>
            <td style="text-align:center">{{ $c->uom }}</td>
            <td style="text-align:center">{{ $c->inner_packing }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>