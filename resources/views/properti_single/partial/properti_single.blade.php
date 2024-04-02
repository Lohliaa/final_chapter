<table class="table table-bordered" style="width: 100%;" id="konsepTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Material Properties</th>
            <th scope="col">Model</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Warna</th>
            <th scope="col">CL</th>
            <th scope="col">TRM B</th>
            <th scope="col">Acc bag b1</th>
            <th scope="col">Acc bag b2</th>
            <th scope="col">TBE B</th>
            <th scope="col">TRM A</th>
            <th scope="col">Acc bag a1</th>
            <th scope="col">Acc bag a2</th>
            <th scope="col">TBE A</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($properti_single as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->material_properties }}</td>
            <td>{{ $c->model }}</td>
            <td>{{ $c->ukuran }}</td>
            <td>{{ $c->warna }}</td>
            <td>{{ $c->cl }}</td>
            <td>{{ $c->trm_b }}</td>
            <td>{{ $c->acc_bag_b1 }}</td>
            <td>{{ $c->acc_bag_b2 }}</td>
            <td>{{ $c->tbe_b }}</td>
            <td>{{ $c->trm_a }}</td>
            <td>{{ $c->acc_bag_a1 }}</td>
            <td>{{ $c->acc_bag_a2 }}</td>
            <td>{{ $c->tbe_a }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>