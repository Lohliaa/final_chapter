<table class="table table-bordered" style="width: 100%;" id="itemTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Part Number</th>
            <th scope="col">Specific Part Number</th>
            <th scope="col">Part Name</th>
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