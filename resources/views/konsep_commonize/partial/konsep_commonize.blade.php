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
            <th scope="col">Terminal B</th>
            <th scope="col">Acc bag b1</th>
            <th scope="col">Acc bag b2</th>
            <th scope="col">Tube B</th>
            <th scope="col">Terminal A</th>
            <th scope="col">Acc bag a1</th>
            <th scope="col">Acc bag a2</th>
            <th scope="col">Tube A</th>
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