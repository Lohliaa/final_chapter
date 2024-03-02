<table class="table table-bordered" style="width: 200%;" id="nextProsesTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="text-align:center" scope="col">No</th>
            <th style="text-align:center" scope="col">Carline</th>
            <th style="text-align:center" scope="col">Type</th>
            <th style="text-align:center" scope="col">Jenis</th>
            <th style="text-align:center" scope="col">Ctrl_no</th>
            <th style="text-align:center" scope="col">jenis_ctrl_no</th>
            <th style="text-align:center" scope="col">ctrl_no_cct</th>
            <th style="text-align:center" scope="col">kind</th>
            <th style="text-align:center" scope="col">size</th>
            <th style="text-align:center" scope="col">color</th>
            <th style="text-align:center" scope="col">kind_size_color</th>
            <th style="text-align:center" scope="col">cust_part_no</th>
            <th style="text-align:center" scope="col">cl</th>
            <th style="text-align:center" scope="col">term_b</th>
            <th style="text-align:center" scope="col">accb1</th>
            <th style="text-align:center" scope="col">accb2</th>
            <th style="text-align:center" scope="col">tubeb</th>
            <th style="text-align:center" scope="col">term_a</th>
            <th style="text-align:center" scope="col">acca1</th>
            <th style="text-align:center" scope="col">acca2</th>
            <th style="text-align:center" scope="col">tubea</th>
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
            <td style="white-space: nowrap; text-align:center">{{ $c->type }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->jenis }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->ctrl_no }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->jenis_ctrl_no }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->ctrl_no_cct }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->kind }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->size }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->color }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->kind_size_color }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->cust_part_no }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->cl }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->term_b }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->accb1 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->accb2 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->tubeb }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->term_a }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acca1 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acca2 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->tubea }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>