<table border="1"
style="display: block; overflow:scroll; height: 500px; width:2300px; text-align:center">
<thead style="height:40px">
    <tr class="table-secondary" style=" position: sticky; top: 0;">
        <th style="width: 50px; text-align:center" scope="col"><input
                type="checkbox" class="sub_chk" id="master"></th>
        <th style="width: 50px; text-align:center" scope="col">No</th>
        <th style="width: 150px; text-align:center" scope="col">Carline</th>
        <th style="width: 150px; text-align:center" scope="col">Type</th>
        <th style="width: 100px; text-align:center" scope="col">Jenis</th>
        <th style="width: 100px; text-align:center" scope="col">Ctrl_no</th>
        <th style="width: 100px; text-align:center" scope="col">jenis_ctrl_no</th>
        <th style="width: 100px; text-align:center" scope="col">ctrl_no_cct</th>
        <th style="width: 100px; text-align:center" scope="col">kind</th>
        <th style="width: 50px; text-align:center" scope="col">size</th>
        <th style="width: 50px; text-align:center" scope="col">color</th>
        <th style="width: 100px; text-align:center" scope="col">kind_size_color</th>
        <th style="width: 100px; text-align:center" scope="col">cust_part_no</th>
        <th style="width: 50px; text-align:center" scope="col">cl</th>
        <th style="width: 110px; text-align:center" scope="col">term_b</th>
        <th style="width: 180px; text-align:center" scope="col">accb1</th>
        <th style="width: 180px; text-align:center" scope="col">accb2</th>
        <th style="width: 180px; text-align:center" scope="col">tubeb</th>
        <th style="width: 110px; text-align:center" scope="col">term_a</th>
        <th style="width: 180px; text-align:center" scope="col">acca1</th>
        <th style="width: 180px; text-align:center" scope="col">acca2</th>
        <th style="width: 180px; text-align:center" scope="col">tubea</th>
    </tr>
</thead>
<tbody>
    <?php $no=1 ?>
    @forelse ($next_proses as $c)
    <tr id="tr_{{ $c->id }}">
        <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                onclick="handleCheckboxChange({{ $c->id }})"></td>
        <td>{{$no++}}</td>
        <td>{{ $c->carline }}</td>
        <td>{{ $c->type }}</td>
        <td>{{ $c->jenis }}</td>
        <td>{{ $c->ctrl_no }}</td>
        <td>{{ $c->jenis_ctrl_no }}</td>
        <td>{{ $c->ctrl_no_cct }}</td>
        <td>{{ $c->kind }}</td>
        <td>{{ $c->size }}</td>
        <td>{{ $c->color }}</td>
        <td>{{ $c->kind_size_color }}</td>
        <td>{{ $c->cust_part_no }}</td>
        <td>{{ $c->cl }}</td>
        <td>{{ $c->term_b }}</td>
        <td>{{ $c->accb1 }}</td>
        <td>{{ $c->accb2 }}</td>
        <td>{{ $c->tubeb }}</td>
        <td>{{ $c->term_a }}</td>
        <td>{{ $c->acca1 }}</td>
        <td>{{ $c->acca2 }}</td>
        <td>{{ $c->tubea }}</td>
    </tr>
    @empty
    <br>
    <div class="alert alert-danger">
        Data belum Tersedia.
    </div>
    @endforelse
</tbody>
</table>