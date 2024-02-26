<table border="1" id="itemTableBody"
style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
<thead style="height:40px">
    <tr class="table-secondary" style=" position: sticky; top: 0;">
        <th style="width: 50px; text-align:center" scope="col"><input
                type="checkbox" class="sub_chk" id="master"></th>
        <th style="width: 50px; text-align:center" scope="col">No</th>
        <th style="width: 350px; text-align:center" scope="col">PART_NO</th>
        <th style="width: 300px; text-align:center" scope="col">CUST_PNO</th>
        <th style="width: 300px; text-align:center" scope="col">PART_NAME</th>
    </tr>
</thead>
<tbody>
    <?php $no=1 ?>
    @forelse ($item_list as $c)
    <tr id="tr_{{ $c->id }}">
        <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                onclick="handleCheckboxChange({{ $c->id }})"></td>
        <td>{{$no++}}</td>
        <td>{{ $c->part_no }}</td>
        <td>{{ $c->cust_pno }}</td>
        <td>{{ $c->part_name }}</td>
    </tr>
    @empty
    <br>
    <div class="alert alert-danger">
        Data belum Tersedia.
    </div>
    @endforelse
</tbody>
</table>