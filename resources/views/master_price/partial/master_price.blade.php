<table class="table table-bordered" style="width: 100%;" id="mpTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Part Number Ori</th>
            <th scope="col">Part Number</th>
            <th scope="col">Item</th>
            <th scope="col">Price Per PCS</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($master_price as $mp)
        <tr id="tr_{{ $mp->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$mp->id}}"></td>
            <td>{{$no++}}</td>
            <td>{{ $mp->part_number_ori_sto }}</td>
            <td>{{ $mp->part_number_mpl }}</td>
            <td>{{ $mp->buppin }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $mp->price_per_pcs }}</td>
            <td class="text-center">
                <a href="{{ route('master_price.edit', $mp->id) }}" class="btn btn-xs" style="margin-top: 5px; margin-bottom: 5px; background-color: transparent;
                            border: 1px solid #f0ad4e;
                            padding: 6px 12px;
                            border-radius: 4px;">EDIT</a>
            </td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>