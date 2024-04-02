<table class="table table-bordered" style="width: 100%;" id="mpTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Component Number Ori</th>
            <th scope="col">Component Number</th>
            <th scope="col">Item</th>
            <th scope="col">Price Per Pcs</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($harga as $mp)
        <tr id="tr_{{ $mp->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$mp->id}}"></td>
            <td>{{$no++}}</td>
            <td>{{ $mp->component_number_ori }}</td>
            <td>{{ $mp->component_number }}</td>
            <td>{{ $mp->item }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $mp->price_per_pcs }}</td>
            <td class="text-center">
                <a href="{{ route('harga.edit', $mp->id) }}" class="btn btn-xs" style="margin-top: 5px; margin-bottom: 5px; background-color: transparent;
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