<table class="table table-bordered" style="width: 200%;" id="nextProsesTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Line</th>
            <th scope="col">Tipe</th>
            <th scope="col">Jenis</th>
            <th scope="col">Material</th>
            <th scope="col">Jenis Material</th>
            <th scope="col">Material Properties</th>
            <th scope="col">Model</th>
            <th scope="col">Ukuran</th>
            <th scope="col">Warna</th>
            <th scope="col">Model Ukuran Warna</th>
            <th scope="col">Specific Part Numb</th>
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