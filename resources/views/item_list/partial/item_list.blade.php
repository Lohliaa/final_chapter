<table class="table table-bordered" style="width: 100%;" id="itemTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th style="text-align:center" scope="col">No</th>
            <th style="text-align:center" scope="col">PART_NO</th>
            <th style="text-align:center" scope="col">CUST_PNO</th>
            <th style="text-align:center" scope="col">PART_NAME</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($item_list as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td style="text-align:center">{{$no++}}</td>
            <td style="text-align:center">{{ $c->part_no }}</td>
            <td style="text-align:center">{{ $c->cust_pno }}</td>
            <td style="text-align:center">{{ $c->part_name }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>