<table border="1" id="konsepTableBody"
style="display: block; overflow:scroll; height: 500px; width:1350px; text-align:center">
<thead style="height:40px">
    <tr class="table-secondary" style=" position: sticky; top: 0;">
        <th style="width: 50px; text-align:center" scope="col"><input
                type="checkbox" class="sub_chk" id="master"></th>
        <th style="width: 50px; text-align:center" scope="col">No</th>
        <th style="width: 60px; text-align:center" scope="col">Ctrl No</th>
        <th style="width: 100px; text-align:center" scope="col">Kind New</th>
        <th style="width: 80px; text-align:center" scope="col">Size New</th>
        <th style="width: 80px; text-align:center" scope="col">Col New</th>
        <th style="width: 60px; text-align:center" scope="col">C/L-28</th>
        <th style="width: 100px; text-align:center" scope="col">Term B New</th>
        <th style="width: 110px; text-align:center" scope="col">Acc B1 New</th>
        <th style="width: 100px; text-align:center" scope="col">Acc B2</th>
        <th style="width: 120px; text-align:center" scope="col">Tube B New</th>
        <th style="width: 100px; text-align:center" scope="col">Term A New</th>
        <th style="width: 110px; text-align:center" scope="col">Acc A1 New</th>
        <th style="width: 110px; text-align:center" scope="col">Acc A2</th>
        <th style="width: 120px; text-align:center" scope="col">Tube A New</th>
    </tr>
</thead>
<tbody>
    <?php $no=1 ?>
    @forelse ($konsep_commonize as $c)
    <tr id="tr_{{ $c->id }}">
        <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                onclick="handleCheckboxChange({{ $c->id }})"></td>
        <td>{{$no++}}</td>
        <td>{{ $c->ctrl_no }}</td>
        <td>{{ $c->kind_new }}</td>
        <td>{{ $c->size_new }}</td>
        <td>{{ $c->col_new }}</td>
        <td>{{ $c->cl_28 }}</td>
        <td>{{ $c->term_b_new }}</td>
        <td>{{ $c->acc_b1_new }}</td>
        <td>{{ $c->acc_b2 }}</td>
        <td>{{ $c->tube_b_new }}</td>
        <td>{{ $c->term_a_new }}</td>
        <td>{{ $c->acc_a1_new }}</td>
        <td>{{ $c->acc_a2 }}</td>
        <td>{{ $c->tube_a_new }}</td>
    </tr>
    @empty
    <br>
    <div class="alert alert-danger">
        Data belum Tersedia.
    </div>
    @endforelse
</tbody>
</table>