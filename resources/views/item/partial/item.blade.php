<table class="table table-bordered" style="width: 100%;" id="itemTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Component Number</th>
            <th scope="col">Specific Component Number</th>
            <th scope="col">Component Name</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($item as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->component_number }}</td>
            <td>{{ $c->specific_component_number }}</td>
            <td>{{ $c->component_name }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>